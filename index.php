<?php
/**
 * Define constant for avoid direct access  
 */
define('SECURE_ACCESS', true);

require 'vendor/autoload.php';
use StudentsCrud\Classes\Students;

$students   = new Students();
$action     = $_GET['action'] ?? '';

if( 'POST' == $_SERVER['REQUEST_METHOD'] ){
    if( 'edit' == $action ){

    }else{
        $students->add($_POST, $_FILES);
    }

    header('Location: ?action=list');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo "Student Registration"; ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="students-crud-wrapper">
        <div class="container">
            <?php 
                include_once 'parts/header.php';

                if( 'list' == $action ) {
                    include_once 'parts/student-list.php';
                }else{
                    include_once 'parts/form.php';
                } 
            ?>
        </div>
    </div>
</body>
</html>