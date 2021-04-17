<?php
include('header.php');

$limit = 2;

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

$search = null;
if (isset($_GET['search'])){
    if(!empty($_GET['search'])){
        $search = $_GET['search'];
    }
}

$temp_post = new Post();
$posts = null;
if (isset($board)){
    $posts = $temp_post->getboardposts($db_con, $board, $limit, $skip);
} else if (isset($search)){
    $posts = $temp_post->search($db_con, $search, $limit, $skip);
} else {
    $posts = $temp_post->getnewestposts($db_con, $limit, $skip);
}
$total_posts = $temp_post->lastrowcount;
$first_post = $skip + 1;
$last_post = count($posts) + $skip;

?>
    <main class="flex-container">
        <div class="blog-posts"> <!-- blog-posts consists of posts from different threads -->
            <?php

            foreach($posts as $post){
                $post->board_html();
            }

            print_r("<br/><br/>");

            if ($first_post > 1){
                $newskip = (intval($skip) - $limit);
                if ($newskip < 0){
                    $newskip = 0;
                }
                if (isset($board)){
                    print_r('<a href="./index.php?board='.$board.'&skip='. $newskip .'">Previous</a>');
                } else if (isset($search)){
                    print_r('<a href="./index.php?search='.$board.'&skip='. $newskip .'">Previous</a>');
                } else {
                    print_r('<a href="./index.php?skip='. $newskip .'">Previous</a>');
                }
                
            }

            if ($last_post < $total_posts){
                $newskip = (intval($skip) + $limit);
                if ($newskip < 0){
                    $newskip = 0;
                }
                if (isset($board)){
                    print_r('<a href="./index.php?board='.$board.'&skip='. $newskip .'">Previous</a>');
                } else if (isset($search)){
                    print_r('<a href="./index.php?search='.$board.'&skip='. $newskip .'">Previous</a>');
                } else {
                    print_r('<a href="./index.php?skip='. $newskip .'">Next</a>');
                }
            }

            ?>
        </div>
    </main>

<?php include('footer.php'); ?>