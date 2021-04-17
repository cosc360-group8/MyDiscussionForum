<?php 

include('header.php'); 

include_once $_SERVER['DOCUMENT_ROOT']."/MyDiscussionForum/api/Comment.php";

$limit = 10;

requireAdmin($current_user, './auth/login.php');

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

$temp_comment = new Comment();
$comments = $temp_comment->getcomments($db_con, $limit, $skip);
$total_comments = $temp_comment->lastrowcount;
$first_comment = $skip + 1;
$last_comment = $skip + count($comments);

?>

<main class="admin-wrapper">
    <div class="left-sidebar">
        <ul>
            <li><a href="adminPosts.php">Manage posts</a></li>
            <li><a href="adminUsers.php">Manage users</a></li>
            <li><a href="adminComments.php" class="highlight-tab">Manage comments</a></li>
        </ul>
    </div>

    <div class="admin-content">
        <div class="content-body">
            <h2 class="page-title">Manage comments</h2>
            <table>
                <thead>
                    <th>ID</th>
                    <th>Author</th>
                    <th>Content</th>
                    <th>Date Created</th>
                    <th>Action</th>
                </thead>
                <tfoot>
                        <td colspan="2">
                        <?php
                            if ($first_comment > 1){
                                $newskip = (intval($skip) - $limit);
                                if ($newskip < 0){
                                    $newskip = 0;
                                }
                                print_r('<a href="./adminComments.php?skip='. $newskip .'">Previous Page</a>');
                            }
                        ?>
                        </td><td></td>
                        <td colspan="2">
                        <?php
                            if ($last_comment < $total_comments){
                                $newskip = (intval($skip) + $limit);
                                if ($newskip < 0){
                                    $newskip = 0;
                                }
                                print_r('<a href="./adminComments.php?skip='. $newskip .'">Next Page</a>');
                            }
                        ?>
                        </td>
                    </tfoot>
                <tbody>
                    <?php
                        foreach($comments as $comment){
                            ?>
                                <tr>
                                    <td><?php print_r($comment->id); ?></td>
                                    <td><?php print_r($comment->user->username); ?></td>
                                    <td><?php print_r($comment->content); ?></td>
                                    <td><?php print_r(date("Y-m-d h:i:sa", $comment->dateposted));?></td>
                                    <td><a class="delete" href="./api/comment/delete.php?id=<?php print_r($comment->id); ?>">Delete</a></td>
                                </tr>
                            <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</main>