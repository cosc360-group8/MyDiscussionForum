<?php
session_start();

include_once $_SERVER['DOCUMENT_ROOT']."/MyDiscussionForum/api/utils.php";
include_once $_SERVER['DOCUMENT_ROOT']."/MyDiscussionForum/api/Database.php";
include_once $_SERVER['DOCUMENT_ROOT']."/MyDiscussionForum/api/User.php";

$current_user = null;
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == 1 && isset($_SESSION['user'])){
    $current_user = unserialize((base64_decode($_SESSION['user'])));

    if ($current_user->enabled == 0){
        $_SESSION['loggedin'] = 0;
        $_SESSION['user'] = null;
        print_r('<script> alert("The account you have been using was disabled by an admin."); </script>');
    }
}

requireAdmin($current_user, '../../auth/login.php');

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = intval($_GET['id']);

    $db_obj = new Database();
    $db_con = $db_obj->connect();

    $u = new User();

    if ($u->getuserbyid($db_con, $id)){
        $u->toggleEnabled($db_con);
    }
}

header('Location: ../../adminUsers.php');
?>