<?php

include 'DBConnector.php';
$con = (new DatabaseConnector())->getConnection();

// Check if the necessary POST data keys ('Login', 'password') are set.
if (!isset($_POST['Login'], $_POST['Password'])) {
    // If any of these keys are not set, exit and output an error message.
    exit('Please fill both the Loginname and password fields!');
}

if (!$con) {
    echo 'connection error';
}
else {
    $stmt = $con->prepare('SELECT ID, Password FROM Users WHERE Login = ?');
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

            echo 'You have successfully logged in!';
            
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
        echo 'No Loginname exists with that login!';
    }
}
    $stmt = null;
?>
