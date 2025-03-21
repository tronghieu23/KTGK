<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Xóa Thông Tin Sinh Viên</title>
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
        .actions {
            margin-top: 20px;
        }
        .actions a {
            margin: 0 10px;
            text-decoration: none;
            color: blue;
        }
    </style>
</head>
<body>
    <header>
        <h1>XÓA THÔNG TIN</h1>
    </header>
    <div class="container">
        <?php
        require '../../controllers/studentController.php';
        $studentController = new StudentController();
        $student = $studentController->getStudentById($_GET['id']);
        ?>
        <p>Are you sure you want to delete this?</p>
        <p><strong>Họ Tên:</strong> <?php echo $student['name']; ?></p>
        <p><strong>Giới Tính:</strong> <?php echo $student['gender']; ?></p>
        <p><strong>Ngày Sinh:</strong> <?php echo $student['dob']; ?></p>
        <div>
            <img src="<?php echo $student['image']; ?>" alt="Image">
        </div>
        <p><strong>Mã Ngành:</strong> <?php echo $student['major']; ?></p>
        <form action="../../controllers/studentController.php?action=delete" method="POST">
            <input type="hidden" name="id" value="<?php echo $student['id']; ?>">
            <div class="actions">
                <button type="submit">Delete</button>
                <a href="index.php">Back to List</a>
            </div>
        </form>
    </div>
</body>
</html>