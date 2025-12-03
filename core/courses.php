<?php

function getAllCourses($mysqli){
    $sql = "SELECT * FROM courses";
    $result = mysqli_query($mysqli,$sql);
    return $row = mysqli_fetch_all($result,MYSQLI_ASSOC);
}
function createCourse($mysqli, $title, $description, $level)
{
    $stmt = $mysqli->prepare("INSERT INTO courses (title, description, level) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $title, $description, $level);
    return $stmt->execute();
}
function countCourse($mysqli)
{
    $sql = "SELECT COUNT(*) as count FROM courses";
    $result = mysqli_query($mysqli,$sql);
    $row = mysqli_fetch_assoc($result);
    return $row['count'];
}
function deleteCourse($mysqli, $id){
    $stmt = $mysqli->prepare("DELETE FROM courses WHERE id = ?");
    $stmt->bind_param("i", $id);
    return $stmt->execute();
}

function voirCourse($mysqli,$id){
    $sql = "SELECT c.*,s.title as title_section FROM courses INNER JOIN sections s ON c.id = s.id_course WHERE id = $id";
    $result = mysqli_query($mysqli,$sql);
    $row = mysqli_fetch_assoc($result);
    return $row;    
}

function editCourse($mysqli,$id,$title,$description,$level){
    $sql = "UPDATE courses SET title=? , description = ? , level = ? WHERE id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("sssi",$title,$description,$level,$id);
    return $stmt->execute();
}

