<?php

include_once $_SERVER['DOCUMENT_ROOT']."/MyDiscussionForum/api/Database.php";
include_once $_SERVER['DOCUMENT_ROOT']."/MyDiscussionForum/api/Comment.php";

header("Content-Type: application/json");

$result = array();

if (!isset($_POST['id']) || empty($_POST['id'])){
    $result['message'] = 'ERROR: Comment ID is not set or empty';
    http_response_code(400);
} else {
    $db_obj = new Database();
    $db_con = $db_obj->connect();

    $id = $_POST['id'];

    $c = new Comment();
    if ($c->getcommentbyid($db_con, $id)){
        $result['comment'] = $c;
        $result['message'] = 'SUCCESS';
        http_response_code(200);
    } else {
        $result['message'] = 'ERROR: Comment could not be found';
        http_response_code(404);
    }
}

print_r(json_encode($result));

?>
