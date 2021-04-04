<?php

include_once "../Database.php";
include_once "../User.php";

$email = $_POST['email'];
$user = $_POST['username'];
$pw = $_POST['password'];

$db_obj = new Database();
$db_con = $db_obj->connect();

$uobj = new User();
// $response values:
// -2: email is already taken
// -1: username is already taken
//  0: something went wrong with the sql query
//  1: user was added successfully
$response = $uobj->create($db_con, $email, $user, $pw);

print_r($response + "\n");

?>