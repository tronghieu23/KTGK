<?php ob_start(); ?>

<div class="card">
    <div class="card-header bg-primary text-white">
        <h2 class="mb-0 py-2">Đăng Ký Học Phần</h2>
    </div>
    <div class="card-body p-4">
        <?php if(isset($_SESSION['error'])): ?>
            <div class="alert alert-danger p-3 mb-4">
                <?php 
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                ?>
            </div>
        <?php endif; ?>

        <?php if(isset($_SESSION['success'])): ?>
            <div class="alert alert-success p-3 mb-4">
                <?php 
                    echo $_SESSION['success'];
                    unset($_SESSION['success']);
                ?>
            </div>
        <?php endif; ?>

        <div class="row mb-4 g-4">
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header bg-light">
                        <h4 class="mb-0">Danh sách học phần có thể đăng ký</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-bordered align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th class="py-3">Mã HP</th>
                                    <th class="py-3">Tên Học Phần</th>
                                    <th class="py-3">Số Tín Chỉ</th>
                                    <th class="py-3">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($courses as $course): ?>
                                    <?php if(!in_array($course['MaHP'], $registeredCourses)): ?>
                                        <tr>
                                            <td><?php echo $course['MaHP']; ?></td>
                                            <td><?php echo $course['TenHP']; ?></td>
                                            <td><?php echo $course['SoTinChi']; ?></td>
                                            <td>
                                                <form method="POST" action="index.php?controller=registration&action=register">
                                                    <input type="hidden" name="mahp" value="<?php echo $course['MaHP']; ?>">
                                                    <button type="submit" class="btn btn-info btn-sm">Đăng ký</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header bg-light">
                        <h4 class="mb-0">Học phần đã đăng ký</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-bordered align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th class="py-3">Mã HP</th>
                                    <th class="py-3">Tên Học Phần</th>
                                    <th class="py-3">Số Tín Chỉ</th>
                                    <th class="py-3">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($registrations as $reg): ?>
                                    <tr>
                                        <td><?php echo $reg['MaHP']; ?></td>
                                        <td><?php echo $reg['TenHP']; ?></td>
                                        <td><?php echo $reg['SoTinChi']; ?></td>
                                        <td>
                                            <a href="index.php?controller=registration&action=delete&mahp=<?php echo $reg['MaHP']; ?>" 
                                               class="btn btn-danger btn-sm"
                                               onclick="return confirm('Bạn có chắc muốn xóa học phần này không?')">Hủy</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2" class="text-end"><strong>Tổng số tín chỉ:</strong></td>
                                    <td colspan="2"><strong><?php echo $totalCredits; ?></strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .table th, .table td {
        padding: 1rem;
    }
    .btn {
        padding: 0.5rem 1.5rem;
        font-weight: 500;
    }
    .btn-sm {
        min-width: 80px;
    }
    .card {
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }
    .card-header {
        padding: 1rem;
    }
</style>

<?php
$content = ob_get_clean();
require 'views/layout.php';
?>