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
            $sql = $this->mysql->prepare("SELECT * FROM admin WHERE username = ? AND password = ?");
            $sql->bind_param('ss', $username, $hashedPassword);
            $sql->execute();
            $result = $sql->get_result();
            
            // Suriin ang resulta ng query
            if ($result) {
                if ($result->num_rows == 1) {
                    // Kung mayroong isang row na bumalik, makuha ang data ng admin
                    $adminData = $result->fetch_assoc();
                    // Itakda ang session variable upang ipahiwatig na naka-login na ang admin
                    $_SESSION['admin_logged_in'] = true;
                    return $adminData['name'];
                } else {
                    // Kung walang row na bumalik, ibig sabihin maling credentials
                    return false;
                }
            } else {
                // Kung mayroong isyu sa query, ibalik ang false
                return false;
            }
        }

    }
?>