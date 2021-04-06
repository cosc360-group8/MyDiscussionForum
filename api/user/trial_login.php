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

    include_once "../Database.php";
    include_once "../User.php";
    $db = new Database();
    $user = new User();
    $dbConnect = $db->connect();

    $email = $_POST["email"];
    $password = $_POST["password"];

    echo "<title>login</title>";
    echo $_POST["email"]." ".$_POST["password"];

?>
</body>
</html>