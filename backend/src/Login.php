<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'DBConnector.php';

$response = ['status' => 'error', 'message' => 'Unknown error.'];

$conn = (new DatabaseConnector())->getConnection();

if (!isset($_POST['Login'], $_POST['Password']) || empty($_POST['Login']) || empty($_POST['Password'])) {
    $response['message'] = "Please fill both the username and password fields!";
    echo json_encode($response);
    exit;
}

if (!$conn) {
    $response['message'] = "Connection error.";
    echo json_encode($response);
    exit;
}

$stmt = $conn->prepare('SELECT ID, Password FROM Users WHERE Login = ?');
$stmt->bindValue(1, $_POST['Login'], PDO::PARAM_STR);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    $row = $stmt->fetch();
    $id = $row['ID'];
    $password = $row['Password'];

    if (password_verify($_POST['Password'], $password)) {
        session_start();
        $_SESSION['loggedin'] = TRUE;
        $_SESSION['name'] = $_POST['Login'];
        $_SESSION['id'] = $id;

        header("Location: Search.php");
    } else {
        $response['message'] = "Incorrect Loginname and/or password!";
    }
} else {
    $response['message'] = "No user exists with that login!";
}

$stmt = null;
exit;
?>