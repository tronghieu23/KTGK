<?php
class RegistrationController {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function index() {
        $masv = $_SESSION['user_id'];
        
        // Get all available courses - modified query to show all courses
        $query = "SELECT * FROM HocPhan";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Get registered courses
        $query = "SELECT hp.MaHP, hp.TenHP, hp.SoTinChi 
                 FROM DangKy dk 
                 JOIN ChiTietDangKy ct ON dk.MaDK = ct.MaDK
                 JOIN HocPhan hp ON ct.MaHP = hp.MaHP
                 WHERE dk.MaSV = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$masv]);
        $registrations = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Get list of registered course IDs
        $registeredCourses = array_column($registrations, 'MaHP');

        // Calculate total credits
        $totalCredits = 0;
        foreach($registrations as $reg) {
            $totalCredits += $reg['SoTinChi'];
        }

        require_once 'views/registration/index.php';
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['mahp'])) {
            $masv = $_SESSION['user_id'];
            $mahp = $_POST['mahp'];

            try {
                $this->conn->beginTransaction();

                // Check if student already registered this course
                $checkQuery = "SELECT COUNT(*) FROM DangKy dk 
                             JOIN ChiTietDangKy ct ON dk.MaDK = ct.MaDK 
                             WHERE dk.MaSV = ? AND ct.MaHP = ?";
                $stmt = $this->conn->prepare($checkQuery);
                $stmt->execute([$masv, $mahp]);
                if ($stmt->fetchColumn() > 0) {
                    throw new Exception("Bạn đã đăng ký học phần này rồi!");
                }

                // Get or create registration record
                $regQuery = "SELECT MaDK FROM DangKy WHERE MaSV = ? ORDER BY NgayDK DESC LIMIT 1";
                $stmt = $this->conn->prepare($regQuery);
                $stmt->execute([$masv]);
                $registration = $stmt->fetch();

                if (!$registration) {
                    // Create new registration
                    $insertQuery = "INSERT INTO DangKy (NgayDK, MaSV) VALUES (CURRENT_DATE(), ?)";
                    $stmt = $this->conn->prepare($insertQuery);
                    $stmt->execute([$masv]);
                    $madk = $this->conn->lastInsertId();
                } else {
                    $madk = $registration['MaDK'];
                }

                // Add course to registration
                $detailQuery = "INSERT INTO ChiTietDangKy (MaDK, MaHP) VALUES (?, ?)";
                $stmt = $this->conn->prepare($detailQuery);
                $stmt->execute([$madk, $mahp]);

                $this->conn->commit();
                $_SESSION['success'] = "Đăng ký học phần thành công!";
            } catch(Exception $e) {
                $this->conn->rollBack();
                $_SESSION['error'] = "Lỗi: " . $e->getMessage();
            }
            header('Location: index.php?controller=registration');
            exit;
        }
    }

    public function delete() {
        if(isset($_GET['mahp'])) {
            $masv = $_SESSION['user_id'];
            $mahp = $_GET['mahp'];

            try {
                $this->conn->beginTransaction();

                // Get the registration ID
                $query = "SELECT dk.MaDK FROM DangKy dk 
                         JOIN ChiTietDangKy ct ON dk.MaDK = ct.MaDK 
                         WHERE dk.MaSV = ? AND ct.MaHP = ?";
                $stmt = $this->conn->prepare($query);
                $stmt->execute([$masv, $mahp]);
                $registration = $stmt->fetch();

                if($registration) {
                    // Delete the course registration
                    $query = "DELETE FROM ChiTietDangKy WHERE MaDK = ? AND MaHP = ?";
                    $stmt = $this->conn->prepare($query);
                    $stmt->execute([$registration['MaDK'], $mahp]);

                    $this->conn->commit();
                    $_SESSION['success'] = "Đã xóa học phần thành công!";
                }
            } catch(Exception $e) {
                $this->conn->rollBack();
                $_SESSION['error'] = "Lỗi xóa học phần: " . $e->getMessage();
            }
            header('Location: index.php?controller=registration');
            exit;
        }
    }
}
?>