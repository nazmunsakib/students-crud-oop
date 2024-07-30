<?php 
$id     = isset($_GET['id']) ? intval($_GET['id']) : 0;
$name   = '';
$class  = '';
$roll   = '';
$email  = '';
$image  = '';
$button = 'Add Record';

if( $id ){
    $student = $students->get_student($id);

    $name   = $student['name'] ?? '';
    $class  = $student['class'] ?? '';
    $roll   = $student['roll'] ?? '';
    $email  = $student['email'] ?? '';
    $image  = $student['image'] ?? '';
    $button = 'Update';
} 
?>
<div class="student-register-area">
    <h2><?php echo "Student Registration"?></h2>
    <form id="record-form" method="POST" enctype="multipart/form-data">
        <input type="text" id="name" name="name" placeholder="Name" value="<?php echo $name; ?>" required>
        <input type="text" id="class" name="class" placeholder="Class" value="<?php echo $class; ?>" required>
        <input type="number" id="roll" name="roll" placeholder="Roll" value="<?php echo $roll; ?>" required>
        <input type="text" id="email" name="email" placeholder="Email" value="<?php echo $email; ?>" required>
        <input type="file" name="image" name="image" id="image">
        <button type="submit"><?php echo $button; ?></button>
        <input type="hidden" id="edit-index" value="-1">
    </form>
</div>