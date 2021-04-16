<?php
include('header.php');

include_once $_SERVER['DOCUMENT_ROOT']."/MyDiscussionForum/api/Database.php";
include_once $_SERVER['DOCUMENT_ROOT']."/MyDiscussionForum/api/Post.php";

$db_obj = new Database();
$db_con = $db_obj->connect();

$skip = 0;
if (isset($_GET['skip'])){
    if (!empty($_GET['skip'])){
        $skip = intval($_GET['skip']);
        if ($skip < 0){
            $skip = 0;
        }
    }
}

$board = null;
if (isset($_GET['board'])){
    if(!empty($_GET['board'])){
        $board = $_GET['board'];
    }
}

$temp_post = new Post();
$posts = null;
if (isset($board)){
    $posts = $temp_post->getboardposts($db_con, $board, 10, $skip);
} else {
    $posts = $temp_post->getnewestposts($db_con, 10, $skip);
}

?>
    <main class="flex-container">
        <div class="blog-posts"> <!-- blog-posts consists of posts from different threads -->
            <?php

            foreach($posts as $post){
                $post->board_html();
            }

            ?>
        </div>
    </main>

<?php include('footer.php'); ?>