<?php 

include('header.php'); 

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
                <li><a class="highlight-tab" href="adminUsers.php">Manage users</a></li>
                <li><a href="adminComments.php">Manage comments</a></li>
            </ul>
        </div>

        <div class="admin-content">  
            <div class="content-body">
                <h2 class="page-title">Manage users</h2>
                <table>
                    <thead>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th colspan="2">Action</th>
                    </thead>
                    <tfoot>
                        <td colspan="2">
                        <?php
                            if ($first_user > 1){
                                $newskip = (intval($skip) - $limit);
                                if ($newskip < 0){
                                    $newskip = 0;
                                }
                                print_r('<a href="./adminUsers.php?skip='. $newskip .'">Previous Page</a>');
                            }
                        ?>
                        </td><td></td>
                        <td colspan="2">
                        <?php
                            if ($last_user < $total_users){
                                $newskip = (intval($skip) + $limit);
                                if ($newskip < 0){
                                    $newskip = 0;
                                }
                                print_r('<a href="./adminUsers.php?skip='. $newskip .'">Next</a>');
                            }
                        ?>
                        </td>
                    </tfoot>
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
            </div>
            
        </div>

    </main>

<?php include('footer.php'); ?> 