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
        echo "user exists <br>";
        $to = "mydiscussionforum.MDF@gmail.com";
        $subject = "Password Recovery - MyDiscussionForum --noreply";
        $from = "mydiscussionforum.MDF@gmail.com";
        // To send HTML mail, the Content-type header must be set
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: '.'<'.$from.'>' . "\r\n"; 

        $code = uniqid(true);   // genereates a unique id to be stored in the resetPasswords table
        $flag = $user->createResetPasswords($db_con, $username, $email, $code);
        $message = "<h3>here is the code $code</h3>";

        if($flag == 1){
            $link = "http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/resetPassword.php?code=$code";
            echo "here is the <a href=\"$link\">link</a>";
            //mail($to, $subject, $message, $headers);
        }
        else{
            echo "an error occured";
        }


        



    }
    else{
        echo "invalid user";
    }







?>