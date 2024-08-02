<?php
namespace StudentsCrud\Classes;

include_once 'lib/Database.php';

/**
 * Class Students
 * This class provides CRUD operations for the 'students' table in the database.
 */
class Students {
    private $db;  // Database connection object
    private $tableName = 'students'; // Name of the table
    public $massage; // Variable for storing messages

    /**
     * Constructor
     * Initializes the database connection.
     */
    public function __construct() {
        $this->db = new \Database();
    }

    /**
     * Add a new student record to the database.
     * 
     * @param array $data Associative array containing student data (name, class, roll, email).
     * @param array $file Associative array containing file data (image).
     * @return mixed Inserted ID on success, false on failure.
     */
    public function add($data, $file) {
        if (!$data && !$file) {
            return false;
        }

        $name   = $data['name'] ?? '';
        $class  = $data['class'] ?? '';
        $roll   = $data['roll'] ?? '';
        $email  = $data['email'] ?? '';

        $imageData = $file['image'] ?? [];

        // Insert query to add the new student record
        $query = "INSERT INTO $this->tableName VALUES (NULL, '$name', '$roll', '$class', '$email', 'image')";
        $inserted_id = $this->db->insert($query);

        return $inserted_id;
    }

    /**
     * Get all student records from the database.
     * 
     * @return mysqli_result Result set containing all student records.
     */
    public function get_students() {
        $query = "SELECT * FROM students";
        $result = $this->db->connection->query($query);

        return $result;
    }

    /**
     * Get a single student record by ID.
     * 
     * @param int $id The ID of the student.
     * @return array Associative array containing the student's data.
     */
    public function get_student($id) {
        $query = "SELECT * FROM students WHERE id = ?";
        $statement = $this->db->connection->prepare($query);
        $statement->bind_param('i', $id);
        $statement->execute();
        $result = $statement->get_result();

        $student = [];

        if ($data = $result->fetch_assoc()) {
            $student = $data;
        }

        $statement->close();

        return $student;
    }

    /**
     * Update a student record by ID.
     * 
     * @param int $id The ID of the student to update.
     * @param array $data Associative array containing updated student data (name, class, roll, email).
     * @param array $file Associative array containing updated file data (image).
     * @return bool True on success, false on failure.
     */
    public function update_student($id, $data = [], $file = []) {
        $name   = $data['name'] ?? '';
        $email  = $data['email'] ?? '';
        $roll   = $data['roll'] ?? '';
        $class  = $data['class'] ?? '';

        $query = "UPDATE students SET name = ?, roll = ?, class = ?, email = ? WHERE id = ?";
        $statement = $this->db->connection->prepare($query);
        $statement->bind_param('sissi', $name, $roll, $class, $email, $id);

        $success = false;
        if ($statement->execute()) {
            $success = true;
        }

        $statement->close();

        return $success;
    }

    /**
     * Delete a student record by ID.
     * 
     * @param int $id The ID of the student to delete.
     * @return bool True on success, false on failure.
     */
    public function delete_student($id) {
        $query = "DELETE FROM students WHERE id = ?";
        $statement = $this->db->connection->prepare($query);
        $statement->bind_param('i', $id);

        $success = false;
        if ($statement->execute()) {
            $success = true;
        }

        $statement->close();

        return $success;
    }
}