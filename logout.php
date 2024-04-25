    <?php
    // Logout process
    session_start();
    unset($_SESSION['admin_logged_in']);
    session_destroy(); // Destroy the session to log out

    header('Location: index.php');
    exit();
?>