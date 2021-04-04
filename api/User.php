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
        $q = 'SELECT id, email, username, profile_img, password_hash, created_on, is_admin, is_enabled
              FROM ForumUsers
              WHERE email = ? AND password_hash = ?
              LIMIT 1';

        $pw_hash = hash('sha256', $ptxt_password);

        $pre_q = $db->prepare($q);
        $pre_q->bindParam(1, $email);
        $pre_q->bindParam(2, $pw_hash);
        $pre_q->execute();

        if ($pre_q->rowCount() < 1){
            return false;
        }

        $row = $pre_q->fetch(PDO::FETCH_ASSOC);

        $this->id = $row['id'];
        $this->email = $email;
        $this->username = $row['username'];
        $this->profile_img = $row['profile_img'];
        $this->created_on = $row['created_on'];
        $this->admin = $row['is_admin'];
        $this->enabled = $row['is_enabled'];

        return true;
    }

    public function create($db, $email, $username, $ptxt_password){
        $user = new User();
        if ($user->getuserbyusername($db, $username)){
            return -1;
        } else if ($user->getuserbyemail($db, $email)){
            return -2;
        }

        $q = 'INSERT INTO ForumUsers (email, username, password_hash, created_on)
              VALUES (?, ?, ?, CURDATE())';

        $pw_hash = hash('sha256', $ptxt_password);

        $pre_q = $db->prepare($q);
        $pre_q->bindParam(1, $email);
        $pre_q->bindParam(2, $username);
        $pre_q->bindParam(3, $pw_hash);
        $pre_q->execute();

        if ($pre_q->rowCount() < 1){
            return 0;
        }

        $this->getuserbyusername($db, $username);

        return 1;
    }

    public function getuserbyusername($db, $username){
        $q = 'SELECT id, email, username, profile_img, created_on, is_admin, is_enabled
              FROM ForumUsers
              WHERE username = ?
              LIMIT 1';

        $pre_q = $db->prepare($q);
        $pre_q->bindParam(1, $username);
        $pre_q->execute();

        if ($pre_q->rowCount() < 1){
            return false;
        }

        $row = $pre_q->fetch(PDO::FETCH_ASSOC);

        $this->id = $row['id'];
        $this->email = $row['email'];
        $this->username = $row['username'];
        $this->profile_img = $row['profile_img'];
        $this->created_on = $row['created_on'];
        $this->admin = $row['is_admin'];
        $this->enabled = $row['is_enabled'];

        return true;
    }

    public function getuserbyemail($db, $email){
        $q = 'SELECT id, email, username, profile_img, created_on, is_admin, is_enabled
              FROM ForumUsers
              WHERE email = ?
              LIMIT 1';

        $pre_q = $db->prepare($q);
        $pre_q->bindParam(1, $email);
        $pre_q->execute();

        if ($pre_q->rowCount() < 1){
            return false;
        }

        $row = $pre_q->fetch(PDO::FETCH_ASSOC);

        $this->id = $row['id'];
        $this->email = $row['email'];
        $this->username = $row['username'];
        $this->profile_img = $row['profile_img'];
        $this->created_on = $row['created_on'];
        $this->admin = $row['is_admin'];
        $this->enabled = $row['is_enabled'];

        return true;
    }

    public function getuserbyid($db, $id){
        $q = 'SELECT id, email, username, profile_img, created_on, is_admin, is_enabled
              FROM ForumUsers
              WHERE id = ?
              LIMIT 1';

        $pre_q = $db->prepare($q);
        $pre_q->bindParam(1, $id);
        $pre_q->execute();

        if ($pre_q->rowCount() < 1){
            return false;
        }

        $row = $pre_q->fetch(PDO::FETCH_ASSOC);

        $this->id = $row['id'];
        $this->email = $row['email'];
        $this->username = $row['username'];
        $this->profile_img = $row['profile_img'];
        $this->created_on = $row['created_on'];
        $this->admin = $row['is_admin'];
        $this->enabled = $row['is_enabled'];

        return true;
    }
}

?>