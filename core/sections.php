<?php
function countSection($mysqli)
{
    $sql = "SELECT COUNT(*) as count FROM sections";
    $result = mysqli_query($mysqli,$sql);
    $row = mysqli_fetch_assoc($result);
    return $row['count'];
}
?>
