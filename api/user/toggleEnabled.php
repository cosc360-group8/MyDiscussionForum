<?php

include_once $_SERVER['DOCUMENT_ROOT']."/MyDiscussionForum/api/Database.php";
include_once $_SERVER['DOCUMENT_ROOT']."/MyDiscussionForum/api/User.php";

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