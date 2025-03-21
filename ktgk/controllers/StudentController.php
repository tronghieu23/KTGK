<?php
require_once 'models/Student.php';

class StudentController {
    private $student;

    public function __construct($db) {
        $this->student = new Student($db);
    }

    public function index() {
        $result = $this->student->getAll();
        require_once 'views/students/index.php';
    }

    public function uploadImage($file) {
        $target_dir = dirname(__DIR__) . "/uploads/";
        
        // Create uploads directory if it doesn't exist
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        
        $imageFileType = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
        $newFileName = uniqid() . '.' . $imageFileType;
        $target_file = $target_dir . $newFileName;
    
        // Check if image file is actual image
        if(getimagesize($file["tmp_name"]) === false) {
            return false;
        }
    
        // Check file size (limit to 5MB)
        if ($file["size"] > 5000000) {
            return false;
        }
    
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            return false;
        }
    
        if (move_uploaded_file($file["tmp_name"], $target_file)) {
            return $newFileName;
        }
        return false;
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                // Handle image upload
                $imageName = null;
                if(isset($_FILES["hinh"]) && $_FILES["hinh"]["error"] == 0) {
                    $imageName = $this->uploadImage($_FILES["hinh"]);
                    if(!$imageName) {
                        throw new Exception("Lỗi khi tải ảnh lên!");
                    }
                }

                $data = [
                    'masv' => trim($_POST['masv']),
                    'hoten' => trim($_POST['hoten']),
                    'gioitinh' => $_POST['gioitinh'],
                    'ngaysinh' => $_POST['ngaysinh'],
                    'hinh' => $imageName,
                    'manganh' => 'CNTT'  // Default value
                ];

                if ($this->student->create($data)) {
                    $_SESSION['success'] = "Thêm sinh viên thành công!";
                    header('Location: index.php');
                    exit;
                }
            } catch (Exception $e) {
                $_SESSION['error'] = $e->getMessage();
            }
        }
        require_once 'views/students/create.php';
    }

    public function edit($id) {
        $student = $this->student->getById($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $imageName = $student['Hinh']; // Keep existing image by default
            
            if(isset($_FILES["hinh"]) && $_FILES["hinh"]["error"] == 0) {
                // Delete old image if exists
                if($student['Hinh'] && file_exists(dirname(__DIR__) . "/uploads/" . $student['Hinh'])) {
                    unlink(dirname(__DIR__) . "/uploads/" . $student['Hinh']);
                }
                
                $imageName = $this->uploadImage($_FILES["hinh"]);
                if(!$imageName) {
                    echo "Error uploading file.";
                    return;
                }
            }
    
            $data = [
                'masv' => $id,
                'hoten' => $_POST['hoten'],
                'gioitinh' => $_POST['gioitinh'],
                'ngaysinh' => $_POST['ngaysinh'],
                'hinh' => $imageName,
                'manganh' => $_POST['manganh']
            ];
            
            if($this->student->update($data)) {
                header('Location: index.php?action=index');
            }
        }
        require dirname(__DIR__) . '/views/students/edit.php';
    }

    public function delete($id) {
        if($this->student->delete($id)) {
            header('Location: index.php?action=index');
        }
    }

    public function detail($id) {
        $student = $this->student->getById($id);
        require_once 'views/students/detail.php';
    }
}
?>