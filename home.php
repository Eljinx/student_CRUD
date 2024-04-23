<?php

    session_start();

    if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
        header('Location: index.php'); // Redirect to the login page
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcom Admin  <?php echo $_SESSION['name']; ?></title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
    <h1>Welcome <?php echo $_SESSION['name'];?></h1>
    <button class="btn btn-primary">Add Student</button>
    <button class="btn btn-danger" id="logout-button">Logout</button>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="jquery.min.js"></script>


    <script>
        $(document).ready(function() {
            // Magdagdag ng event listener sa logout button
            $('#logout-button').on('click', function() {
                // Gumawa ng AJAX request para tawagan ang logout.php
                $.ajax({
                    type: 'POST',
                    url: 'logout.php',
                    success: function() {
                        // Kapag matagumpay ang logout, i-redirect ang user sa index.php
                        window.location.href = 'index.php';
                    },
                    error: function() {
                        // Magpakita ng error message kung hindi matagumpay ang request
                        alert('Logout failed. Please try again.');
                    }
                });
            });
        });

    </script>

</body>
</html>