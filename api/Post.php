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

    public function getnewestposts($db, $limit, $skip){
        $q = 'SELECT *
              FROM ForumPosts
              ORDER BY id DESC';

        $pre_q = $db->prepare($q);
        $pre_q->execute();

        $posts = array();

        $it_c = 0;
        while($row = $pre_q->fetch(PDO::FETCH_ASSOC)){
            $it_c++;
            if ($it_c <= $skip)
            {
                continue;
            } else if ($it_c > $limit + $skip){
                break;
            }

            $post = new Post();

            $post->id = $row['id'];
            $post->user_id = $row['postedby_id'];
            $post->date_posted = $row['dateposted'];
            $post->title = $row['title'];
            $post->img_url = $row['picture'];
            $post->content = $row['content'];
            $post->board = $row['board'];
            $post->score = $row['score'];

            array_push($posts, $post);
        }

        return $posts;
    }

    public function getuserposts($db, $uid, $limit, $skip){
        $q = 'SELECT *
              FROM ForumPosts
              WHERE postedby_id = ?
              ORDER BY id DESC';

        $pre_q = $db->prepare($q);
        $pre_q->bindParam(1, $uid);
        $pre_q->execute();

        $posts = array();

        $it_c = 0;
        while($row = $pre_q->fetch(PDO::FETCH_ASSOC)){
            $it_c++;
            if ($it_c <= $skip)
            {
                continue;
            } else if ($it_c > $limit + $skip){
                break;
            }

            $post = new Post();

            $post->id = $row['id'];
            $post->user_id = $row['postedby_id'];
            $post->date_posted = $row['dateposted'];
            $post->title = $row['title'];
            $post->img_url = $row['picture'];
            $post->content = $row['content'];
            $post->board = $row['board'];
            $post->score = $row['score'];

            array_push($posts, $post);
        }

        return $posts;
    }

    public function getboardposts($db, $board, $limit, $skip){
        $q = 'SELECT *
              FROM ForumPosts
              WHERE board = ?
              ORDER BY id DESC';

        $pre_q = $db->prepare($q);
        $pre_q->bindParam(1, $board);
        $pre_q->execute();

        $posts = array();

        $it_c = 0;
        while($row = $pre_q->fetch(PDO::FETCH_ASSOC)){
            $it_c++;
            if ($it_c <= $skip)
            {
                continue;
            } else if ($it_c > $limit + $skip){
                break;
            }

            $post = new Post();

            $post->id = $row['id'];
            $post->user_id = $row['postedby_id'];
            $post->date_posted = $row['dateposted'];
            $post->title = $row['title'];
            $post->img_url = $row['picture'];
            $post->content = $row['content'];
            $post->board = $row['board'];
            $post->score = $row['score'];

            array_push($posts, $post);
        }

        return $posts;
    }

    public function search($db, $search_str, $limit, $skip){
        $q = 'SELECT *
              FROM ForumPosts
              WHERE title LIKE ?
              ORDER BY id DESC';

        $posts = array();

        $it_c = 0;

        $tokens = explode(" ", $search_str);
        foreach($tokens as $searchtoken){
            $token = '%'.$searchtoken.'%';

            $pre_q = $db->prepare($q);
            $pre_q->bindParam(1, $token);
            $pre_q->execute();

            while ($row = $pre_q->fetch(PDO::FETCH_ASSOC)){
                $it_c++;
                if ($it_c <= $skip){
                    continue;
                } else if ($it_c > $limit + $skip){
                    break;
                }

                $post = new Post();

                $post->id = $row['id'];
                $post->user_id = $row['postedby_id'];
                $post->date_posted = $row['dateposted'];
                $post->title = $row['title'];
                $post->img_url = $row['picture'];
                $post->content = $row['content'];
                $post->board = $row['board'];
                $post->score = $row['score'];

                array_push($posts, $post);
            }

        }

        return $posts;
    }

    public function create($db, $uid, $title, $img, $content, $board){
        $q = 'INSERT INTO ForumPosts (postedby_id, title, picture, content, board)
              VALUES (?, ?, ?, ?, ?)';

        $pre_q = $db->prepare($q);
        $pre_q->bindParam(1, $uid);
        $pre_q->bindParam(2, $title);
        $pre_q->bindParam(3, $img);
        $pre_q->bindParam(4, $content);
        $pre_q->bindParam(5, $board);
        $pre_q->execute();

        if ($pre_q->rowCount() < 1){
            return false;
        }

        $post = $this->getuserposts($db, $uid, 1, 0)[0];
        $this->id = $post->id;
        $this->user_id = $post->user_id;
        $this->date_posted = $post->date_posted;
        $this->title = $post->title;
        $this->img_url = $post->img_url;
        $this->content = $post->content;
        $this->board = $post->board;
        $this->score = $post->score;

        return true;
    }

    public function delete($db){
        if (!isset($this->id) || empty($this->id)){
            return false;
        }

        $q = 'DELETE FROM ForumPosts
              WHERE id = ?';

        $pre_q = $db->prepare($q);
        $pre_q->bindParam(1, $this->id);
        $pre_q->execute();

        if ($pre_q->rowCount() < 1){
            return false;
        }

        return true;
    }
}

?>