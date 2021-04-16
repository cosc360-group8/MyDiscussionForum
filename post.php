<?php include('header.php'); 

include_once $_SERVER['DOCUMENT_ROOT']."/MyDiscussionForum/api/Post.php";
include_once $_SERVER['DOCUMENT_ROOT']."/MyDiscussionForum/api/Comment.php";

if (!isset($_GET['id'])){
    header('Location: ./index.php');
}

$pid = intval($_GET['id']);

$db_obj = new Database();
$db_con = $db_obj->connect();

$post = new Post();

if (!$post->getpostbyid($db_con, $pid)){
    header('Location: ./index.php');
}

$skip = 0;
if (isset($_GET['skip'])){
    if (!empty($_GET['skip'])){
        $skip = intval($_GET['skip']);
        if ($skip < 0){
            $skip = 0;
        }
    }
}

$temp_comment = new Comment();
$comments = $temp_comment->getpostcomments($db_con, $post->id, 25, $skip);

?>
    <main class="flex-container">
        <div class="blog-posts">     <!-- blog-posts consists of posts from different threads -->
            <div class="post-content">
                <h2 class="thread"><?php print_r('<a href="./index.php?board='.$post->board.'">/'.$post->board.'</a>'); ?></h2>
                <div class="post-info">
                    <span><?php print_r(timesince($post->date_posted)); ?></span>
                </div>
                <h1 class="post-title"><?php print_r($post->title); ?></h1>
                <figure class="post-pic">
                    <img src="<?php print_r($post->img_url); ?>" title="<?php print_r($post->title); ?>"  />
                </figure>
                <span class="publisher">by <?php print_r($post->user->username); ?></span>
                <p class="post-text">
                   <?php print_r($post->content); ?>
                </p>
            </div>

            <div class="comment-wrapper">
            <?php 
                if (isset($current_user)){

                    ?>
                <form action="./api/comment/create.php" method="POST" class="form">
                    <div class="input-group">
                        <label for="comment">Comment</label><br>
                        <textarea id="comment" name="comment" placeholder="Enter your comment" required></textarea>
                    </div>
                    <input type="hidden" name="pid" value="<?php print_r($post->id); ?>" />
                    <div style="text-align: center;">
                        <input class="buttons" type="submit" value="Submit">  
                    </div> 
                </form>
                <?php
                }
                ?>
                <div class="prev-comments">
                    <?php
                        //print_r($comments);
                        foreach($comments as $c){
                            $outstr = '<div class="single-items"><h4>';
                            $outstr .= $c->user->username;
                            $outstr .= '</h4><p>';
                            $outstr .= $c->content;
                            $outstr .= '</p></div>';
                            print_r($outstr);
                        }
                    ?>
                </div>
            </div>
        </div>
    </main>
<?php include('footer.php'); ?>