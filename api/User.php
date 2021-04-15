<?php

class User {

    public $id;
    public $email;
    public $fname;
    public $lname;
    public $username;
    public $profile_img;
    public $created_on;
    public $admin;
    public $enabled;

    public function getusers($db, $limit, $skip){
        $q = 'SELECT *
              FROM ForumUsers
              ORDER BY id';

        $pre_q = $db->prepare($q);
        $pre_q->execute();

        $users = array();

        $it_c = 0;
        while($row = $pre_q->fetch(PDO::FETCH_ASSOC)){
            $it_c++;
            if ($it_c <= $skip)
            {
                continue;
            } else if ($it_c > $limit + $skip){
                break;
            }

            $u = new User();
            $u->id = $row['id'];
            $u->email = $row['email'];
            $u->fname = $row['firstname'];
            $u->lname = $row['lastname'];
            $u->username = $row['username'];
            $u->profile_img = $row['profile_img'];
            $u->created_on = $row['created_on'];
            $u->admin = $row['is_admin'];
            $u->enabled = $row['is_enabled'];

            array_push($users, $u);
        }

        return $users;
    }

    public function login($db, $email, $ptxt_password){
        // verifying user by checking email and password
        $q = 'SELECT *
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
        $this->fname = $row['firstname'];
        $this->lname = $row['lastname'];
        $this->username = $row['username'];
        $this->profile_img = $row['profile_img'];
        $this->created_on = $row['created_on'];
        $this->admin = $row['is_admin'];
        $this->enabled = $row['is_enabled'];

        // return true if a match is found (login successful)
        return true;
    }

    public function create($db, $email, $fname, $lname, $username, $ptxt_password){
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
        $q = 'INSERT INTO ForumUsers (email, firstname, lastname, username, password_hash, created_on)
              VALUES (?, ?, ?, ?, ?, CURDATE())';

        $pw_hash = hash('sha256', $ptxt_password);

        // prepared statement
        $pre_q = $db->prepare($q);
        $pre_q->bindParam(1, $email);
        $pre_q->bindParam(2, $fname);
        $pre_q->bindParam(3, $lname);
        $pre_q->bindParam(4, $username);
        $pre_q->bindParam(5, $pw_hash);
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
        $q = 'SELECT *
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
        $this->fname = $row['firstname'];
        $this->lname = $row['lastname'];
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
        $q = 'SELECT *
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
        $this->fname = $row['firstname'];
        $this->lname = $row['lastname'];
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
        $q = 'SELECT *
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
        $this->fname = $row['firstname'];
        $this->lname = $row['lastname'];
        $this->username = $row['username'];
        $this->profile_img = $row['profile_img'];
        $this->created_on = $row['created_on'];
        $this->admin = $row['is_admin'];
        $this->enabled = $row['is_enabled'];

        // return true if a match if found
        return true;
    }

    public function toggleEnabled($db){
        if (!isset($this->id) || empty($this->id)){
            return false;
        }

        $q = 'UPDATE ForumUsers
              SET is_enabled = ?
              WHERE id = ?';

        $new_enabled = 0;

        $pre_q = $db->prepare($q);
        if ($this->enabled == 1){
            $pre_q->bindParam(1, $new_enabled);
        } else {
            $new_enabled = 1;
            $pre_q->bindParam(1, $new_enabled);
        }
        $pre_q->bindParam(2, $this->id);
        $pre_q->execute();

        if ($pre_q->rowCount() > 0){
            $this->enabled = $new_enabled;
            return true;
        }

        return false;
    }

    public function toggleAdmin($db){
        if (!isset($this->id) || empty($this->id)){
            return false;
        }

        $q = 'UPDATE ForumUsers
              SET is_admin = ?
              WHERE id = ?';

        $new_admin = 0;

        $pre_q = $db->prepare($q);
        if ($this->admin == 1){
            $pre_q->bindParam(1, $new_admin);
        } else {
            $new_admin = 1;
            $pre_q->bindParam(1, $new_admin);
        }
        $pre_q->bindParam(2, $this->id);
        $pre_q->execute();

        if ($pre_q->rowCount() > 0){
            $this->admin = $new_admin;
            return true;
        }

        return false;
    }
}

?>