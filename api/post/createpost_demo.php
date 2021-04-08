<?php

// Including the Database and Post classes
include_once $_SERVER['DOCUMENT_ROOT']."/MyDiscussionForum/api/Database.php";
include_once $_SERVER['DOCUMENT_ROOT']."/MyDiscussionForum/api/Post.php";

// Creating a database object
$db_obj = new Database();
// and connecting to the database
// storing the connection object in db_con
$db_con = $db_obj->connect();
// creating a post object
$post = new Post();
// Creating a new post using the database connection where
// 3 is the user id of the user who is creating the post
// the title of the post is "A test ... image"
// the image url is empty
// the content of the post is "this ... post"
// the board is /test.
// Post->create(.) returns true if the post was successfully created. Otherwise, it will return false.
if ($post->create($db_con, 3, "A test post with no image", "", "this is a test post", "test")){
    // If the post creation was successful, print out the details of the post
    print_r(json_encode($post));
    // waiting for 10 seconds
    sleep(10);
    // tries to delete the post that was just created
    // returns true if the deletion was successful
    if(!$post->delete($db_con)){
        // if the post delete fails, an error is displayed.
        print_r("\npost delete unsuccessful");
    }
} else {
    // Otherwise, print out an error.
    print_r("post creation unsuccessful");
}

?>