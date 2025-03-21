<?php ob_start(); ?>

<div class="row justify-content-center mt-5">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="text-center">Đăng nhập</h3>
            </div>
            <div class="card-body">
                <?php if(isset($error)): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>

                <form method="POST">
                    <div class="mb-3">
                        <label for="masv" class="form-label">Mã số sinh viên</label>
                        <input type="text" class="form-control" id="masv" name="masv" required>
                    </div>

                    <div class="mb-3">
                        <label for="hoten" class="form-label">Họ tên</label>
                        <input type="text" class="form-control" id="hoten" name="hoten" required>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Đăng nhập</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
require 'views/layout.php';
?>