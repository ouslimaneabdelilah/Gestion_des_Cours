<?php 
require_once "./app/DAO/CourseDao.php";
class CourseService{
    private $courseDAO;
    public function __construct(CourseDAO $courseDAO)
    {
        $this->courseDAO = $courseDAO;
    }

}

?>