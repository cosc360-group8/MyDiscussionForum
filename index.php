<?php

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

include('header.php');
?>
    <main class="flex-container">
        <div class="blog-posts">     <!-- blog-posts consists of posts from different threads -->
            <?php

            foreach($posts as $post){
                $post->board_html();
            }

            ?>
            <!--<div class="post-content">
                <h2 class="thread">/football</h2>
                <div class="post-info">
                    <\!-- <span>Sunday</span> --\>
                    <span>4 hours ago</span>
                </div>
                <h1 class="post-title">The situation at Barcelona</h1>
                <figure class="post-pic">
                    <img src="images\fcb.webp" title="The situation at Barcelona"  />
                </figure>
                <span class="publisher">by boi1da</span>
                <p class="post-text">
                   Lorem ipsum dolor sit, amet consectetur adipisicing elit. Repellendus pariatur incidunt iste inventore sequi
                   tempora at ipsa quia deleniti necessitatibus ad enim illo corrupti esse commodi praesentium sunt,
                   tenetur repudiandae.
                </p>
                <\!-- <a href="#" class="post-cta">Read more</a> --\>
            </div> --\>

            <div class="post-content">
                <h2 class="thread">/astronomy</h2>
                <div class="post-info">
                    <\!-- <span>Sunday</span> --\>
                    <span>7 hours ago</span>
                </div>
                <h1 class="post-title">What is the purpose of the James Webb Telescope?</h1>
                <figure class="post-pic">
                    <img src="images\jwt.jpg" title="What is the purpose of the James Webb Telescope?"  />
                </figure>
                <span class="publisher">by bron_234</span>
                <p class="post-text">
                   Lorem ipsum dolor sit, amet consectetur adipisicing elit. Repellendus pariatur incidunt iste inventore sequi
                   tempora at ipsa quia deleniti necessitatibus ad enim illo corrupti esse commodi praesentium sunt,
                   tenetur repudiandae.
                </p>
                <\!-- <a href="#" class="post-cta">Read more</a> --\>
            </div>

            <div class="post-content">
                <h2 class="thread">/movies</h2>
                <div class="post-info">
                    <\!-- <span>Saturday</span> --\>
                    <span>1 day ago</span>
                </div>
                <h1 class="post-title">My thoughts on Inception's ending</h1>
                <figure class="post-pic">
                    <img src="images\movie.jpg" title="My thoughts on Inception's ending"  />
                </figure>
                <span class="publisher">by jack_olantern</span>
                <p class="post-text">
                   Lorem ipsum dolor sit, amet consectetur adipisicing elit. Repellendus pariatur incidunt iste inventore sequi
                   tempora at ipsa quia deleniti necessitatibus ad enim illo corrupti esse commodi praesentium sunt,
                   tenetur repudiandae.
                </p>
            </div>-->
        </div>

        <aside class="side-bar post-content">
            <h1>Trending</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Et dignissimos sint fugit delectus, eligendi quos perferendis nisi deleniti dolorem possimus aliquam provident culpa nobis neque ratione quo consectetur est iste.</p>
        </aside>
    </main>

<?php include('footer.php'); ?>