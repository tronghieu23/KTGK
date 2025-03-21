<?php ob_start(); ?>

<div class="card">
    <div class="card-header">
        <h2>Student Details</h2>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <?php if($student['Hinh']): ?>
                    <img src="uploads/<?php echo $student['Hinh']; ?>" class="img-fluid rounded" alt="Student Image">
                <?php else: ?>
                    <div class="alert alert-info">No image available</div>
                <?php endif; ?>
            </div>
            <div class="col-md-8">
                <table class="table">
                    <tr>
                        <th>Student ID:</th>
                        <td><?php echo $student['MaSV']; ?></td>
                    </tr>
                    <tr>
                        <th>Full Name:</th>
                        <td><?php echo $student['HoTen']; ?></td>
                    </tr>
                    <tr>
                        <th>Gender:</th>
                        <td><?php echo $student['GioiTinh']; ?></td>
                    </tr>
                    <tr>
                        <th>Birth Date:</th>
                        <td><?php echo $student['NgaySinh']; ?></td>
                    </tr>
                    <tr>
                        <th>Major:</th>
                        <td><?php echo $student['TenNganh']; ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <a href="index.php" class="btn btn-secondary">Back to List</a>
        <a href="index.php?action=edit&id=<?php echo $student['MaSV']; ?>" class="btn btn-warning">Edit</a>
    </div>
</div>

<?php
$content = ob_get_clean();
require 'views/layout.php';
?>