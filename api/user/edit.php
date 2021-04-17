<?php

session_start();

include_once $_SERVER['DOCUMENT_ROOT']."/MyDiscussionForum/api/utils.php";
include_once $_SERVER['DOCUMENT_ROOT']."/MyDiscussionForum/api/Database.php";
include_once $_SERVER['DOCUMENT_ROOT']."/MyDiscussionForum/api/User.php";
include_once $_SERVER['DOCUMENT_ROOT']."/MyDiscussionForum/api/Post.php";

$current_user = null;
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == 1 && isset($_SESSION['user'])){
    $current_user = unserialize((base64_decode($_SESSION['user'])));

    if ($current_user->enabled == 0){
        $_SESSION['loggedin'] = 0;
        $_SESSION['user'] = null;
        print_r('<script> alert("The account you have been using was disabled by an admin."); </script>');
    }
}

if (!isset($_SESSION['loggedin'])){
    $_SESSION['loggedin'] = 0;
}

if ($_SESSION['loggedin'] == 0){
    header("Location: ../../auth/login.php");
}
// receive required fields from form (signup.html)
if (!isset($_POST['fname']) || empty($_POST['fname'])){
	header("Location: ../../editprofile.php");
}
if (!isset($_POST['lname']) || empty($_POST['lname'])){
	header("Location: ../../editprofile.php");
}

$db_obj = new Database();
$db_con = $db_obj->connect();

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$path = $current_user->profile_img;

if ($_FILES['pfp']['error'] != 4) {
    $uploadDirectory = "../../images/pfp/";
    $response = uploadImage($uploadDirectory, $_FILES["pfp"], $current_user->id);
    if ($response === false){
        header("Location: ../../editprofile.php");
    }
    $path = "images/pfp/".$response;
} 

$user = new User();
if ($user->getuserbyid($db_con, $current_user->id)){
    $user->update($db_con, $current_user->id, $fname, $lname, $path);
}

header("Location: ../../profile.php?id=".$current_user->id);
?>