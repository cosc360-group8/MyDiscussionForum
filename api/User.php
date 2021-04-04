<?php

class User {

    public $id;
    public $email;
    public $username;
    public $profile_img;
    public $created_on;
    public $admin;
    public $enabled;

    public function login($db, $email, $ptxt_password){
        // verifying user by checking email and password
        $q = 'SELECT id, email, username, profile_img, password_hash, created_on, is_admin, is_enabled
              FROM ForumUsers
              WHERE email = ? AND password_hash = ?
              LIMIT 1';

        $pw_hash = hash('sha256', $ptxt_password);
        // prepared statement
        $pre_q = $db->prepare($q);
        $pre_q->bindParam(1, $email);
        $pre_q->bindParam(2, $pw_hash);
        $pre_q->execute();

        // return false if no match  is found
        if ($pre_q->rowCount() < 1){
            return false;
        }

        // match is found
        $row = $pre_q->fetch(PDO::FETCH_ASSOC);

        $this->id = $row['id'];
        $this->email = $email;
        $this->username = $row['username'];
        $this->profile_img = $row['profile_img'];
        $this->created_on = $row['created_on'];
        $this->admin = $row['is_admin'];
        $this->enabled = $row['is_enabled'];

        // return true if a match is found (login successful)
        return true;
    }

    public function create($db, $email, $username, $ptxt_password){
        $user = new User();
        // return -1 if username is already taken
        if ($user->getuserbyusername($db, $username)){  
            return -1;
        } 
        // return -2 if email is already taken
        else if ($user->getuserbyemail($db, $email)){   
            return -2;
        }
        
        // create account if username and email are not already taken
        $q = 'INSERT INTO ForumUsers (email, username, password_hash, created_on)
              VALUES (?, ?, ?, CURDATE())';

        $pw_hash = hash('sha256', $ptxt_password);

        // prepared statement
        $pre_q = $db->prepare($q);
        $pre_q->bindParam(1, $email);
        $pre_q->bindParam(2, $username);
        $pre_q->bindParam(3, $pw_hash);
        $pre_q->execute();

        // return 0 if SQL query crashes
        if ($pre_q->rowCount() < 1){
            return 0;
        }

        $this->getuserbyusername($db, $username);  // curious: what's the purpose of having this function call here?

        // return 1 if account is created
        return 1;
    }

    public function getuserbyusername($db, $username){
        // function returns true if a username is found in the database, else returns false
        $q = 'SELECT id, email, username, profile_img, created_on, is_admin, is_enabled
              FROM ForumUsers
              WHERE username = ?
              LIMIT 1';

        // prepared statement
        $pre_q = $db->prepare($q);
        $pre_q->bindParam(1, $username);
        $pre_q->execute();

        // if a match is not found, return false
        if ($pre_q->rowCount() < 1){
            return false;
        }

        // entry is found
        $row = $pre_q->fetch(PDO::FETCH_ASSOC);

        $this->id = $row['id'];
        $this->email = $row['email'];
        $this->username = $row['username'];
        $this->profile_img = $row['profile_img'];
        $this->created_on = $row['created_on'];
        $this->admin = $row['is_admin'];
        $this->enabled = $row['is_enabled'];

        // return true if a match is found
        return true;
    }

    public function getuserbyemail($db, $email){
        // returns true if an email is found in the database, else returns false
        $q = 'SELECT id, email, username, profile_img, created_on, is_admin, is_enabled
              FROM ForumUsers
              WHERE email = ?
              LIMIT 1';

        // prepared statement
        $pre_q = $db->prepare($q);
        $pre_q->bindParam(1, $email);
        $pre_q->execute();

        // return false if no entry is found
        if ($pre_q->rowCount() < 1){
            return false;
        }

        // entry is found
        $row = $pre_q->fetch(PDO::FETCH_ASSOC);

        $this->id = $row['id'];
        $this->email = $row['email'];
        $this->username = $row['username'];
        $this->profile_img = $row['profile_img'];
        $this->created_on = $row['created_on'];
        $this->admin = $row['is_admin'];
        $this->enabled = $row['is_enabled'];

        // return true if an entry is found
        return true;
    }

    public function getuserbyid($db, $id){
        // function returns true if an id is found in the database, else returns false
        $q = 'SELECT id, email, username, profile_img, created_on, is_admin, is_enabled
              FROM ForumUsers
              WHERE id = ?
              LIMIT 1';

        // prepared statement
        $pre_q = $db->prepare($q);
        $pre_q->bindParam(1, $id);
        $pre_q->execute();

        // return false if no match if found
        if ($pre_q->rowCount() < 1){
            return false;
        }

        // a match if found
        $row = $pre_q->fetch(PDO::FETCH_ASSOC);

        $this->id = $row['id'];
        $this->email = $row['email'];
        $this->username = $row['username'];
        $this->profile_img = $row['profile_img'];
        $this->created_on = $row['created_on'];
        $this->admin = $row['is_admin'];
        $this->enabled = $row['is_enabled'];

        // return true if a match if found
        return true;
    }
}

?>