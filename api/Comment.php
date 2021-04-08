<?php

class Comment {
    public $id;
    public $uid;
    public $pid;
    public $dateposted;
    public $content;
    public $score;

    public function getcommentbyid($db, $id){
        $q = 'SELECT *
              FROM ForumComments
              where id = ?
              LIMIT 1';

        $pre_q = $db->prepare($q);
        $pre_q->bindParam(1, $id);
        $pre_q->execute();

        if ($pre_q->rowCount() < 1){
            return false;
        }

        $row = $pre_q->fetch(PDO::FETCH_ASSOC);

        $this->id = $row['id'];
        $this->uid = $row['postedby_id'];
        $this->pid = $row['parentpost_id'];
        $this->dateposted = $row['dateposted'];
        $this->content = $row['content'];
        $this->score = $row['score'];

        return true;
    }

    public function getpostcomments($db, $pid, $limit, $skip){
        $q = 'SELECT *
              FROM ForumComments
              WHERE parentpost_id = ?
              ORDER BY id DESC';

        $pre_q = $db->prepare($q);
        $pre_q->bindParam(1, $pid);
        $pre_q->execute();

        $comments = array();

        $it_c = 0;
        while($row = $pre_q->fetch(PDO::FETCH_ASSOC)){
            $it_c++;
            if ($it_c <= $skip){
                continue;
            } else if ($it_c > $limit + $skip){
                break;
            }

            $c = new Comment();

            $c->id = $row['id'];
            $c->pid = $row['parentpost_id'];
            $c->uid = $row['postedby_id'];
            $c->dateposted = $row['dateposted'];
            $c->content = $row['content'];
            $c->score = $row['score'];

            array_push($comments, $c);
        }

        return $comments;
    }

    public function getusercomments($db, $uid, $limit, $skip){
        $q = 'SELECT *
              FROM ForumComments
              WHERE postedby_id = ?
              ORDER BY id DESC';

        $pre_q = $db->prepare($q);
        $pre_q->bindParam(1, $uid);
        $pre_q->execute();

        $comments = array();

        $it_c = 0;
        while($row = $pre_q->fetch(PDO::FETCH_ASSOC)){
            $it_c++;
            if ($it_c <= $skip){
                continue;
            } else if ($it_c > $limit + $skip){
                break;
            }

            $c = new Comment();

            $c->id = $row['id'];
            $c->pid = $row['parentpost_id'];
            $c->uid = $row['postedby_id'];
            $c->dateposted = $row['dateposted'];
            $c->content = $row['content'];
            $c->score = $row['score'];

            array_push($comments, $c);
        }

        return $comments;
    }

    public function create($db, $uid, $pid, $content){
        $q = 'INSERT INTO ForumComments (postedby_id, parentpost_id, content)
              VALUES (?, ?, ?)';

        $pre_q = $db->prepare($q);
        $pre_q->bindParam(1, $uid);
        $pre_q->bindParam(2, $pid);
        $pre_q->bindParam(3, $content);
        $pre_q->execute();

        if($pre_q->rowCount() < 1){
            return false;
        }

        $c = $this->getusercomments($db, $uid, 1, 0)[0];
        $this->id = $c->id;
        $this->pid = $c->pid;
        $this->uid = $c->uid;
        $this->content = $c->content;
        $this->dateposted = $c->dateposted;
        $this->score = $c->score;

        return true;
    }

    public function delete($db){
        if (!isset($this->id) || empty($this->id)){
            return false;
        }

        $q = 'DELETE FROM ForumComments
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