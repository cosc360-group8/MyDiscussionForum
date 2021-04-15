<?php
include('header.php');

requireAdmin($current_user, './auth/login.php');

include_once $_SERVER['DOCUMENT_ROOT']."/MyDiscussionForum/api/Database.php";
include_once $_SERVER['DOCUMENT_ROOT']."/MyDiscussionForum/api/Post.php";

$db_obj = new Database();
$db_con = $db_obj->connect();

$skip = 0;
$temp_post = new Post();
$posts = $temp_post->getnewestposts($db_con, 5, $skip);

?>

    <main class="admin-wrapper">

        <div class="left-sidebar">
            <ul>
                <li><a href="adminPosts.php">Manage posts</a></li>
                <li><a href="adminUsers.php">Manage users</a></li>
                <li><a href="adminTopics.php">Manage topics</a></li>
            </ul>
        </div>

        <div class="admin-content">
            <!-- <div class="button-group">
                <a href="createPost.php">Add posts</a>
                <a href="#">Manage posts</a>
            </div> -->
            <div class="content-body">
                <h2 class="page-title">Manage posts</h2>
                <table>
                    <thead>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th colspan="3">Action</th>
                    </thead>
                    <tbody>
                    <?php foreach ($posts as $post): ?>
                      <tr>
                        <td><?php echo $post->id; ?></td>
                        <td><?php echo $post->title; ?></td>
                        <td><?php echo $post->user->username; ?></td>
                        <td><a class="edit" href="">Edit</a></td>
                        <td><a class="delete" href="">Delete</a></td>
                      </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        </div>

    </main>

<?php include('footer.php'); ?>