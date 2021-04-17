<?php
session_start();

include_once $_SERVER['DOCUMENT_ROOT']."/MyDiscussionForum/api/utils.php";
include_once $_SERVER['DOCUMENT_ROOT']."/MyDiscussionForum/api/Database.php";
include_once $_SERVER['DOCUMENT_ROOT']."/MyDiscussionForum/api/User.php";

$db_obj = new Database();
$db_con = $db_obj->connect();

$current_user = null;
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == 1 && isset($_SESSION['user'])){
    $current_user = unserialize((base64_decode($_SESSION['user'])));

    if ($current_user->enabled == 0){
        $_SESSION['loggedin'] = 0;
        $_SESSION['user'] = null;
        print_r('<script> alert("The account you have been using was disabled by an admin."); </script>');
    }
}

if (!isset($_SESSION['loggedin'])){
    $_SESSION['loggedin'] = 0;
}

if ($_SESSION['loggedin'] == 1){
    $uid = $current_user->id;
    $u = new User();
    if ($u->getuserbyid($db_con, $uid)){
        $current_user = $u;
        $_SESSION['user'] = base64_encode(serialize($current_user));
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyDiscussionForum</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/preview.css">
    <link rel="stylesheet" href="css/form.css">
    <link rel="stylesheet" href="css/post.css">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/profile.css">

    <script type="text/javascript" src="js/main.js"></script>

</head>
<body>
    <nav>
       <div class="logo">
           <a href="index.php"><h4>MDF&reg;</h4></a>
       </div>
       <ul class="nav-links">
           <li>
               <a href="index.php">Home</a>
           </li>
           <?php
            if ($_SESSION['loggedin'] == 1) {
           ?> 
           <li>
               <a href="createPost.php">Create Post</a>
           </li>
           <li>
            <a href="profile.php?id=<?php print_r($current_user->id); ?>">Profile</a>
           </li>
           <?php
                if (isset($current_user) && $current_user->admin == 1){
            ?>

                <li>
                    <a href="./adminUsers.php">Admin</a>
                </li>
                <!-- <li>
                    <a href="./adminTopics.php">(OP) Topics</a>
                </li>
                <li>
                    <a href="./adminPosts.php">(OP) Posts</a>
                </li> -->
            <?php
                }
                ?>

                <li>
                    <a href="./api/user/logout.php">Logout</a>
            </li>

            <?php
            
            } else {
           ?>
            <li>
                <a href="./auth/login.php">Login</a>
            </li>
            <li>
                <a href="./auth/signup.php">Sign Up</a>
            </li>
            
           <?php
            }
           ?>
           <li>
                <form method="GET" action="index.php">
                <input id="search-bar" name="search" type="text" placeholder="Find a post">
                </form>
            </li>
       </ul>
       <div class="burger">
           <div class="line1"></div>
           <div class="line2"></div>
           <div class="line3"></div>
       </div>
    </nav>
