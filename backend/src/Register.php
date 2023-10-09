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
        // This function is defined in the showNextField.js file. Please read and understand how to use this
        // As currently it uses HTMX to not break anything...
        echo '<script>createAlert("The user already exists. Please login instead.", "danger")</script>';
    } else {
        // email not in use, insert new account
        if ($stmt = $conn->prepare('INSERT INTO Users(FirstName, LastName, Login, Password) VALUES(?, ?, ?, ?)')) {

            // Protect password
            $stmt->bindValue(1, $_POST['FirstName'], PDO::PARAM_STR);
            $stmt->bindValue(2, $_POST['LastName'], PDO::PARAM_STR);
            $stmt->bindValue(3, $_POST['Login'], PDO::PARAM_STR);
            $stmt->bindValue(4, password_hash($_POST['Password'], PASSWORD_DEFAULT), PDO::PARAM_STR);
            $stmt->execute();

            // Account created, redirect to login page
            echo '<script>createAlert("You have successfully registered, you can now login!", "danger")</script>';
        } else {
            // Error with SQL Query
            echo '<script>createAlert("Could not prepare statement", "danger")</script>';
        }
    }
    $stmt = null;
}
$stmt = null;
?>