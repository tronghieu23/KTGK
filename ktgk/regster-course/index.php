<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Trang Chủ</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #f4f4f4;
        }
        header {
            background: #333;
            color: #fff;
            text-align: center;
            padding: 10px 0;
        }
        nav {
            background-color: #444;
            overflow: hidden;
        }
        nav a {
            float: left;
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }
        nav a:hover {
            background-color: #ddd;
            color: black;
        }
        .container {
            width: 80%;
            margin: 20px auto;
            background: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <header>
        <h1>TRANG CHỦ</h1>
    </header>
    <nav>
        <a href="index.php">Test1</a>
        <a href="views/students/index.php">Sinh Viên</a>
        <a href="courses/register.php">Học Phần</a>
        <a href="register.php">Đăng Ký</a>
        <a href="login.php">Đăng Nhập</a>
    </nav>
    <div class="container">
        <h2>Danh sách sinh viên</h2>
        <?php include 'views/students/index.php'; ?> <!-- Nhúng nội dung trang sinh viên -->
    </div>
</body>
</html>