<?php

session_start();

include_once $_SERVER['DOCUMENT_ROOT']."/MyDiscussionForum/api/Database.php";
include_once $_SERVER['DOCUMENT_ROOT']."/MyDiscussionForum/api/Comment.php";

$db_obj = new Database();
$db_con = $db_obj->connect();

if (!isset($_POST['pid']) || empty($_POST['pid'])){
    header('Location: ../../index.php');
}

$pid = intval($_POST['pid']);

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
    header('Location: ../../post.php?id='.$pid);
}

if (!isset($_POST['comment']) || empty($_POST['comment'])){
    header('Location: ../../post.php?id='.$pid);
}  

$content = $_POST['comment'];

$comment = new Comment();

$comment->create($db_con, $current_user->id, $pid, $content);

header('Location: ../../post.php?id='.$pid);
?>