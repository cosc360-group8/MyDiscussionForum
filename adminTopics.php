<?php include('header.php'); ?>

    <main class="admin-wrapper">

        <div class="left-sidebar">
            <ul>
                <li><a href="admin.php">Manage posts</a></li>
                <li><a href="#">Manage users</a></li>
                <li><a href="">Manage topics</a></li>
            </ul>
        </div>

        <div class="admin-content">  
            <div class="button-group">
                <a href="#">Add users</a> <!-- missing html -->
                <a href="#">Manage users</a>
            </div>
            <div class="content-body">
                <h2 class="page-title">Manage users</h2>
                <table>
                    <thead>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th colspan="3">Action</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>ed1782</td>
                            <td>edchambers@hotmail.com</td>
                            <td><a class="edit" href="">Edit</a></td>
                            <td><a class="delete" href="">Delete</a></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>jsmith26</td>
                            <td>jsmith26@gmail.com</td>
                            <td><a class="edit" href="">Edit</a></td>
                            <td><a class="delete" href="">Delete</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
        </div>

    </main>

<?php include('footer.php'); ?> 