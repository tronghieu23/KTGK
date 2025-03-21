<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thông Tin Chi Tiết</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 50%;
            margin: 5% auto;
            background: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
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
        img {
            width: 100px;
            height: 100px;
            margin: 20px 0;
        }
        .back-link {
            text-align: center;
            margin-top: 20px;
        }
        .back-link a {
            text-decoration: none;
            color: blue;
        }
    </style>
</head>
<body>
    <header>
        <h1>THÔNG TIN CHI TIẾT</h1>
    </header>
    <div class="container">
        <?php
        require '../../controllers/studentController.php';
        $studentController = new StudentController();
        $student = $studentController->getStudentById($_GET['id']);
        ?>
        <p><strong>Họ Tên:</strong> <?php echo $student['name']; ?></p>
        <p><strong>Giới Tính:</strong> <?php echo $student['gender']; ?></p>
        <p><strong>Ngày Sinh:</strong> <?php echo $student['dob']; ?></p>
        <div>
            <img src="<?php echo $student['image']; ?>" alt="Image">
        </div>
        <p><strong>Mã Ngành:</strong> <?php echo $student['major']; ?></p>
        <div class="back-link">
            <a href="index.php">Back to List</a>
            <a href="edit.php?id=<?php echo $student['id']; ?>">Edit</a>
        
        </div>
    </div>
</body>
</html>