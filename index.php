<?php
/**
 * Define constant for avoid direct access  
 */
define('SECURE_ACCESS', true);

require 'vendor/autoload.php';
use StudentsCrud\Classes\Students;

$students = new Students();

if( 'POST' == $_SERVER['REQUEST_METHOD'] ){
    $students->add($_POST, $_FILES);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="students-crud-wrapper">
        <div class="container">
            <div class="student-register-area">
                <h1>Student Registration</h1>
                <form id="record-form" method="POST" enctype="multipart/form-data">
                    <input type="text" id="name" name="name" placeholder="Name" required>
                    <input type="text" id="class" name="class" placeholder="Class" required>
                    <input type="number" id="roll" name="roll" placeholder="Roll" required>
                    <input type="text" id="email" name="email" placeholder="Email" required>
                    <input type="file" name="image" name="image" id="image">
                    <button type="submit">Add Record</button>
                    <input type="hidden" id="edit-index" value="-1">
                </form>
            </div>
        </div>
    </div>
</body>
</html>