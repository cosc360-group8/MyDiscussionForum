<?php

include_once "../Database.php";
include_once "../Post.php";

header("Content-Type: application/json");

$result = array();

if (!isset($_POST['limit']) || empty($_POST['limit'])){
    $result['message'] = 'ERROR: Limit is not set or empty';
    http_response_code(400);
} else if (!isset($_POST['board']) || empty($_POST['board'])) {
    $result['message'] = 'ERROR: Board is not set or empty';
    http_response_code(400);
} else if (!isset($_POST['skip'])) {
    $result['message'] = 'ERROR: Skip is not set or empty';
    http_response_code(400);
} else {
    $db_obj = new Database();
    $db_con = $db_obj->connect();

    $limit = intval($_POST['limit']);
    $board = $_POST['board'];
    $skip = 0;
    if (!empty($_POST['skip'])){
        $skip = intval($_POST['skip']);
    }

    $post = new Post();

    $result['posts'] = $post->getboardposts($db_con, $board, $limit, $skip);
    $result['message'] = "SUCCESS.";
    http_response_code(200);
}

print_r(json_encode($result));

?>