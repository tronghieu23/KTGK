<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <form action="../../controllers/authController.php" method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
</body>
</html>