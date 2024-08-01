;(function(){
    document.addEventListener('DOMContentLoaded', function(event){
        const stdDelete = document.getElementsByClassName('student-delete');
        if( stdDelete.length > 0 ){
            for( let student of stdDelete){
                student.addEventListener('click', function(e){
                    console.log(student);
                    if( ! confirm("Are you sure?") ){
                        e.preventDefault();
                    }
                });
            }
        }
    }); 
})();