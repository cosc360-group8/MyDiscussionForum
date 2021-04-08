<?php

// Including the Database and Comment classes
include_once "../Database.php";
include_once "../Comment.php";

// Creating a database object
$db_obj = new Database();
// and connecting to the database
// storing the connection object in db_con
$db_con = $db_obj->connect();
// creating a comment object
$c = new Comment();
// Creating a new comment using the database connection where
// the first 3 is the user id of the user who is creating the comment
// the second 3 is the post id on which the comment is created
// the content of the comemnt is "Wow. ... post!!"
// Comment->create(.) returns true if the comment was successfully created. Otherwise, it will return false.
if ($c->create($db_con, 3, 3, "Wow. What a post!!")){
    // If the comment creation was successful, print out the details of the comment
    print_r(json_encode($c));
    // waiting for 10 seconds
    sleep(10);
    // tries to delete the comment that was just created
    // returns true if the deletion was successful
    if(!$c->delete($db_con)){
        // if the comment delete fails, an error is displayed.
        print_r("\ncomment delete unsuccessful");
    }
} else {
    // Otherwise, print out an error.
    print_r("couldn't create comment");
}