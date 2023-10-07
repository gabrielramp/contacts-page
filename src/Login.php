<?php

include 'DBConnector.php';
$con = (new DatabaseConnector())->getConnection();

// Check if the necessary POST data keys ('user', 'password') are set.
if (!isset($_POST['user'], $_POST['password'])) {
    // If any of these keys are not set, exit and output an error message.
    exit('Please fill both the username and password fields!');
}

if (!$con) {
    echo 'connection error';
}
else {
    $stmt = $con->prepare('SELECT ID, Password FROM Users WHERE Login = ?');
    $stmt->bindValue(1, $_POST['user'], PDO::PARAM_STR);
    $stmt->execute();

    $numRows = $stmt->rowCount();;

    if ($numRows > 0) {

        $row = $stmt->fetch(); // Fetch the first row
        $id = $row['ID'];
        $password = $row['Password'];

        if ($_POST['password'] == $password) {
            // Password is correct! Start the session.
            session_start();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $_POST['user'];
            $_SESSION['id'] = $id;

            echo 'You have successfully logged in!';
            
            // Redirect to the user dashboard or home page.
            header('Location: Home.php');
            exit;
        }
        else {
            // Password is incorrect, display an error message.
            echo $_POST['password'];
            echo $password;
            echo 'Incorrect username and/or password!';
        }
    } 
    else {
        // Username does not exist
        echo 'No username exists with that login!';
    }
}
    $stmt = null;
?>
