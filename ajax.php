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
            $data = $db->login_admin($username, $password);

            $_SESSION['admin_logged_in'] = true;

            $_SESSION['name'] = $data['name']; // Set the session variable
            $_SESSION['studentCount'] = $data['studentCount']; // Set the session variable
            $_SESSION['adminCount'] = $data['adminCount']; // Set the session variable
            echo json_encode(['success' => true, 'redirect' => './Admin/admin_dashboard.php']);
        } else {
            // Admin login failed, show an error message or redirect as needed
            echo json_encode(['success' => false, 'message' => 'Login failed. Check your username and password.']);
        }
    }

    if(isset($_POST['fetchStudents'])){
        try {
            $student_data = $db->fetchStudents();
    
            if ($student_data !== false) {
                echo json_encode(['success' => true, 'student_data' => $student_data]);
            } else {
                echo json_encode(['success' => false, 'error' => 'No students data found.']);
            }
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => 'Error: ' . $e->getMessage()]);
        }
    }

    if(isset($_POST['fetchCourses'])){
        try {
            $courses = $db->fetchCourses();
    
            if ($courses !== false) {
                echo json_encode(['success' => true, 'courses' => $courses]);
            } else {
                echo json_encode(['success' => false, 'error' => 'No courses data found.']);
            }
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => 'Error: ' . $e->getMessage()]);
        }
    }

    if(isset($_POST['fetchYears'])){
        try {
            $years = $db->fetchYears();
    
            if ($years !== false) {
                echo json_encode(['success' => true, 'years' => $years]);
            } else {
                echo json_encode(['success' => false, 'error' => 'No years data found.']);
            }
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => 'Error: ' . $e->getMessage()]);
        }
    }

    if(isset($_POST['fetchSections'])){
        try {
            $sections = $db->fetchSections();
    
            if ($sections !== false) {
                echo json_encode(['success' => true, 'sections' => $sections]);
            } else {
                echo json_encode(['success' => false, 'error' => 'No years data found.']);
            }
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => 'Error: ' . $e->getMessage()]);
        }
    }

    if(isset($_POST['fetchStudentData'])){
        try {
            $student = $db->fetchStudentData($_POST['id']);
    
            if ($student !== false) {
                echo json_encode(['success' => true, 'student' => $student]);
            } else {
                echo json_encode(['success' => false, 'error' => 'No student data found.']);
            }
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => 'Error: ' . $e->getMessage()]);
        }
    }

    if(isset($_POST['createStudent'])){
        try {
            $studentData = [
                'id_number' => $_POST['id_number'],
                'first_name' => $_POST['first_name'],
                'middle_name' => $_POST['middle_name'],
                'last_name' => $_POST['last_name'],
                'email' => $_POST['email'],
                'current_age' => $_POST['current_age'],
                'current_year' => $_POST['current_year'],
                'current_section' => $_POST['current_section'],
                'course' => $_POST['course'],
            ];

            $response = $db->createStudent($studentData);
    
            if ($response) {
                echo json_encode(['success' => true, 'message' => 'Student added successfully!']);
            } else {
                echo json_encode(['success' => false, 'error' => 'Student adding failed.']);
            }
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => 'Error: ' . $e->getMessage()]);
        }
    }

    if(isset($_POST['updateStudent'])){
        try {
            $studentData = [
                'id' => $_POST['id'],
                'id_number' => $_POST['id_number'],
                'first_name' => $_POST['first_name'],
                'middle_name' => $_POST['middle_name'],
                'last_name' => $_POST['last_name'],
                'email' => $_POST['email'],
                'current_age' => $_POST['current_age'],
                'current_year' => $_POST['current_year'],
                'current_section' => $_POST['current_section'],
                'course' => $_POST['course'],
            ];

            $response = $db->updateStudent($studentData);
    
            if ($response) {
                echo json_encode(['success' => true, 'message' => 'Student updated successfully!']);
            } else {
                echo json_encode(['success' => false, 'error' => 'Student update failed.']);
            }
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => 'Error: ' . $e->getMessage()]);
        }
    }

    
    if(isset($_POST['removeStudent'])){
        try {

            $response = $db->removeStudent($_POST['id']);
    
            if ($response) {
                echo json_encode(['success' => true, 'message' => 'Student removed successfully!']);
            } else {
                echo json_encode(['success' => false, 'error' => 'Student removing failed.']);
            }
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => 'Error: ' . $e->getMessage()]);
        }
    }

    if(isset($_POST['createAdmin'])){
        try {

            $hashedPassword = md5($_POST['password']);

            $data = [
                'name' => $_POST['name'],
                'username' => $_POST['username'],
                'password' => $hashedPassword,
            ];

            $response = $db->createAdmin($data);
    
            if ($response) {
                echo json_encode(['success' => true, 'message' => 'Admin added successfully!']);
            } else {
                echo json_encode(['success' => false, 'error' => 'Admin adding failed.']);
            }
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => 'Error: ' . $e->getMessage()]);
        }
    }
?>