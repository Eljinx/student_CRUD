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

    #form-admin{
        margin: 0 auto;
    }
</style>
<body class="d-flex">

    <?php require_once('./admin_nav.php'); ?>

    <main>
        <div class="container p-5">
            <div id="form-admin" class="w-50">
                <p id="status"></p>
                <h3 class="mb-5">Create Admin Account</h3>
                <form id="create-admin-form">
                    <div class="row mb-3">
                        <div class="col">
                            <input id="admin-name" name="name-admin" type="text" class="form-control" placeholder="Name" aria-label="Admin Name" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <input id="admin-username" name="username-admin" type="text" class="form-control" placeholder="Username" aria-label="Admin Username" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <input id="admin-password" name="password-admin" type="password" class="form-control" placeholder="Password" aria-label="Admin Password" required>
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary">Create Admin</button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script>
        $(document).ready(function(){
            $('#create-admin-form').on('submit', function(e){
            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: '../ajax.php',
                data: {
                    createAdmin: 1,
                    name: $('input[name="name-admin"]').val(),
                    username: $('input[name="username-admin"]').val(),
                    password: $('input[name="password-admin"]').val(),
                },
                dataType: 'json',
                success: function(response){
                    if(response.success){
                        $('#status').html(response.message);
                    } else {
                        $('#status').html(response.error);
                        console.error('Error: ' + response.error);
                    }
                },
                error: function(xhr, status, error){
                    $('#status').html(xhr.responseText);
                    console.error('AJAX Error: ' + xhr.responseText);
                }
            });

            // location.reload();
        });
        })
    </script>
</body>
</html>