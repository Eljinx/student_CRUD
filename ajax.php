<?php
    session_start();

    require "dbconfig.php";
    $db = new DB();

    // LOGIN ADMIN
    if (isset($_POST['loginAdmin'])) {
        $username = isset($_POST['username']) ? $_POST['username'] : "";
        $password = isset($_POST['password']) ? $_POST['password'] : "";

        if ($db->login_admin($username, $password)) {
            // Admin login successful, you can redirect or perform other actions
            $name = $db->login_admin($username, $password);

            $_SESSION['admin_logged_in'] = true;
            $_SESSION['name'] = $name; // Set the session variable
            echo json_encode(['success' => true, 'redirect' => 'home.php', 'name' => $name]);
        } else {
            // Admin login failed, show an error message or redirect as needed
            echo json_encode(['success' => false, 'message' => 'Login failed. Check your username and password.']);
        }
    }
?>