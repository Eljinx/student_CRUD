


<!-- add modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="addModalLabel">Create New Student</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="add-student-form">
        <div class="row mb-3">
            <div class="col">
                <input name="first_name" type="text" class="form-control" placeholder="First name" aria-label="First name" required>
            </div>
            <div class="col">
                <input name="middle_name" type="text" class="form-control" placeholder="Middle name" aria-label="Last name" required>
            </div>
            <div class="col">
                <input name="last_name" type="text" class="form-control" placeholder="Last name" aria-label="Last name" required>
            </div>
        </div>
        <div class="row mb-3">
             <div class="col">
                <input name="id_number" type="text" class="form-control" placeholder="Student ID Number" aria-label="Student ID Number" required>
            </div>
            <div class="col">
                <input name="email" type="email" class="form-control" placeholder="Email @" aria-label="Email" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <input name="current_age" type="number" min="0" class="form-control" placeholder="Age" aria-label="Age" required>
            </div>
            <div class="col">
                <select name="course" id="course" class="form-select" aria-label="Select Course" required>
                    <option selected>Please select course...</option>
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <select id="year" name="current_year" class="form-select" aria-label="Select Year" required>
                    <option selected>Please select year</option>
                </select>
            </div>
            <div class="col">
                <select id="section" name="current_section" class="form-select" aria-label="Select Section" required>
                    <option selected>Please select section</option>
                </select>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Create Student</button>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- update modal -->

<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="updateModalLabel">Modify Student</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="edit-student-form">
        <div class="row mb-3">
            <input hidden id="id" name="id" type="text" class="form-control" required>
            <div class="col">
                <input id="edit_firstName" name="edit_first_name" type="text" class="form-control" placeholder="First name" aria-label="First name" required>
            </div>
            <div class="col">
                <input id="edit_middleName" name="edit_middle_name" type="text" class="form-control" placeholder="Middle name" aria-label="Last name" required>
            </div>
            <div class="col">
                <input id="edit_lastName" name="edit_last_name" type="text" class="form-control" placeholder="Last name" aria-label="Last name" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <input id="edit_id_number" name="edit_id_number" type="text" class="form-control" placeholder="Student ID Number" aria-label="Student ID Number" required>
            </div>
            <div class="col">
                <input id="edit_email" name="edit_email" type="email" class="form-control" placeholder="Email @" aria-label="Email" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <input id="edit_age" name="edit_age" type="number" min="0" class="form-control" placeholder="Age" aria-label="Age" required>
            </div>
            <div class="col">
                <select class="form-select" aria-label="Select Course" id="edit_course" name="edit_course" required>
                    <option selected>Please select course...</option>
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <select class="form-select" aria-label="Select Year" id="edit_year" name="edit_year" required>
                    <option selected>Please select year</option>
                </select>
            </div>
            <div class="col">
                <select class="form-select" aria-label="Select Section" id="edit_section" name="edit_section" required>
                    <option selected>Please select section</option>
                </select>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-warning">Update Student</button>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- delete modal -->

<div class="modal fade" id="removeModal" tabindex="-1" aria-labelledby="removeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5 text-danger" id="removeModalLabel">Remove Student</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="remove-student-form">
            <div class="row mb-3">
                <div class="col">
                    <input type="text" class="form-control" placeholder="id" aria-label="id" name="student_id" id="remove_id" required>
                </div>
                <p>Are you sure you want to delete this student?</p>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger">Remove Student</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>


<script>
    //data retrieval
    $(document).ready(function(){
        //add functions
        $('#addModal').on('show.bs.modal', function(event){
            $.ajax({
                url: '../ajax.php',
                type: 'POST',
                data: { fetchCourses: 1 },
                dataType: 'json',
                success: function(response){
                    if(response.success){
                        $('#course').empty();
                        $('#course').append('<option value="null" selected disabled>Please select course</option>');
                        $.each(response.courses, function(index, course){
                            $('#course').append('<option value="' + course.id + '">' + course.course + '</option>');
                        });
                    } else {
                        console.error('Error fetching courses: ' + response.error);
                    }
                },
                error: function(xhr, status, error){
                    console.error('AJAX Error: ' + error);
                }
            });

            $.ajax({
                url: '../ajax.php',
                type: 'POST',
                data: { fetchYears: 1 }, 
                dataType: 'json',
                success: function(response){
                    if(response.success){
                        $('#year').empty();
                        $('#year').append('<option value="null" selected disabled>Please select year</option>');
                        $.each(response.years, function(index, year){
                            $('#year').append('<option value="' + year.id + '">' + year.year + '</option>');
                        });
                    } else {
                        console.error('Error fetching courses: ' + response.error);
                    }
                },
                error: function(xhr, status, error){
                    console.error('AJAX Error: ' + error);
                }
            });

            $.ajax({
                url: '../ajax.php',
                type: 'POST',
                data: { fetchSections: 1 }, 
                dataType: 'json',
                success: function(response){
                    if(response.success){
                        $('#section').empty();
                        $('#section').append('<option value="null" selected disabled>Please select section</option>');
                        $.each(response.sections, function(index, section){
                            $('#section').append('<option value="' + section.id + '">' + section.section + '</option>');
                        });
                    } else {
                        console.error('Error fetching courses: ' + response.error);
                    }
                },
                error: function(xhr, status, error){
                    console.error('AJAX Error: ' + error);
                }
            });
        })


        $('#add-student-form').on('submit', function(e){
            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: '../ajax.php',
                data: {
                    createStudent: 1,
                    id_number: $('input[name="id_number"]').val(),
                    first_name: $('input[name="first_name"]').val(),
                    middle_name: $('input[name="middle_name"]').val(),
                    last_name: $('input[name="last_name"]').val(),
                    email: $('input[name="email"]').val(),
                    current_age: $('input[name="current_age"]').val(),
                    course: $('#course').val(),
                    current_year: $('#year').val(),
                    current_section: $('#section').val(),
                },
                dataType: 'json',
                success: function(response){
                    if(response.success){
                        $('#addModal').modal('hide'); 
                        $('#status').html(response.message);
                    } else {
                        $('#status').html(response.error);
                        console.error('Error: ' + response.error);
                    }
                },
                error: function(xhr, status, error){
                    $('#addModal').modal('hide'); 
                    $('#status').html(xhr.responseText);
                    console.error('AJAX Error: ' + xhr.responseText);
                }
            });

            location.reload();
        });


        //update functions
        $('#updateModal').on('show.bs.modal', function(event){
            $.ajax({
                url: '../ajax.php',
                type: 'POST',
                data: { fetchCourses: 1 },
                dataType: 'json',
                success: function(response){
                    if(response.success){
                        $('#edit_course').empty();
                        $('#edit_course').append('<option value="null" selected disabled>Please select course</option>');
                        $.each(response.courses, function(index, course){
                            $('#edit_course').append('<option value="' + course.id + '">' + course.course + '</option>');
                        });
                    } else {
                        console.error('Error fetching courses: ' + response.error);
                    }
                },
                error: function(xhr, status, error){
                    console.error('AJAX Error: ' + error);
                }
            });

            $.ajax({
                url: '../ajax.php',
                type: 'POST',
                data: { fetchYears: 1 }, 
                dataType: 'json',
                success: function(response){
                    if(response.success){
                        $('#edit_year').empty();
                        $('#edit_year').append('<option value="null" selected disabled>Please select year</option>');
                        $.each(response.years, function(index, year){
                            $('#edit_year').append('<option value="' + year.id + '">' + year.year + '</option>');
                        });
                    } else {
                        console.error('Error fetching courses: ' + response.error);
                    }
                },
                error: function(xhr, status, error){
                    console.error('AJAX Error: ' + error);
                }
            });

            $.ajax({
                url: '../ajax.php',
                type: 'POST',
                data: { fetchSections: 1 }, 
                dataType: 'json',
                success: function(response){
                    if(response.success){
                        $('#edit_section').empty();
                        $('#edit_section').append('<option value="null" selected disabled>Please select section</option>');
                        $.each(response.sections, function(index, section){
                            $('#edit_section').append('<option value="' + section.id + '">' + section.section + '</option>');
                        });
                    } else {
                        console.error('Error fetching courses: ' + response.error);
                    }
                },
                error: function(xhr, status, error){
                    console.error('AJAX Error: ' + error);
                }
            });

            var button = $(event.relatedTarget);
            var student_id = button.data('id');


            $.ajax({
                url: '../ajax.php',
                type: 'POST',
                data: { 
                    fetchStudentData: 1,
                    id: student_id,  
                }, 
                dataType: 'json',
                success: function(response){
                    if(response.success){
                        $.each(response.student, function(index, student){
                            $("#id").val(student.id);
                            $("#edit_firstName").val(student.first_name);
                            $("#edit_middleName").val(student.middle_name);
                            $("#edit_lastName").val(student.last_name);
                            $("#edit_id_number").val(student.id_number);
                            $("#edit_email").val(student.email);
                            $("#edit_age").val(student.current_age);
                            $("#edit_course").val(student.course);
                            $("#edit_year").val(student.current_year);
                            $("#edit_section").val(student.current_section);
                        });
                    } else {
                        console.error('Error fetching courses: ' + response.error);
                    }
                },
                error: function(xhr, status, error){
                    console.error('AJAX Error: ' + error);
                }
            });
        })

        $('#edit-student-form').on('submit', function(e){
            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: '../ajax.php',
                data: {
                    updateStudent: 1,
                    id: $('input[name="id"]').val(),
                    id_number: $('input[name="edit_id_number"]').val(),
                    first_name: $('input[name="edit_first_name"]').val(),
                    middle_name: $('input[name="edit_middle_name"]').val(),
                    last_name: $('input[name="edit_last_name"]').val(),
                    email: $('input[name="edit_email"]').val(),
                    current_age: $('input[name="edit_age"]').val(),
                    course: $('#edit_course').val(),
                    current_year: $('#edit_year').val(),
                    current_section: $('#edit_section').val(),
                },
                dataType: 'json',
                success: function(response){
                    if(response.success){
                        $('#updateModal').modal('hide'); 
                        $('#status').html(response.message);
                    } else {
                        $('#status').html(response.error);
                        console.error('Error: ' + response.error);
                    }
                },
                error: function(xhr, status, error){
                    $('#updateModal').modal('hide'); 
                    $('#status').html(xhr.responseText);
                    console.error('AJAX Error: ' + xhr.responseText);
                }
            });

            location.reload();
        });


        //remove functions
        $('#removeModal').on('show.bs.modal', function(event){
            var button = $(event.relatedTarget);
            var recipient = button.data('id');

            $('#remove_id').val(recipient);
        })

        $('#removeModal').on('hidden.bs.modal', function(event){
            $('#remove_id').val('');
        })

        $('#remove-student-form').on('submit', function(e){
            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: '../ajax.php',
                data: {
                    removeStudent: 1,
                    id: $('input[name="student_id"]').val(),
                },
                dataType: 'json',
                success: function(response){
                    if(response.success){
                        $('#removeModal').modal('hide'); 
                        $('#status').html(response.message);
                    } else {
                        $('#status').html(response.error);
                        console.error('Error: ' + response.error);
                    }
                },
                error: function(xhr, status, error){
                    $('#removeModal').modal('hide'); 
                    $('#status').html(xhr.responseText);
                    console.error('AJAX Error: ' + xhr.responseText);
                }
            });

            location.reload();
        });
    });
</script>