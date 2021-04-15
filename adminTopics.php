<?php

include('header.php'); 

requireAdmin($current_user, './auth/login.php');

include_once $_SERVER['DOCUMENT_ROOT']."/MyDiscussionForum/api/Database.php";
include_once $_SERVER['DOCUMENT_ROOT']."/MyDiscussionForum/api/User.php";

$db_obj = new Database();
$db_con = $db_obj->connect();

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
                <a href="#">Add users</a> 
                <a href="#">Manage users</a>
            </div> -->
            <div class="content-body">
                <h2 class="page-title">Manage topics</h2>
                <table>
                    <thead>
                        <th>ID</th>
                        <th>Title</th>
                        <th colspan="3">Action</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>sport</td>
                            <td><a class="edit" href="">Edit</a></td>
                            <td><a class="delete" href="">Delete</a></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>movies</td>
                            <td><a class="edit" href="">Edit</a></td>
                            <td><a class="delete" href="">Delete</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
        </div>

    </main>

<?php include('footer.php'); ?> 