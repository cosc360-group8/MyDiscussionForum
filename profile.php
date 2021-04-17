<?php 

include('header.php');

$limit = 1;

include_once $_SERVER['DOCUMENT_ROOT']."/MyDiscussionForum/api/Database.php";
include_once $_SERVER['DOCUMENT_ROOT']."/MyDiscussionForum/api/Post.php";
include_once $_SERVER['DOCUMENT_ROOT']."/MyDiscussionForum/api/User.php";

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

if (!isset($_GET['id']) || empty($_GET['id'])){
    header("Location: ./index.php");
}

$id = intval($_GET['id']);

$u = new User();
if (!$u->getuserbyid($db_con, $id)){
    print_r('<script> alert("This user does not exist"); </script>');
    header("Location: ./index.php");
}

$temp_post = new Post();
$posts = $temp_post->getuserposts($db_con, $id, $limit, $skip);
$total_posts = $temp_post->lastrowcount;
$first_post = $skip + 1;
$last_post = $skip + count($posts);

?>

    <main class="flex-container">
        <div class="blog-posts">     <!-- blog-posts consists of posts from different threads -->
                <?php

                foreach($posts as $post){
                    $post->board_html();
                }

                print_r("<br/><br/>");

                if ($first_post > 1){
                    $newskip = intval($skip - $limit);
                    if ($newskip < 0){
                        $newskip = 0;
                    }
                    print_r('<a href="./profile.php?id='.$id.'&skip='.$newskip.'">Previous</a>');
                }

                if ($last_post < $total_posts){
                    $newskip = intval($skip + $limit);
                    if ($newskip < 0){
                        $newskip = 0;
                    }
                    print_r('<a href="./profile.php?id='.$id.'&skip='.$newskip.'">Next</a>');
                }

                ?>
            </div>
        <aside class="side-bar post-content" id="profile-wrapper">
            <?php
                echo "<h1>".$u->username."</h1>";
                echo "<h3>".$u->fname." ".$u->lname."</h3>";
                echo "<img class=\"avatar\" src=\"".$u->profile_img."\" alt=\"\">";
                echo "<p>Member for ".timesince_short($u->created_on)."</p>";
                if ($current_user->id == $u->id){
                    echo '<a href="./editprofile.php">Edit</a>';
                }
            ?>
        </aside>
    </main>

<?php include('footer.php'); ?>