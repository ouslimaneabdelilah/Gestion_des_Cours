<?php
namespace App\Models;
class Section
{
    private $id;
    private $course_id;
    private $title;
    private $content;
    private $position;
    public function __construct($course_id = null,$title=null,$content=null,$position=null)
    {
        $this->course_id = $course_id;
        $this->title = $title;
        $this->content = $content;
        $this->position = $position;
    }
    
}
