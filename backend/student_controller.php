<?php
include "connection.php";

header('Content-Type: application/json');

$response = ["status" => "error", "message" => ""];

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username   = trim($_POST['username']);
    $email      = trim($_POST['email']);
    $password   = trim($_POST['password']);
    $course_id  = intval($_POST['course']);
    $yearLevel  = intval($_POST['year']);
    $created_by = 6;

    if(empty($username) || empty($email) || empty($password) || empty($course_id) || empty($yearLevel)){
        $response["message"] = "All fields are required.";
        echo json_encode($response);
        exit;
    }

    try {
        $stmt = $conn->prepare("CALL register_student(?, ?, ?, ?, ?, ?)");
        if(!$stmt){
            throw new Exception($conn->error);
        }

        $stmt->bind_param("sssiii", $username, $email, $password, $course_id, $yearLevel, $created_by);
        $stmt->execute();

        $response["status"] = "success";
        $response["message"] = "Student registered successfully!";
        $response["redirect"] = "dashboard.php";

        $stmt->close();

    } catch(Exception $e){
        $response["message"] = $e->getMessage();
    }

    $conn->close();
    echo json_encode($response);

} else {
    $response["message"] = "Invalid request method.";
    echo json_encode($response);
}

?>
