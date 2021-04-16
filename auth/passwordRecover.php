<?php
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
        $to = "mydiscussionforum.MDF@gmail.com";
        $subject = "Password Recovery - MyDiscussionForum --noreply";
        $from = "mydiscussionforum.MDF@gmail.com";
        // To send HTML mail, the Content-type header must be set
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: '.'<'.$from.'>' . "\r\n"; 
        $message = "<a href=\"\">Reset your password here</a>";

        // mail($to, $subject, $message, $headers);


        // mail('mydiscussionforum.MDF@gmail.com', 'test subject', 'hello', 'From: mydiscussionforum.MDF@gmail.com');

    }
    else{
        echo "invalid user";
    }







?>