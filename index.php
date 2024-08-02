<?php
/**
 * Define constant to avoid direct access
 */
define('SECURE_ACCESS', true);

require 'vendor/autoload.php';
use StudentsCrud\Classes\Students;

// Initialize the Students class
$students = new Students();

// Get action and status parameters from the URL
$action = $_GET['action'] ?? '';
$added = $_GET['added'] ?? false;
$edit = $_GET['edit'] ?? false;
$delete = $_GET['deleted'] ?? false;

$success = '';
$error = '';

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($action == 'edit') {
        // Handle edit action
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        if ($id) {
            $update = $students->update_student($id, $_POST, $_FILES);
            if ($update) {
                header('Location: ?action=list&edit=true');
            } else {
                $error = 'Something went wrong!';
            }
        }
    } else {
        // Handle add action
        $insert_id = $students->add($_POST, $_FILES);
        if ($insert_id) {
            header('Location: ?action=list&added=true');
        } else {
            $error = 'Something went wrong!';
        }
    }
}

// Handle delete action
if ($action == 'delete') {
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    if ($id) {
        $delete = $students->delete_student($id);
        if ($delete) {
            header('Location: ?action=list&deleted=true');
        } else {
            $error = 'Something went wrong!';
        }
    }
}

// Set success messages based on action status
if ($added) {
    $success = 'Student Successfully added!';
} elseif ($edit) {
    $success = 'Student Successfully updated!';
} elseif ($delete) {
    $success = 'Student Successfully Deleted!';
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
                // Include the header
                include_once 'parts/header.php'; 

                // Display success message
                if ($success) {
                    printf('<div class="success-msg">%s</div>', $success);
                }

                // Display error message
                if ($error) {
                    printf('<div class="error-msg">%s</div>', $error);
                }

                // Include the student list or form based on the action
                if ($action == 'list' || $action == 'delete') {
                    include_once 'parts/student-list.php';
                } else {
                    include_once 'parts/form.php';
                }
            ?>
        </div>
    </div>
    <script type="text/javascript" src="assets/js/app.js"></script>
</body>
</html>
