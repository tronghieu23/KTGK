<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Trang Sinh Viên</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 80%;
            margin: 5% auto;
            background: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        header {
            background: #333;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            border-radius: 10px 10px 0 0;
        }
        h1 {
            margin: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ccc;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        img {
            width: 70px; /* Kích thước hình ảnh */
            height: auto;
            border-radius: 5px;
        }
        .actions {
            display: flex;
            justify-content: center;
            gap: 10px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 8px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <header>
        <h1>TRANG SINH VIÊN</h1>
        <a href="add.php" style="color: white; text-decoration: none;">Add Student</a>
    </header>
    <div class="container">
        <table>
            <thead>
                <tr>
                    <th>MSV</th>
                    <th>Họ Tên</th>
                    <th>Giới Tính</th>
                    <th>Ngày Sinh</th>
                    <th>Hình</th>
                    <th>Mã Ngành</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Kết nối đến cơ sở dữ liệu
                $host = "localhost";
                $dbname = "test1"; // Tên cơ sở dữ liệu của bạn
                $username = "root";
                $password = "";

                try {
                    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    // Truy vấn sinh viên
                    $sql = "SELECT msv, ho_ten, gioi_tinh, ngay_sinh, hinh, ma_nganh FROM students"; // Thay đổi tên bảng nếu cần
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();

                    // Hiển thị kết quả
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>
                                <td>{$row['msv']}</td>
                                <td>{$row['ho_ten']}</td>
                                <td>{$row['gioi_tinh']}</td>
                                <td>{$row['ngay_sinh']}</td>
                                <td><img src='{$row['hinh']}' alt='Hình Sinh Viên'></td>
                                <td>{$row['ma_nganh']}</td>
                                <td class='actions'>
                                    <a href='edit.php?id={$row['msv']}'><button>Edit</button></a>
                                    <a href='details.php?id={$row['msv']}'>Details</a>
                                    <a href='delete.php?id={$row['msv']}'>Delete</a>
                                </td>
                            </tr>";
                    }
                } catch (PDOException $e) {
                    echo "Lỗi: " . $e->getMessage();
                }

                //