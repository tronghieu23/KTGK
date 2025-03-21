<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            max-width: 1400px;
            margin: 0 auto;
        }
        .table th, .table td {
            vertical-align: middle;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">Quản lý sinh viên</a>
            <?php if(isset($_SESSION['user_id'])): ?>
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Sinh Viên</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?controller=course">Học Phần</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?controller=registration">Đăng Ký Học Phần</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <span class="nav-link">Xin chào, <?php echo $_SESSION['user_name']; ?></span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?controller=auth&action=logout">Đăng xuất</a>
                        </li>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
    </nav>

    <div class="container mt-4">
        <?php echo $content; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>