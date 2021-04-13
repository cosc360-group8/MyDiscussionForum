<?php include('header.php'); ?>

    <main class="admin-wrapper">

        <div class="left-sidebar">
            <ul>
                <li><a href="#">Manage posts</a></li>
                <li><a href="admin-users.php">Manage users</a></li>
                <li><a href="">Manage topics</a></li>
            </ul>
        </div>

        <div class="admin-content">  
            <div class="button-group">
                <a href="createPost.php">Add posts</a>
                <a href="#">Manage posts</a>
            </div>
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
                        <tr>
                            <td>1</td>
                            <td>Tenet Review</td>
                            <td>Ed Chambers</td>
                            <td><a class="edit" href="">Edit</a></td>
                            <td><a class="delete" href="">Delete</a></td>
                            <!-- <td><a class="publish" href="">Publish</a></td> -->
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Situation at Barcelona</td>
                            <td>John Smith</td>
                            <td><a class="edit" href="">Edit</a></td>
                            <td><a class="delete" href="">Delete</a></td>
                            <!-- <td><a class="publish" href="">Publish</a></td> -->
                        </tr>
                    </tbody>
                </table>
            </div>
            
        </div>

    </main>

<?php include('footer.php'); ?> 