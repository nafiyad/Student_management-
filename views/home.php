<?php include 'layouts/header.php'; ?>

<div class="jumbotron">
    <h1 class="display-4">Welcome to Student Management System</h1>
    <p class="lead">This application helps you manage student information efficiently.</p>
    <hr class="my-4">
    <?php if(!isset($_SESSION['user_id'])): ?>
        <p>Please login or register to get started.</p>
        <a class="btn btn-primary btn-lg" href="index.php?controller=auth&action=login" role="button">Login</a>
        <a class="btn btn-secondary btn-lg" href="index.php?controller=auth&action=register" role="button">Register</a>
    <?php else: ?>
        <p>You are logged in as <?php echo $_SESSION['username']; ?>.</p>
        <a class="btn btn-primary btn-lg" href="index.php?controller=student&action=index" role="button">View Students</a>
    <?php endif; ?>
</div>

<?php include 'layouts/footer.php'; ?> 