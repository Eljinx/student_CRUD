<?php
    session_start();
    if (isset($_SESSION['admin_logged_in'])) {
        header('Location: ./Admin/admin_dashboard.php'); // Redirect to the login page
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management Information System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 50px;
            border-radius: 10px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
            padding: 40px;
        }

        h3 {
            color: #000;
            text-align: center;
            margin-bottom: 30px;
        }

        .form-group label {
            color: #333333;
            margin-bottom: 5px;
        }

        .btn-primary {
            background-color: #000;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container w-75">
        <h3>Student Management Information System</h3>
        <div class="row">
            <div class="col-md-6 mx-auto">
                <p id="response" class="text-center text-danger"></p>
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h4 class="card-title">Sign in</h4>
                    </div>
                    <div class="card-body">
                        <form id="login-form" >
                            <div class="form-group mb-3">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" placeholder="Enter username"
                                    required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" placeholder="Enter password"
                                    required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Sign in</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="jquery.min.js"></script>

    <script>
        $('#login-form').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'ajax.php',
                data: {
                    loginAdmin: true, // Add a form identifier
                    username: $('#username').val(), // Change to the actual input field ID
                    password: $('#password').val() // Change to the actual input field ID
                },
                success: function(response) {
                    console.log(response); // Para makita ang actual na response
                    try {
                        response = JSON.parse(response);
                        if (response.success) {
                            window.location.href = response.redirect;
                        } else {
                            $('#response').html(response.message);
                        }
                    } catch (e) {
                        console.error("JSON parsing error:", e);
                        $('#response').html("An error occurred while processing the response.");
                    }
                }
            });
        });
    </script>

</body>

</html>
