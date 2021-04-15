<?php
    #mail('munezo777@gmail.com', 'test subject', 'hello', 'From: munezo777@gmail.com');
    include_once $_SERVER['DOCUMENT_ROOT']."/MyDiscussionForum/api/Database.php";
    include_once $_SERVER['DOCUMENT_ROOT']."/MyDiscussionForum/api/User.php";

    // retrieve fields
    $username = $_POST['username'];
    $email = $_POST['email'];
    // echo "$username  $email";   // DEBUG

    // connecting to database
    $db_obj = new Database();
    $db_con = $db_obj->connect();

    // creating user object
    $user = new User();

    // verifying if user with username and email is present in the database
    if($user->getuserbyusername($db_con, $username) && $user->getuserbyemail($db_con, $email)){
        echo "user exists";
    }
    else{
        echo "invalid user";
    }







?>