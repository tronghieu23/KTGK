<?php
class AuthController {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $masv = $_POST['masv'];
            $hoten = $_POST['hoten'];

            $query = "SELECT * FROM SinhVien WHERE MaSV = ? AND HoTen = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$masv, $hoten]);

            if ($stmt->rowCount() > 0) {
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                $_SESSION['user_id'] = $user['MaSV'];
                $_SESSION['user_name'] = $user['HoTen'];
                header('Location: index.php');
                exit;
            } else {
                $error = "Thông tin đăng nhập không chính xác";
            }
        }
        require_once 'views/auth/login.php';
    }

    public function logout() {
        session_destroy();
        header('Location: index.php?controller=auth&action=login');
        exit;
    }
}
?>