<?php
function countSection($mysqli)
{
    $sql = "SELECT COUNT(*) as count FROM sections";
    $result = mysqli_query($mysqli,$sql);
    $row = mysqli_fetch_assoc($result);
    return $row['count'];
}

function getAllSections($mysqli){
    $sql = "SELECT s.*, c.title as course_title FROM sections s JOIN courses c ON s.course_id = c.id ORDER BY c.title, s.position";
    $result = mysqli_query($mysqli, $sql);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function getSectionsByCourse($mysqli, $course_id){
    $stmt = $mysqli->prepare("SELECT s.*, c.title as course_title FROM sections s JOIN courses c ON s.course_id = c.id WHERE s.course_id = ? ORDER BY s.position");
    $stmt->bind_param("i", $course_id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

function getSectionById($mysqli, $id){
    $stmt = $mysqli->prepare("SELECT * FROM sections WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

function createSection($mysqli, $course_id, $title, $content, $position){
    $stmt = $mysqli->prepare("INSERT INTO sections (course_id, title, content, position) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("issi", $course_id, $title, $content, $position);
    return $stmt->execute();
}

function updateSection($mysqli, $id, $course_id, $title, $content, $position){
    $stmt = $mysqli->prepare("UPDATE sections SET course_id = ?, title = ?, content = ?, position = ? WHERE id = ?");
    $stmt->bind_param("issii", $course_id, $title, $content, $position, $id);
    return $stmt->execute();
}

function deleteSection($mysqli, $id){
    $stmt = $mysqli->prepare("DELETE FROM sections WHERE id = ?");
    $stmt->bind_param("i", $id);
    return $stmt->execute();
}

function checkPostion($mysqli,$position,$course_id,$id_section){
    $sql = "SELECT * FROM sections WHERE course_id =$course_id AND position=$position";
    $data = mysqli_query($mysqli,$sql);
    $result = mysqli_fetch_assoc($data);
    if($result && $result["id"] === $id_section) return True;
    if($result && $result["id"] !== $id_section) return False;
    if(!$result) return True;

}
?>
