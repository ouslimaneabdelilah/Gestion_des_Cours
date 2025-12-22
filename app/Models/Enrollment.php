<?php
namespace App\Models;

class Enrollment {
    public $id;
    public $user_id;
    public $course_id;
    public $enrolled_at;

    public function __construct($user_id, $course_id, $id = null, $enrolled_at = null) {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->course_id = $course_id;
        $this->enrolled_at = $enrolled_at;
    }
}