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
