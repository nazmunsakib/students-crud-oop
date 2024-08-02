<?php
/**
 * Avoid direct access
 */
if (!defined('SECURE_ACCESS')) {
    die('Direct access not permitted');
}

include_once 'config/config.php';

/**
 * Class Database
 * This class provides database connection and basic query execution methods.
 */
class Database {
    private $host = HOST;         // Database host
    private $user = USER;         // Database user
    private $password = PASSWORD; // Database password
    private $db = DB;             // Database name

    public $connection; // Database connection resource
    public $confirmation; // Placeholder for confirmation messages (not used in current code)

    /**
     * Constructor
     * Initializes the database connection when the object is created.
     */
    public function __construct() {
        $this->dbConnection();
    }

    /**
     * Establishes a connection to the database.
     * 
     * @return void
     */
    public function dbConnection() {
        $this->connection = mysqli_connect($this->host, $this->user, $this->password, $this->db);

        if (!$this->connection) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }

    /**
     * Executes an insert query on the database.
     * 
     * @param string $query The SQL insert query to be executed.
     * @return mixed Result of the query execution, false on failure.
     */
    public function insert($query) {
        if (!$query) {
            return false;
        }

        return mysqli_query($this->connection, $query);
    }

    /**
     * Destructor
     * Closes the database connection when the object is destroyed.
     */
    public function __destruct() {
        mysqli_close($this->connection);
    }
}