<?php ob_start(); ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Trang sinh viên</h2>
    <a href="index.php?action=create" class="btn btn-primary">Thêm sinh viên mới</a>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Mã số sinh viên</th>
            <th>Họ tên</th>
            <th>Giới tính</th>
            <th>Ngày sinh</th>
            <th>Hình</th>
            <th>Ngành</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php while($row = $result->fetch(PDO::FETCH_ASSOC)): ?>
            <tr>
                <td><?php echo $row['MaSV']; ?></td>
                <td><?php echo $row['HoTen']; ?></td>
                <td><?php echo $row['GioiTinh']; ?></td>
                <td><?php echo $row['NgaySinh']; ?></td>
                <!-- Update the image source path -->
                <td>
                    <?php if($row['Hinh']): ?>
                        <img src="<?php echo 'uploads/' . $row['Hinh']; ?>" class="img-thumbnail" width="50">
                    <?php endif; ?>
                </td>
                <td><?php echo $row['TenNganh']; ?></td>
                <td>
                    <a href="index.php?action=detail&id=<?php echo $row['MaSV']; ?>" class="btn btn-info btn-sm">Detail</a>
                    <a href="index.php?action=edit&id=<?php echo $row['MaSV']; ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="index.php?action=delete&id=<?php echo $row['MaSV']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php
$content = ob_get_clean();
require 'views/layout.php';
?>