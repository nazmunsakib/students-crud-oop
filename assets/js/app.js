(function() {
    document.addEventListener('DOMContentLoaded', function(event) {
        // Get all elements with the class 'student-delete'
        const stdDelete = document.getElementsByClassName('student-delete');

        // Check if there are any elements with the 'student-delete' class
        if (stdDelete.length > 0) {
            // Iterate over each 'student-delete' element
            for (let student of stdDelete) {
                // Add a click event listener to each 'student-delete' element
                student.addEventListener('click', function(e) {
                    console.log(student); // Log the student element to the console

                    // Show a confirmation dialog
                    if (!confirm("Are you sure?")) {
                        // If the user clicks "Cancel", prevent the default action (e.g., form submission or link navigation)
                        e.preventDefault();
                    }
                });
            }
        }
    });
})();
