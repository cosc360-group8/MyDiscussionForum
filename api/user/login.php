<?php

include_once "../Database.php";
include_once "../User.php";

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
    print_r("success\n");
} else {
    print_r("failed\n");
}
?>