<?php include 'views/layouts/header.php'; ?>

<div class="row">
    <div style="max-width: 500px; margin: 0 auto;">
        <div class="card">
            <div class="card-header">
                <h3>Login</h3>
            </div>
            <div class="card-body">
                <?php if(isset($error)): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>
                <?php if(isset($success)): ?>
                    <div class="alert alert-success"><?php echo $success; ?></div>
                <?php endif; ?>
                <form method="post" action="index.php?controller=auth&action=login">
                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
                <div class="mt-3">
                    <p>Don't have an account? <a href="index.php?controller=auth&action=register">Register</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'views/layouts/footer.php'; ?> 