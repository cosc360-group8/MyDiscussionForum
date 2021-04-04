<?php

include_once "../Database.php";
include_once "../Post.php";

header('Content-Type: application/json');

$result = array();
// Checking to ensure that a post ID is supplied
if (!isset($_POST['id']) || empty($_POST['id'])){
    $result['message'] = 'ERROR: ID is not set or empty.';
    http_response_code(400);
} else {

    $p_id = $_POST['id'];

    $db_obj = new Database();
    $db_con = $db_obj->connect();

    $post = new Post();

    if ($post->getpostbyid($db_con, $p_id)){
        $result['message'] = 'SUCCESS.';
        $result['post'] = array(
            'pid' => $p_id,
            'uid' => $post->user_id,
            'date' => $post->date_posted,
            'title' => $post->title,
            'img' => $post->img_url,
            'content' => $post->content,
            'board' => $post->board,
            'score' => $post->score
        );
        http_response_code(200);
    } else {
        http_response_code(404);
        $result['message'] = 'ERROR: No post with specified ID found.';
    }
}

print_r(json_encode($result));
?>