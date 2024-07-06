<?php
/**
 * Avoid direct access  
 */
if ( ! defined('SECURE_ACCESS') ) {
    die('Direct access not permitted');
}

include_once 'config/config.php';

class Database{
    private $host = HOST;

    private $user = USER;

    private $password = PASSWORD;

    private $db = DB;

    public $connection;

    public $confirmation;
    

    public function __construct(){
        $this->dbConnection();
    }

    public function dbConnection(){
        $this->connection = mysqli_connect($this->host, $this->user, $this->password, $this->db);

        if ( !$this->connection ) {
            die("Connection failed: " . mysqli_connect_error());
        }

    }

    public function insert($query){
        if( !$query ){
            return false;
        }

        return mysqli_query($this->connection, $query);
    }

    public function __destruct(){
        mysqli_close($this->connection);
    }
}