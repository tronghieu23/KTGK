<?php ob_start(); ?>

<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h2>Thêm Sinh Viên Mới</h2>
        </div>
        <div class="card-body">
            <?php if(isset($_SESSION['error'])): ?>
                <div class="alert alert-danger">
                    <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="index.php?controller=student&action=create" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="masv" class="form-label">Mã sinh viên</label>
                    <input type="text" class="form-control" id="masv" name="masv" required>
                </div>
                <div class="mb-3">
                    <label for="hoten" class="form-label">Họ tên</label>
                    <input type="text" class="form-control" id="hoten" name="hoten" required>
                </div>
                <div class="mb-3">
                    <label for="gioitinh" class="form-label">Giới tính</label>
                    <select class="form-control" id="gioitinh" name="gioitinh">
                        <option value="Nam">Nam</option>
                        <option value="Nữ">Nữ</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="ngaysinh" class="form-label">Ngày sinh</label>
                    <input type="date" class="form-control" id="ngaysinh" name="ngaysinh" required>
                </div>
                <div class="mb-3">
                    <label for="hinh" class="form-label">Hình ảnh</label>
                    <input type="file" class="form-control" id="hinh" name="hinh" accept="image/*">
                </div>
                <div class="mb-3">
                    <input type="hidden" name="manganh" value="CNTT">
                    <button type="submit" class="btn btn-primary">Lưu</button>
                    <a href="index.php?controller=student" class="btn btn-secondary">Hủy</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
require 'views/layout.php';
?>