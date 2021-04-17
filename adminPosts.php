<?php
include('header.php');

$limit = 10;

requireAdmin($current_user, './auth/login.php');

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

$temp_post = new Post();
$posts = $temp_post->getnewestposts($db_con, $limit, $skip);
$total_posts = $temp_post->lastrowcount;
$first_post = $skip + 1;
$last_post = $skip + count($posts);
?>

    <main class="admin-wrapper">

        <div class="left-sidebar">
            <ul>
                <li><a class="highlight-tab" href="adminPosts.php">Manage posts</a></li>
                <li><a href="adminUsers.php">Manage users</a></li>
                <li><a href="adminComments.php">Manage comments</a></li>
            </ul>
        </div>

        <div class="admin-content">
            <div class="content-body">
                <h2 class="page-title">Manage posts</h2>
                <table>
                    <thead>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Action</th>
                    </thead>
                    <tfoot>
                        <td colspan="2">
                        <?php
                            if ($first_post > 1){
                                $newskip = (intval($skip) - $limit);
                                if ($newskip < 0){
                                    $newskip = 0;
                                }
                                print_r('<a href="./adminPosts.php?skip='. $newskip .'">Previous Page</a>');
                            }
                        ?>
                        </td>
                        <td colspan="2">
                        <?php
                            if ($last_post < $total_posts){
                                $newskip = (intval($skip) + $limit);
                                if ($newskip < 0){
                                    $newskip = 0;
                                }
                                print_r('<a href="./adminPosts.php?skip='. $newskip .'">Next</a>');
                            }
                        ?>
                        </td>
                    </tfoot>
                    <tbody>
                    <?php foreach ($posts as $post): ?>
                      <tr>
                        <td><?php echo $post->id; ?></td>
                        <td><?php echo $post->title; ?></td>
                        <td><?php echo $post->user->username; ?></td>
                        <td><a class="delete" href="./api/post/delete.php?id=<?php print_r($post->id); ?>">Delete</a></td>
                      </tr>
                    <?php endforeach;
                    ?>

                    
                    </tbody>
                </table>
            </div>

        </div>

    </main>

<?php include('footer.php'); ?>