<?php
/**
 * Define constant for avoid direct access  
 */
define('SECURE_ACCESS', true);

require 'vendor/autoload.php';
use StudentsCrud\Classes\Students;

$students   = new Students();
$action     = $_GET['action'] ?? '';
$added      = $_GET['added'] ?? false;
$edit       = $_GET['edit'] ?? false;
$massage    = '';

if( 'POST' == $_SERVER['REQUEST_METHOD'] ){
    if( 'edit' == $action ){
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0 ;
        if($id){
            $update = $students->update_student($id, $_POST, $_FILES);
            if( $update ){
                header('Location: ?action=list&edit=true');
            }else{
                $massage    = 'Something went wrong!';
            }
        }
       
    }else{
        $insert_id = $students->add($_POST, $_FILES);
        if( $insert_id ){
            header('Location: ?action=list&added=true');
        }else{
            $massage    = 'Something went wrong!';
        }
    }
}

if( true == $added ){
    $massage    = 'Student Successfully added!';
}else if( true == $edit ){
    $massage    = 'Student Successfully updated!';
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

                if( $massage ) {
                    printf('<div class="info-msg">%s</div>',  $massage );
                }

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