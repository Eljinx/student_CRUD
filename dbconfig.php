<?php
    $driver = new mysqli_driver();
    $driver->report_mode = MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ERROR;

    class DB {
        private $db_host = 'localhost';
        private $db_user = 'root';
        private $db_pass = '';
        private $db_name = 'student_info_system';
    
        public $mysql;
        public $res;
    
        public function __construct()
        {
            try {
                if (!$this->mysql = new mysqli($this->db_host, $this->db_user, $this->db_pass, $this->db_name)) {
                    throw new Exception($this->mysql->connect_error);
                }
            } catch (Exception $e) {
                die("Error on Database fix it quick!" . $e);
            }
        }

        public function login_admin($username, $password)
        {
            // I-escape ang username at password para maiwasan ang SQL injection
            $username = $this->mysql->real_escape_string($username);
            $password = $this->mysql->real_escape_string($password);
            
            // I-hash ang password gamit ang md5
            $hashedPassword = md5($password);
            
            // Gumamit ng prepared statement upang maiwasan ang SQL injection
            $sql = "SELECT * FROM admin WHERE username = '$username' AND password = '$hashedPassword'";
            // $sql->bind_param('ss', $username, $hashedPassword);
            // $sql->execute();
            // $result = $sql->get_result();
            $result = $this->mysql->query($sql);
            
            // Suriin ang resulta ng query
            if ($result) {
                if ($result->num_rows == 1) {
                    // Kung mayroong isang row na bumalik, makuha ang data ng admin
                    $adminData = $result->fetch_assoc();
                    // Itakda ang session variable upang ipahiwatig na naka-login na ang admin
                    $_SESSION['admin_logged_in'] = true;

                    $dashboard = $this->getDashboardStats();

                    $data = [
                        'studentCount' => $dashboard['studentCount'],
                        'adminCount' => $dashboard['adminCount'],
                        'name' => $adminData['name'],
                    ];

                    return $data;
                } else {
                    // Kung walang row na bumalik, ibig sabihin maling credentials
                    return false;
                }
            } else {
                // Kung mayroong isyu sa query, ibalik ang false
                return false;
            }
        }

        public function getDashboardStats(){
            $sql = "SELECT COUNT(*) AS total_students FROM students";
            $studentCountResult = $this->mysql->query($sql);
            $studentCount = $studentCountResult->fetch_assoc()['total_students']; // Fetch the count value
        
            $sql = "SELECT COUNT(*) AS total_admins FROM admin";
            $adminCountResult = $this->mysql->query($sql);
            $adminCount = $adminCountResult->fetch_assoc()['total_admins']; // Fetch the count value
        
            $data = [
                'studentCount' => $studentCount,
                'adminCount' => $adminCount,
            ];
        
            return $data;
        }

        public function fetchStudents(){
            $sql = "SELECT * FROM students";
            $result = $this->mysql->query($sql);

            if($result){
                if($result->num_rows > 0){
                    $student_data = array();

                    while($row = $result->fetch_assoc()){
                        $student_data[] = $row;
                    }

                    return $student_data;
                }else{
                    return false;
                }   
            }else{
                return false;
            }
        }

        public function fetchCourses(){
            $sql = "SELECT * FROM courses";
            $result = $this->mysql->query($sql);

            if($result){
                if($result->num_rows > 0){
                    $courses = array();

                    while($row = $result->fetch_assoc()){
                        $courses[] = $row;
                    }

                    return $courses;
                }else{
                    return false;
                }   
            }else{
                return false;
            }
        }

        public function fetchYears(){
            $sql = "SELECT * FROM years";
            $result = $this->mysql->query($sql);

            if($result){
                if($result->num_rows > 0){
                    $years = array();

                    while($row = $result->fetch_assoc()){
                        $years[] = $row;
                    }

                    return $years;
                }else{
                    return false;
                }   
            }else{
                return false;
            }
        }

        public function fetchSections(){
            $sql = "SELECT * FROM sections";
            $result = $this->mysql->query($sql);

            if($result){
                if($result->num_rows > 0){
                    $sections = array();

                    while($row = $result->fetch_assoc()){
                        $sections[] = $row;
                    }

                    return $sections;
                }else{
                    return false;
                }   
            }else{
                return false;
            }
        }

        public function fetchStudentData($id){
            $sql = "SELECT * FROM students WHERE id ='$id'";
            $result = $this->mysql->query($sql);

            if($result){
                if($result->num_rows > 0){
                    $student_data = array();

                    while($row = $result->fetch_assoc()){
                        $student_data[] = $row;
                    }

                    return $student_data;
                }else{
                    return false;
                }   
            }else{
                return false;
            }
        }

        public function createStudent($data){

            $table_columns = implode(',', array_keys($data));
            $table_values = implode("','", $data);
            $sql = "INSERT INTO students($table_columns) VALUES ('$table_values')";

            $result = $this->mysql->query($sql);

            if ($result) {
                return true;
            } else {
                return false;
            }
        }

        public function updateStudent($data){

            $sql = "UPDATE students
            SET id_number = '$data[id_number]', first_name = '$data[first_name]', middle_name = '$data[middle_name]', last_name = '$data[last_name]', email = '$data[email]', current_age = '$data[current_age]', current_year = '$data[current_year]', current_section = '$data[current_section]', course = '$data[course]'
            WHERE id = $data[id]";

            $result = $this->mysql->query($sql);

            if ($result) {
                return true;
            } else {
                return false;
            }
        }

        public function removeStudent($id){

            $sql = "DELETE FROM students WHERE id = $id";

            $result = $this->mysql->query($sql);

            if ($result) {
                return true;
            } else {
                return false;
            }
        }

        public function createAdmin($data){

            $table_columns = implode(',', array_keys($data));
            $table_values = implode("','", $data);
            $sql = "INSERT INTO admin($table_columns) VALUES ('$table_values')";

            $result = $this->mysql->query($sql);

            if ($result) {
                return true;
            } else {
                return false;
            }
        }
    }
?>