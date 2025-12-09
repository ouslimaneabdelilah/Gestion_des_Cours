<?php
require_once "./app/Models/Course.php";
class CourseController
{
    private $courseModel;
    public function __construct()
    {
        $this->courseModel = new Course();
    }

    public function index()
    {
        $courses = $this->courseModel->all();
        include "./resources/views/courses/courses_list.php";
    }

    public function create()
    {
        include "./resources/views/courses/courses_create.php";
    }

    public function store($data)
    {
        $this->courseModel->create($data["title"], $data["description"], $data["level"]);
        header("Location:./resources/views/courses/courses_list.php");
    }

    public function edit($id)
    {
        $course = $this->courseModel->find($id);
        include "./resources/views/courses/courses_edit.php";
    }
    public function update($id, $data)
    {
        $this->courseModel->update($id, $data["title"], $data["description"], $data["level"]);
        header("Location: ./resources/views/courses/courses_list.php");
    }

    public function destroy($id) {
        $this->courseModel->delete($id);
        header("Location:./resources/views/courses/courses_list.php");

    }
}
