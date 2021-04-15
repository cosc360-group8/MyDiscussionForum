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

$userId = 2; //test

$temp_post = new Post();
$posts = $temp_post->getuserposts($db_con,2, 25, $skip);


?>

    <main class="flex-container">
        <div class="blog-posts">     <!-- blog-posts consists of posts from different threads -->
                <?php

                foreach($posts as $post){
                    $post->board_html();
                }

                ?>
            </div>
        <aside class="side-bar post-content" id="profile-wrapper">
            <h1>Ed Chambers</h1>
            <img class="avatar" src="images/avatar.jpg" alt="">
            <p>Software developer and enthusiast of Virtual Reality technologies.</p>
        </aside>
    </main>

<?php include('footer.php'); ?>