<?php
namespace App\Models;
class Course
{
    public $id;
    public $title;
    public $image;
    public $description;
    public $level;
    public $created_at;

    public function __construct($id=null,$title = null,$description = null, $level = null, $image=null,$created_at=null)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->image = $image;
        $this->level = $level;
        $this->created_at = $created_at;
    }   
}
