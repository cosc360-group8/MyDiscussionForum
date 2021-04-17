<?php 

include('header.php');

include_once $_SERVER['DOCUMENT_ROOT']."/MyDiscussionForum/api/Database.php";
include_once $_SERVER['DOCUMENT_ROOT']."/MyDiscussionForum/api/Post.php";

requireLogin($current_user, './auth/login.php');

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

$temp_post = new Post();
$posts = $temp_post->getuserposts($db_con, $current_user->id, 25, $skip);

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
            <?php
                echo "<h1>".$current_user->username."</h1>";
                echo "<img class=\"avatar\" src=\"".$current_user->profile_img."\" alt=\"\">";
                echo "<p>Software developer and enthusiast of Virtual Reality technologies.</p>";
            ?>
        </aside>
    </main>

<?php include('footer.php'); ?>