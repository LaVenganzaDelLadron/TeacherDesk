<?php
require_once "connection.php";

if(isset($_POST["signup"])){
    $username = $_POST["rUsername"];
    $email = $_POST["rEmail"];
    $password = $_POST["rPassword"];

    $stmt = $conn->prepare("CALL signup(?, ?, ?)");
    $stmt->bind_param("sss",$username, $email, $password);

    if($stmt->execute()){
        echo json_encode(["status" => "success", "message" => "Signup Successfully"]);
    } else {
        echo json_encode(["status" => "error", "message" => $stmt->error]);
    }
    $stmt->close();
}


if(isset($_POST["login"])){
    $username = $_POST["lEmail"];
    $password = $_POST["lPassword"];

    $stmt = $conn->prepare("CALL login(?, ?)");
    $stmt->bind_param("ss", $username, $password);

    if($stmt->execute()){
        $result = $stmt->get_result();
        if($result->num_rows > 0){
            echo json_encode(["status" => "success", "message" => "Login Successfully", "redirect" => "dashboard.php"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Invalid username or password"]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => $stmt->error]);
    }
    $stmt->close();
}
?>
