<?php

class Post {
    public $id;
    public $user_id;
    public $date_posted;
    public $title;
    public $img_url;
    public $content;
    public $board;
    public $score;

    // Gets the post with a specific ID
    // Returns true if there is a post with that ID
    // Returns false otherwise
    public function getpostbyid($db_connection, $id){
        // SQL query to select a post by its id from the database
        $q = 'SELECT postedby_id, dateposted, title, picture, content, board, score
              FROM ForumPosts
              WHERE id = ?
              LIMIT 1';

        // Prepare the SQL query
        $pre_q = $db_connection->prepare($q);
        // Ensure that the WHERE id = ? part is replaced with
        // WHERE id = $id
        $pre_q->bindParam(1, $id);
        // Then execute the SQL query
        $pre_q->execute();

        // checking if there is a match
        if ($pre_q->rowCount() < 1){
            // if there isn't, we return false to indicate this
            return false;
        }

        // If there is a match, we get that row
        $row = $pre_q->fetch(PDO::FETCH_ASSOC);

        // And assign the resulting columns to the appropriate member variables
        $this->id = $id;
        $this->user_id = $row['postedby_id'];
        $this->date_posted = $row['dateposted'];
        $this->title = $row['title'];
        $this->img_url = $row['picture'];
        $this->content = $row['content'];
        $this->board = $row['board'];
        $this->score = $row['score'];
        // We then indicate that the query was successful by returning true
        return true;
    }
}

?>