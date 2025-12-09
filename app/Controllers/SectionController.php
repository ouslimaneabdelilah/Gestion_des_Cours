<?php
require_once "./app/Models/Course.php";
class SectionController
{
    private $sectionModel;
    public function __construct()
    {
        $this->sectionModel = new Section();
    }

    public function index()
    {
        $sections = $this->sectionModel->all();
        include "./resources/views/sections/sections_list.php";
    }

    public function create()
    {
        include "./resources/views/sections/sections_create.php";
    }
    public function store($data)
    {
        $this->sectionModel->create($data["course_id"], $data["title"], $data["content"], $data["position"]);
        header("Location:./resources/views/sections/sections_list.php");
    }

    public function edit($id)
    {
        $course = $this->sectionModel->find($id);
        include "./resources/views/sections/sections_edit.php";
    }
    public function update($id, $data)
    {
        $this->sectionModel->update($id, $data["course_id"], $data["title"], $data["content"], $data["position"]);
        header("Location: ./resources/views/sections/sections_list.php");
    }

    public function destroy($id) {
        $this->sectionModel->delete($id);
        header("Location:./resources/views/sections/sections_list.php");

    }
}
