<?php
require_once 'models/User.php';
require_once 'config/database.php';

class AuthController {
    private $db;
    private $user;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->user = new User($this->db);
    }

    public function register() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->user->username = $_POST['username'] ?? '';
            $this->user->email = $_POST['email'] ?? '';
            $this->user->password = $_POST['password'] ?? '';

            // Validate inputs
            if(empty($this->user->username) || empty($this->user->email) || empty($this->user->password)) {
                $error = "All fields are required";
                include 'views/auth/register.php';
                return;
            }

            // Check if email already exists
            if($this->user->emailExists()) {
                $error = "Email already exists";
                include 'views/auth/register.php';
                return;
            }

            // Create user
            if($this->user->create()) {
                $success = "Registration successful. You can now login.";
                include 'views/auth/login.php';
                return;
            } else {
                $error = "Registration failed";
                include 'views/auth/register.php';
                return;
            }
        }

        include 'views/auth/register.php';
    }

    public function login() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->user->email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            // Validate inputs
            if(empty($this->user->email) || empty($password)) {
                $error = "Email and password are required";
                include 'views/auth/login.php';
                return;
            }

            // Check if email exists
            if($this->user->emailExists()) {
                // Verify password
                if(password_verify($password, $this->user->password)) {
                    // Start session if not already started
                    if(session_status() === PHP_SESSION_NONE) {
                        session_start();
                    }
                    $_SESSION['user_id'] = $this->user->id;
                    $_SESSION['username'] = $this->user->username;
                    
                    // Redirect to students page
                    header('Location: index.php?controller=student&action=index');
                    exit;
                } else {
                    $error = "Invalid password";
                    include 'views/auth/login.php';
                    return;
                }
            } else {
                $error = "Email not found";
                include 'views/auth/login.php';
                return;
            }
        }

        include 'views/auth/login.php';
    }

    public function logout() {
        // Start session if not already started
        if(session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_unset();
        session_destroy();
        header('Location: index.php');
        exit;
    }
}
?> 