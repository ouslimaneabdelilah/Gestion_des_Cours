<?php
namespace App\Models;
class Section
{
    public $id;
    public $course_id;
    public $title;
    public $content;
    public $position;
    public $course_title;   
    public function __construct($course_id = null,$title=null,$content=null,$position=null)
    {
        $this->course_id = $course_id;
        $this->title = $title;
        $this->content = $content;
        $this->position = $position;
    }
    
}
