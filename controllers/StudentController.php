<?php
require_once 'models/Student.php';
require_once 'config/database.php';

class StudentController {
    private $db;
    private $student;

    public function __construct() {
        // Check if session is not already started before starting it
        if(session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        // Check if user is logged in
        if(!isset($_SESSION['user_id'])) {
            header('Location: index.php?controller=auth&action=login');
            exit;
        }
        
        $database = new Database();
        $this->db = $database->getConnection();
        $this->student = new Student($this->db);
    }

    public function index() {
        $stmt = $this->student->read();
        include 'views/students/index.php';
    }

    public function create() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->student->student_id = $_POST['student_id'] ?? '';
            $this->student->name = $_POST['name'] ?? '';
            $this->student->email = $_POST['email'] ?? '';
            $this->student->created_by = $_SESSION['user_id'];

            // Validate inputs
            if(empty($this->student->student_id) || empty($this->student->name) || empty($this->student->email)) {
                $error = "All fields are required";
                include 'views/students/create.php';
                return;
            }

            // Create student
            if($this->student->create()) {
                header('Location: index.php?controller=student&action=index');
                exit;
            } else {
                $error = "Failed to create student";
                include 'views/students/create.php';
                return;
            }
        }

        include 'views/students/create.php';
    }

    public function delete() {
        if(isset($_GET['id'])) {
            $this->student->id = $_GET['id'];
            
            if($this->student->delete()) {
                header('Location: index.php?controller=student&action=index');
                exit;
            } else {
                $error = "Failed to delete student";
                $this->index();
                return;
            }
        }
        
        header('Location: index.php?controller=student&action=index');
        exit;
    }
}
?> 