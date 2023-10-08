<?php

// Include the DBConnector.php file to use the DatabaseConnector class.
include 'DBConnector.php';

$conn = (new DatabaseConnector())->getConnection();

// Check if the necessary POST data keys ('user', 'password') are set.
if (!isset($_POST['Login'], $_POST['Password'])) {
    // If any of these keys are not set, exit and output an error message.
    echo '<script>createAlertDialog("Please fill both the username and password fields!", "danger")</script>';
    exit;
}

if (empty($_POST['Login']) || empty($_POST['Password'])) {
    // there is an empty field
    echo '<script>createAlertDialog("Please fill both the username and password fields!", "danger")</script>';
    exit;
}

if (!$conn) {
    returnWithError("Connection error.");
}
else {
    $stmt = $conn->prepare('SELECT ID, Password FROM Users WHERE Login = ?');
    $stmt->bindValue(1, $_POST['Login'], PDO::PARAM_STR);
    $stmt->execute();

    $numRows = $stmt->rowCount();;
    if ($numRows > 0) {

        $row = $stmt->fetch(); // Fetch the first row
        $id = $row['ID'];
        $password = $row['Password'];

        if (password_verify($_POST['Password'], $password)) {
            // Password is correct! Start the session.
            session_start();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $_POST['Login'];
            $_SESSION['id'] = $id;

            echo '<script>createAlertDialog("You have successfully logged in!", "danger")</script>';

            // Redirect to the Login dashboard or home page.
            header('Location: Home.php');
            exit;
        }
        else {
            // Password is incorrect, display an error message.
            echo $_POST['Password'];
            echo $password;
            echo 'Incorrect Loginname and/or password!';
        }
    }
    else {
        // Loginname does not exist
        echo '<script>createAlertDialog("No Loginname exists with that login!", "danger")</script>';
    }
}
$stmt = null;
?>
