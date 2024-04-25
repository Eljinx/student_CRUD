<?php

    session_start();

    if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
        header('Location: /index.php'); // Redirect to the login page
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <title>ADMIN PANEL</title>

</head>
<style>
    main{
        display: flex;
        flex-direction: column;
        max-height: 100vh;
        width: 100%;
        overflow: hidden;
        overflow-y: auto;
        width: 80%;
    }
</style>
<body class="d-flex">

    <?php require_once('./admin_nav.php'); ?>

    <main>
        <div class="container p-5 ">
            <p id="status" class="text-success"></p>
            <div class="d-flex justify-content-between mb-3">
                <h3>Student Record</h3>
                <button id="update_btn" class="edit-movie btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#addModal">Create <i class="bi bi-plus"></i></button>
            </div>
            <div id="student-table" class="shadow-none p-3 mb-5 bg-body-tertiary rounded">
            </div>
        </div>
    </main>


    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
    $(document).ready(function() {
        $.ajax({
            type: "POST",
            url: "../ajax.php",
            data: {
                fetchStudents: 1,
            },
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    var student_data = response.student_data;
                    var table =
                        '<table class="table" id="students_table"><thead><th>#</th><th>ID Number</th><th>Name</th><th>Email</th><th>Age</th><th>Action</th></thead><tbody>';
                    $.each(student_data, function(index, student) {
                        table +=
                            '<tr><td>' + student.id +
                            '</td><td>' + student.id_number +
                            '</td><td>' + student.first_name +
                            '</td><td>' + student.email +
                            '</td><td>' + student.current_age +
                            '</td><td>' + '<button id="update_btn" class="edit-movie btn btn-warning" type="button" data-bs-toggle="modal" data-bs-target="#updateModal" data-id="'+ student.id +'">Update <i class="bi bi-pencil-square"></i></button>&nbsp;<button id="remove_btn" class="delete-movie btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#removeModal" data-id="'+ student.id +'">Delete <i class="bi bi-trash3-fill"></i></button>'
                            '</td></tr>';
                    });

                    table += '</tbody></table>';
                    $('#student-table').html(table);

                    $('#students_table').DataTable();
                } else {
                    $('#student-table').html($response.error);
                }
            },
            error: function() {
                $('#student-table').html('Error retrieving students data.');
            }
        });
    });
    </script>

</body>

<?php require_once('./modals.php'); ?>
</html>