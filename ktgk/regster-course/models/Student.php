<?php
class Student {
    public $id;
    public $name;
    public $gender;
    public $dob;
    public $major;
    public $image;

    public function __construct($id, $name, $gender, $dob, $major, $image) {
        $this->id = $id;
        $this->name = $name;
        $this->gender = $gender;
        $this->dob = $dob;
        $this->major = $major;
        $this->image = $image;
    }
}
?>