<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    // this file is only made for testing purposes and would be deleted.

    echo $_POST["email"]." ".$_POST["password"];
  /*  include_once $_SERVER['DOCUMENT_ROOT']."/MyDiscussionForum/api/Database.php";
    include_once $_SERVER['DOCUMENT_ROOT']."/MyDiscussionForum/api/User.php";
    $db = new Database();
    $user = new User();
    $dbConnect = $db->connect();

    $email = $_POST["email"];
    $password = $_POST["password"];

    $user->login($db, $email, $password); */

?>
</body>
</html>