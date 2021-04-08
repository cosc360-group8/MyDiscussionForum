<?php

include_once $_SERVER['DOCUMENT_ROOT']."/MyDiscussionForum/api/Database.php";
include_once $_SERVER['DOCUMENT_ROOT']."/MyDiscussionForum/api/Post.php";

header("Content-Type: application/json");

$result = array();

if (!isset($_POST['limit']) || empty($_POST['limit'])){
    $result['message'] = 'ERROR: Limit is not set or empty';
    http_response_code(400);
} else if (!isset($_POST['uid']) || empty($_POST['uid'])) {
    $result['message'] = 'ERROR: UID is not set or empty';
    http_response_code(400);
} else if (!isset($_POST['skip'])) {
    $result['message'] = 'ERROR: Skip is not set or empty';
    http_response_code(400);
} else {
    $db_obj = new Database();
    $db_con = $db_obj->connect();

    $limit = intval($_POST['limit']);
    $uid = intval($_POST['uid']);
    $skip = 0;
    if (!empty($_POST['skip'])){
        $skip = intval($_POST['skip']);
    }

    $post = new Post();

    $result['posts'] = $post->getuserposts($db_con, $uid, $limit, $skip);
    $result['message'] = "SUCCESS.";
    http_response_code(200);
}

print_r(json_encode($result));

?>