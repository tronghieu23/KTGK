<?php
require_once 'models/Course.php';

class CourseController {
    private $course;

    public function __construct($db) {
        $this->course = new Course($db);
    }

    public function index() {
        $result = $this->course->getAll();
        require_once 'views/courses/index.php';
    }
}
?>