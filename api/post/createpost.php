<?php

include_once $_SERVER['DOCUMENT_ROOT']."/MyDiscussionForum/api/Database.php";
include_once $_SERVER['DOCUMENT_ROOT']."/MyDiscussionForum/api/Post.php";

// receive required fields from form (signup.html)
$board = $_POST['post_board'];
$title = $_POST['post_title'];
$content = $_POST['post_content'];

$db_obj = new Database();
$db_con = $db_obj->connect();

$uobj = new Post();
// User id and cover image are hardcoded for now
$response = $uobj->create($db_con, '2', $title, 'images\movie.jpg', $content, $board);

if($response){
  // Redirect to home page if
  header("Location: ../../index.php");
} else {
  header("Location: ../../createPost.php");
}
die();
?>