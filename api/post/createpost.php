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
    header("Location: ../../index.php");
}
// receive required fields from form (signup.html)
if (!isset($_POST['post_board']) || empty($_POST['post_board'])){
	header("Location: ../../createPost.php");
}
if (!isset($_POST['post_title']) || empty($_POST['post_title'])){
	header("Location: ../../createPost.php");
}
if (!isset($_POST['post_content']) || empty($_POST['post_content'])){
	header("Location: ../../createPost.php");
}
$board = $_POST['post_board'];
$title = $_POST['post_title'];
$content = $_POST['post_content'];

$uploadDirectory = "../../images/";

$response = uploadImage($uploadDirectory, $_FILES["coverImage"], $current_user->id);
if ($response === false){
	header("Location: ../../createPost.php");
}

$path = './images/uploads/'.$response;

$db_obj = new Database();
$db_con = $db_obj->connect();

$uobj = new Post();
// User id and cover image are hardcoded for now
$response = $uobj->create($db_con, $current_user->id, $title, $path, $content, $board);

if($response){
  // Redirect to home page if
    header("Location: ../../index.php");
} else {
    header("Location: ../../createPost.php");
}
die();
?>