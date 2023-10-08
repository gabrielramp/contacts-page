<?php

include 'DBConnector.php';
$conn = (new DatabaseConnector())->getConnection();

// Check if the data exists.
if (!isset($_POST['Login'], $_POST['Password'], $_POST['FirstName'], $_POST['LastName'])) {
    // Data doesn't exist
    exit('Please complete the registration form!');
}
// Check if any field are empty
if (empty($_POST['Login']) || empty($_POST['Password']) || empty($_POST['FirstName']) || empty($_POST['LastName'])) {
    // there is an empty field
    exit('Please complete the registration form');
}

// Check if password is too short or long
if (strlen($_POST['Password']) > 20 || strlen($_POST['Password']) < 5) {
    // password is too short or too long
    exit('Password must be between 5 and 20 characters long!');
}

// Check if username is used
if (!$conn) {
    returnWithError("Connection error.");
}
else {
    $stmt = $conn->prepare('SELECT ID, password FROM Users WHERE Login = ?');
    $stmt->bindValue(1, $_POST['Login']);
    $stmt->execute();

    $numRows = $stmt->rowCount();

    if ($numRows > 0) {
        // Login already in use
        echo 'Login exists, please choose another!';
    } else {
        // email not in use, insert new account
        if ($stmt = $conn->prepare('INSERT INTO Users(FirstName, LastName, Login, Password) VALUES(?, ?, ?, ?)')) {

            // Protect password
            $stmt->bindValue(1, $_POST['FirstName'], PDO::PARAM_STR);
            $stmt->bindValue(2, $_POST['LastName'], PDO::PARAM_STR);
            $stmt->bindValue(3, $_POST['Login'], PDO::PARAM_STR);
            $stmt->bindValue(4, $_POST['Password'], PDO::PARAM_STR);
            $stmt->execute();

            // Account created, redirect to login page
            echo 'You have successfully registered, you can now login!';
        } else {
            // Error with SQL Query
            echo 'Could not prepare statement!';
        }
    }
    $stmt = null;
}
$stmt = null;
?>