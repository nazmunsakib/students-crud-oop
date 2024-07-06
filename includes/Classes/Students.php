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
}