<?php
include "connection.php";

$queryTotalStudent = "SELECT COUNT(*) AS total FROM Student";
$result_total_student = $conn->query($queryTotalStudent);
$totalStudent = $result_total_student->fetch_assoc()["total"];

$queryOnlineStudent = "SELECT COUNT(*) AS online FROM Student WHERE status = 'active'";
$resultOnlineStudent = $conn->query($queryOnlineStudent);
$totalOnline = $resultOnlineStudent->fetch_assoc()["online"];

echo json_encode([
    "totalStudent" => $totalStudent,
    "totalOnline"=> $totalOnline

]);
?>
