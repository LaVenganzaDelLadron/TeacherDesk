<?php
require 'connection.php';

if(isset($_GET['action']) && $_GET['action'] === 'students'){
    $sql = "
        SELECT s.student_id, s.username, c.name AS courseName, s.yearLevel, s.status
        FROM Student s
        JOIN Course c ON s.course_id = c.course_id
        ORDER BY s.username ASC
    ";
    $result = $conn->query($sql);
    $students = [];
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $students[] = [
                "id" => $row["student_id"],
                "name" => $row["username"],
                "course" => $row["courseName"],
                "year" => $row["yearLevel"],
                "status" => $row["status"]
            ];
        }
    }
    echo json_encode($students);
    exit;
}
?>
