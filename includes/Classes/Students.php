<?php
namespace StudentsCrud\Classes;

include_once 'lib/Database.php';

class Students{
    private $db;

    private $tableName = 'students';

    public function __construct(){
        $this->db = new \Database();
    }

    public function add($data, $file){
        if( !$data && !$file ){
            return false;
        }

        $name   = $data['name'] ?? '';
        $class  = $data['class'] ?? '';
        $roll   = $data['roll'] ?? '';
        $email  = $data['email'] ?? '';

        $imageData =  $file['image'] ?? [];

        $query = "INSERT INTO $this->tableName  VALUES (NULL, '$name', '$roll','$class','$email','image')";
        $inserted_id = $this->db->insert($query);

        if ( $inserted_id ) {
            echo "New records created successfully.";
        } else {
            echo "Error: " .$inserted_id;
        }
    }

    public function get_students(){
        $query = "SELECT * FROM students";
        $result = $this->db->connection->query($query);

        return $result;
    }

    public function get_student($id) {
        $query  = "SELECT * FROM students WHERE id = ?";
        $statement  = $this->db->connection->prepare($query);
        $statement->bind_param('i', $id);
        $statement->execute();
        $result     = $statement->get_result();

        $student   = [];

        if( $data =  $result->fetch_assoc() ){
            $student   =  $data;
        }

        $statement->close();

        return $student;
    }
}