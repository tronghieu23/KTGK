<?php ob_start(); ?>

<h2>Edit Student</h2>

<form method="POST" enctype="multipart/form-data" class="mt-4">
    <div class="mb-3">
        <label for="masv" class="form-label">Mã số sinh viên</label>
        <input type="text" class="form-control" id="masv" name="masv" value="<?php echo $student['MaSV']; ?>" readonly>
    </div>

    <div class="mb-3">
        <label for="hoten" class="form-label">Họ tên</label>
        <input type="text" class="form-control" id="hoten" name="hoten" value="<?php echo $student['HoTen']; ?>" required>
    </div>

    <div class="mb-3">
        <label for="gioitinh" class="form-label">Giới tính</label>
        <select class="form-control" id="gioitinh" name="gioitinh" required>
            <option value="Nam" <?php echo ($student['GioiTinh'] == 'Nam') ? 'selected' : ''; ?>>Nam</option>
            <option value="Nữ" <?php echo ($student['GioiTinh'] == 'Nữ') ? 'selected' : ''; ?>>Nữ</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="ngaysinh" class="form-label">Ngày sinh</label>
        <input type="date" class="form-control" id="ngaysinh" name="ngaysinh" value="<?php echo $student['NgaySinh']; ?>" required>
    </div>

    <div class="mb-3">
        <label for="hinh" class="form-label">Hình</label>
        <?php if($student['Hinh']): ?>
            <div class="mb-2">
                <img src="uploads/<?php echo $student['Hinh']; ?>" class="img-thumbnail" width="150">
            </div>
        <?php endif; ?>
        <input type="file" class="form-control" id="hinh" name="hinh" accept="image/*">
    </div>

    <div class="mb-3">
        <label for="manganh" class="form-label">Ngành</label>
        <select class="form-control" id="manganh" name="manganh" required>
            <option value="CNTT" <?php echo ($student['MaNganh'] == 'CNTT') ? 'selected' : ''; ?>>Công nghệ thông tin</option>
            <option value="QTKD" <?php echo ($student['MaNganh'] == 'QTKD') ? 'selected' : ''; ?>>Quản trị kinh doanh</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Lưu</button>
    <a href="index.php" class="btn btn-secondary">Hủy</a>
</form>

<?php
$content = ob_get_clean();
require dirname(__DIR__) . '/layout.php';
?>