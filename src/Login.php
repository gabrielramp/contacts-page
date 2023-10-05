<?php

// Include the DBConnector.php file to use the DatabaseConnector class.
include 'DBConnector.php';

// Use an alias 'db' for the DatabaseConnector class to shorten the syntax.
use DatabaseConnector as db;

// Create a new instance of the DatabaseConnector class, stored in the variable $con.
$con = new db();

// Check if the necessary POST data keys ('user', 'password') are set.
if (!isset($_POST['user'], $_POST['password'])) {
    // If any of these keys are not set, exit and output an error message.
    exit('Please fill both the username and password fields!');
}

// Prepare an SQL query to fetch the user data based on the username.
if ($stmt = $con->prepare('SELECT ID, Password FROM Users WHERE Login = ?')) {
    
    // Bind the 'user' POST data to the SQL query.
    $stmt->bind_param('s', $_POST['user']);
    // Execute the SQL query.
    $stmt->execute();
    // Bind the result to variables.
    $stmt->bind_result($id, $password);
    // Fetch the data.
    $stmt->fetch();
    
    // Close the statement to free up resources.
    $stmt->close();
    
    // Check if the password matches the hashed password stored in the database.
    if (password_verify($_POST['password'], $password)) {
        // Password is correct! Start the session.
        session_start();
        $_SESSION['loggedin'] = TRUE;
        $_SESSION['name'] = $_POST['user'];
        $_SESSION['id'] = $id;
        
        // Redirect to the user dashboard or home page.
        header('Location: dashboard.php');
        exit;
    } else {
        // Password is incorrect, display an error message.
        echo 'Incorrect username and/or password!';
    }
    
} else {
    // Error with SQL Query
    echo 'Could not prepare statement!';
}

// Close the database connection to free up resources.
$con->close();

?>
