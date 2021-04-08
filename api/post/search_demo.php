<?php

// Including the Database and Post classes
include_once "../Database.php";
include_once "../Post.php";

// Creating a database object
$db_obj = new Database();
// and connecting to the database
// storing the connection object in db_con
$db_con = $db_obj->connect();
// creating a post object
$post = new Post();
// Using the database connection, search for a post that includes "The" in the title.
// Limit the resulting array to 2 posts, and skip the first post.
$posts = $post->search($db_con, "The", 2, 1);
// Print out the result as json
print_r(json_encode($posts));

?>