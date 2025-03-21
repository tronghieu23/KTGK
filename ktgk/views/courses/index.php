<?php ob_start(); ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Danh sách học phần</h2>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Mã học phần</th>
            <th>Tên học phần</th>
            <th>Số tín chỉ</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php while($row = $result->fetch(PDO::FETCH_ASSOC)): ?>
            <tr>
                <td><?php echo $row['MaHP']; ?></td>
                <td><?php echo $row['TenHP']; ?></td>
                <td><?php echo $row['SoTinChi']; ?></td>
                <td>
                    <a href="index.php?controller=registration&action=register&id=<?php echo $row['MaHP']; ?>" 
                       class="btn btn-primary btn-sm">Đăng ký</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php
$content = ob_get_clean();
require 'views/layout.php';
?>