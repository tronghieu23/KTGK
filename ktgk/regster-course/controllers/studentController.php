<?php
require '../config/database.php';
require '../models/Student.php';

class StudentController {
    public function getStudents() {
        global $pdo;
        $query = "SELECT * FROM students";
        $stmt = $pdo->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createStudent($data) {
        global $pdo;
        $query = "INSERT INTO students (name, gender, dob, major, image) VALUES (:name, :gender, :dob, :major, :image)";
        $stmt = $pdo->prepare($query);
        $stmt->execute($data);
    }

    public function getStudentById($id) {
        global $pdo;
        $query = "SELECT * FROM students WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateStudent($data) {
        global $pdo;
        $query = "UPDATE students SET name = :name, gender = :gender, dob = :dob, major = :major, image = :image WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->execute($data);
    }

    public function deleteStudent($id) {
        global $pdo;
        $query = "DELETE FROM students WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['id' => $id]);
    }
}
?>