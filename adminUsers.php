<?php 

include('header.php'); 

$limit = 1;

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

$temp_user = new User();
$users = $temp_user->getusers($db_con, $limit, $skip);
$total_users = $temp_user->lastrowcount;
$first_user = $skip + 1;
$last_user = $skip + count($users);

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
                <?php
                    print_r("<br/><br/>");

                    if ($first_user > 1){
                        $newskip = (intval($skip) - $limit);
                        if ($newskip < 0){
                            $newskip = 0;
                        }
                        print_r('<a href="./adminUsers.php?skip='. $newskip .'">Previous</a>');
                    }

                    if ($last_user < $total_users){
                        $newskip = (intval($skip) + $limit);
                        if ($newskip < 0){
                            $newskip = 0;
                        }
                        print_r('<a href="./adminUsers.php?skip='. $newskip .'">Next</a>');
                    }
                ?>
            </div>
            
        </div>

    </main>

<?php include('footer.php'); ?> 