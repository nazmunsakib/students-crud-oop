<div class="student-list-area">
    <h2><?php echo "Student List"?></h2>
    <?php 
    $student_list = $students->get_students();
    ?>
    <div class="student-list-table">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Roll</th>
                    <th>Class</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    if( $student_list->num_rows > 0 ) : 
                        while( $student = $student_list->fetch_assoc() ):
                            $id     = $student['id'] ?? '';
                            $name   = $student['name'] ?? '';
                            $roll   = $student['roll'] ?? '';
                            $class  = $student['class'] ?? '';
                            $email  = $student['email'] ?? '';
                        ?>
                        <tr>
                            <td<?php echo $name; ?></td>
                            <td><?php echo $name; ?></td>
                            <td><?php echo $roll; ?></td>
                            <td><?php echo $class; ?></td>
                            <td><?php echo $email; ?></td>
                            <td>
                                <a href="?action=edit&id=<?php echo $id; ?>" class="student-edit"><?php echo "Edit" ?></a> |
                                <a href="?action=delete&id=<?php echo $id; ?>" class="student-delete" data-id="<?php echo $id; ?>"><?php echo "Delete" ?></a>
                            </td>
                        </tr>
                        <?php
                        endwhile;
                    endif; 
                    ?>
            </tbody>
        </table>
    </div>
</div>