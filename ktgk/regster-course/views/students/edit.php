<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa Thông Tin Sinh Viên</title>
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
        label {
            display: block;
            margin: 10px 0 5px;
        }
        input[type="text"],
        input[type="date"],
        input[type="file"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }
        button:hover {
            background-color: #45a049;
        }
        .back-link {
            text-align: center;
            margin-top: 20px;
        }
        .image-preview {
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <header>
        <h1>HIỆU CHỈNH THÔNG TIN SINH VIÊN</h1>
    </header>
    <div class="container">
        <?php
        require '../../controllers/studentController.php';
        $studentController = new StudentController();
        $student = $studentController->getStudentById($_GET['id']);
        ?>
        <form action="../../controllers/studentController.php?action=update" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $student['id']; ?>">

            <label for="name">Họ Tên</label>
            <input type="text" id="name" name="name" value="<?php echo $student['name']; ?>" required>

            <label for="gender">Giới Tính</label>
            <select id="gender" name="gender" required>
                <option value="Nam" <?php echo ($student['gender'] == 'Nam') ? 'selected' : ''; ?>>Nam</option>
                <option value="Nữ" <?php echo ($student['gender'] == 'Nữ') ? 'selected' : ''; ?>>Nữ</option>
            </select>

            <label for="dob">Ngày Sinh</label>
            <input type="date" id="dob" name="dob" value="<?php echo $student['dob']; ?>" required>

            <label for="image">Hình</label>
            <input type="file" id="image" name="image" accept="image/*">
            <div class="image-preview">
                <img src="<?php echo $student['image']; ?>" alt="Image" width="100" height="100">
            </div>

            <label for="major">Mã Ngành</label>
            <input type="text" id="major" name="major" value="<?php echo $student['major']; ?>" required>

            <button type="submit">Lưu</button>
        </form>
        <div class="back-link">
            <a href="index.php">Back to List</a>
        </div>
    </div>
</body>
</html>