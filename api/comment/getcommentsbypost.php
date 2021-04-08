<?php

include_once $_SERVER['DOCUMENT_ROOT']."/MyDiscussionForum/api/Database.php";
include_once $_SERVER['DOCUMENT_ROOT']."/MyDiscussionForum/api/Comment.php";

header("Content-Type: application/json");

$result = array();

if (!isset($_POST['pid']) || empty($_POST['pid'])){
    $result['message'] = 'ERROR: Post ID is not set or empty';
    http_response_code(400);
} else if (!isset($_POST['limit']) || empty($_POST['limit'])) {
    $result['message'] = 'ERROR: Limit is not set or empty';
    http_response_code(400);
} else if (!isset($_POST['skip'])){
    $result['message'] = 'ERROR: Skip is not set or empty';
    http_response_code(400);
} else {
    $db_obj = new Database();
    $db_con = $db_obj->connect();

    $limit = intval($_POST['limit']);
    $pid = intval($_POST['pid']);
    $skip = 0;
    if (!empty($_POST['skip'])){
        $skip = intval($_POST['skip']);
    }

    $c = new Comment();

    $result['comments'] = $c->getpostcomments($db_con, $pid, $limit, $skip);
    $result['message'] = "SUCCESS";
    http_response_code(200);
}

print_r(json_encode($result));

?>