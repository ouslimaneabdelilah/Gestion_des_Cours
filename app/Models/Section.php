<?php
namespace App\Models;
use AllowDynamicProperties;
#[AllowDynamicProperties]
class Section
{
    public $id;
    public $course_id;
    public $title;
    public $content;
    public $position;
    public function __construct($id=null,$course_id = null,$title=null,$content=null,$position=null)
    {
        $this->id= $id;
        $this->course_id = $course_id;
        $this->title = $title;
        $this->content = $content;
        $this->position = $position;
    }
    
}
