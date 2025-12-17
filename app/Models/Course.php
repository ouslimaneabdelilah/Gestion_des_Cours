<?php
namespace App\Models;
class Course
{
    private $id;
    private $title;
    private $image;
    private $description;
    private $level;

    public function __construct($title = null,$description = null, $level = null, $image=null)
    {
        $this->title = $title;
        $this->description = $description;
        $this->image = $image;
        $this->level = $level;
    }   
}
