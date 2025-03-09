<?php include 'views/layouts/header.php'; ?>

<h2>Student List</h2>

<?php if(isset($error)): ?>
    <div class="alert alert-danger"><?php echo $error; ?></div>
<?php endif; ?>

<div class="mb-3">
    <a href="index.php?controller=student&action=create" class="btn btn-primary">Add New Student</a>
</div>

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Student ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['student_id']); ?></td>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td>
                        <a href="index.php?controller=student&action=delete&id=<?php echo $row['id']; ?>" 
                           class="btn btn-danger btn-sm" 
                           onclick="return confirm('Are you sure you want to delete this student?')">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
            <?php if($stmt->rowCount() == 0): ?>
                <tr>
                    <td colspan="4" class="text-center">No students found</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php include 'views/layouts/footer.php'; ?> 