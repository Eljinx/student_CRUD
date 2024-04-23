<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management Information System</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center w-100">Student Management Information System</h1>
        <div id="response"></div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="mt-4">Login</h2>
                <form id="login-form">
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" class="form-control" id="username" placeholder="Enter username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" placeholder="Enter password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
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
                            setTimeout(function() {
                                $('#response').fadeOut(1000); // Fade out over 1 second
                            }, 3000);
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
