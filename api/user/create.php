<?php

include_once $_SERVER['DOCUMENT_ROOT']."/MyDiscussionForum/api/Database.php";
include_once $_SERVER['DOCUMENT_ROOT']."/MyDiscussionForum/api/User.php";

// receive required fields from form (signup.html)
$email = $_POST['email'];
$username = $_POST['username'];
$pw = $_POST['password'];

$db_obj = new Database();
$db_con = $db_obj->connect();

$uobj = new User();
// calling function to create an account
$response = $uobj->create($db_con, $email, $username, $pw);

// -2: email is already taken
if($response == -2){
    echo "This email is already taken.";
}
// -1: username is already taken
elseif($response == -1){
    echo "This username is already taken.";
}
//  0: something went wrong with the sql query
elseif($response == 0){
    echo "Oops! Something went wrong.";
}
//  1: user was added successfully
else{
    echo "Account was created successfully.";
}
print_r($response);
print_r("\n");

?>