<?php

class Database {
    private $host = 'localhost';
    private $db = 'DiscForum';
    private $user = 'phpmyadmin';
    private $pass = 'wUhZ#mNB"f97MG<:';
    private $connection;

    public function connect($verbose = false) : PDO {
        $this->connection = null;

        $connstr = 'mysql:host='.$this->host.';dbname='.$this->db;

        try {
            $this->connection = new PDO($connstr, $this->user, $this->pass);
            if ($verbose === true){
                echo 'Successfully connected to the database!';
            }
            return $this->connection;
        } catch(PDOException $e){
            if ($verbose === true){
                echo $e->getMessage();
            }
            return null;
        }
    }
}

?>