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
$delete       = $_GET['deleted'] ?? false;
$success    = '';
$error      = '';

if( 'POST' == $_SERVER['REQUEST_METHOD'] ){
    if( 'edit' == $action ){
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0 ;
        if($id){
            $update = $students->update_student($id, $_POST, $_FILES);
            if( $update ){
                header('Location: ?action=list&edit=true');
            }else{
                $error    = 'Something went wrong!';
            }
        }
       
    }else{
        $insert_id = $students->add($_POST, $_FILES);
        if( $insert_id ){
            header('Location: ?action=list&added=true');
        }else{
            $error    = 'Something went wrong!';
        }
    }
}

if( 'delete' == $action ){
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0 ;
    if($id){
        $delete = $students->delete_student($id);
        if( $delete ){
            header('Location: ?action=list&deleted=true');
        }else{
            $error    = 'Something went wrong!';
        }
    }
}

if( true == $added ){
    $success    = 'Student Successfully added!';
}else if( true == $edit ){
    $success    = 'Student Successfully updated!';
}else if( true == $delete ){
    $success    = 'Student Successfully Deleted!';
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

                    if( $success ) {
                        printf('<div class="success-msg">%s</div>',  $success );
                    }

                    if( $error ) {
                        printf('<div class="error-msg">%s</div>',  $error );
                    }

                    if( 'list' == $action || 'delete' == $action ) {
                        include_once 'parts/student-list.php';
                    }else{
                        include_once 'parts/form.php';
                    } 
                ?>
            </div>
        </div>
        <script type="text/javascript" src="assets/js/app.js"></script>
    </body>
</html>