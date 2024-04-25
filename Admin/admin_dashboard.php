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

    .dashboard-container{
        width: 50%;
    }
</style>
<body class="d-flex">

    <?php require_once('./admin_nav.php'); ?>

    <main>
        <div class="container dashboard-container p-5">
            <h3>System Dashboard</h3>
            <div class="row mt-3">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Total number of Registered Students</h5>
                            <p class="card-text" id="no_of_students"><b>Total Students: <?php echo $_SESSION['studentCount'];?></b></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Total number of Registered Admin</h5>
                            <p class="card-text" id="no_of_admins"><b>Total Admins: <?php echo $_SESSION['adminCount'];?></b></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

</body>
</html>