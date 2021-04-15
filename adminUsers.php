<?php include('header.php'); ?>

<?php

include_once $_SERVER['DOCUMENT_ROOT']."/MyDiscussionForum/api/Database.php";
include_once $_SERVER['DOCUMENT_ROOT']."/MyDiscussionForum/api/User.php";

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

$temp_user = new User();
$users = $temp_user->getusers($db_con, 25, $skip);

?>

    <main class="admin-wrapper">

        <div class="left-sidebar">
            <ul>
                <li><a href="adminDefault.php">Manage posts</a></li>
                <li><a href="#">Manage users</a></li>
                <li><a href="">Manage topics</a></li>
            </ul>
        </div>

        <div class="admin-content">  
            <!--<div class="button-group">
                <a href="#">Add users</a> </!-- missing html --/>
                <a href="#">Manage users</a>
            </div>-->
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
                        <!--<tr>
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
                        </tr>-->

                        <?php

                            foreach ($users as $user){
                                $outstr = '<tr><td>';
                                $outstr .= $user->id;
                                $outstr .= '</td><td>';
                                $outstr .= $user->username;
                                $outstr .= '</td><td>';
                                $outstr .= $user->email;
                                $outstr .= '</td><td>';
                                //$outstr .= '<a class="edit" href="">Edit</a></td><td><a class="delete" href="">Delete</a></td></tr>';
                                if ($user->admin == 1){
                                    $outstr .= '<a class="edit" href="./api/user/toggleAdmin.php?id='.$user->id.'">Remove Admin</a></td><td>';
                                } else {
                                    $outstr .= '<a class="edit" href="./api/user/toggleAdmin.php?id='.$user->id.'">Make Admin</a></td><td>';
                                }
                                if ($user->enabled == 1){
                                    $outstr .= '<a class="delete" href="./api/user/toggleEnabled.php?id='.$user->id.'">Disable</a></td></tr>';
                                } else {
                                    $outstr .= '<a class="delete" href="./api/user/toggleEnabled.php?id='.$user->id.'">Enable</a></td></tr>';
                                }

                                print_r($outstr);
                            }

                        ?>
                    </tbody>
                </table>
            </div>
            
        </div>

    </main>

<?php include('footer.php'); ?> 