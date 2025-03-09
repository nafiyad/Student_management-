<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <a class="navbar-brand" href="index.php">Student Management</a>
            <ul class="navbar-nav">
                <?php if(isset($_SESSION['user_id'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?controller=student&action=index">Students</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?controller=student&action=create">Add Student</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?controller=auth&action=logout">Logout</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?controller=auth&action=login">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?controller=auth&action=register">Register</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
    <div class="container mt-4"> 