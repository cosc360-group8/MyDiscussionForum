<?php

session_start();

include_once $_SERVER['DOCUMENT_ROOT']."/MyDiscussionForum/api/Database.php";
include_once $_SERVER['DOCUMENT_ROOT']."/MyDiscussionForum/api/User.php";

// taking values from the login form
$email = $_POST['email'];
$pswd = $_POST['password'];

$db_obj = new Database();
$db_con = $db_obj->connect();

$uobj = new User();

// returns false if the login failed
// returns true if the login was successful
$response = $uobj->login($db_con, $email, $pswd);

if($response){ 
    $_SESSION['loggedin'] = 1;
    $_SESSION['user'] = base64_encode(serialize($uobj));
    header('Location: ../../index.php');
} else {
    $_SESSION['loggedin'] = 0;
    $_SESSION['user'] = null;
    print_r('<script> alert("The entered email/password combination is invalid.");</script>');
    header('Location: ../../auth/login.html');
}
?>