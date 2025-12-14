<?php
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
    public function setTitle($title){
        $this->title = $title;
    }
    public function setdescription($description){
        $this->description = $description;
    }
    public function setImage($image){
        $this->image = $image;
    }
    public function setLevel($level){
        $this->level = $level;
    }
    public function getId(){
        return $this->id;
    }
    public function getImage(){
        return $this->image;
    }
    public function getDescription(){
        return $this->description;
    }
    public function getLevel(){
        return $this->level;
    }
    public function getTitle(){
        return $this->title;
    }
    
    
}
