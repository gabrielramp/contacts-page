<?php

// Include the DBConnector.php file to use the DatabaseConnector class.
include 'DBConnector.php';

// Use an alias 'db' for the DatabaseConnector class to shorten the syntax.
use DatabaseConnector as db;

// Create a new instance of the DatabaseConnector class, stored in the variable $con.
$con = new db();

// Check if the necessary POST data keys ('Login', 'Password', 'FirstName', 'LastName') are set.
if (!isset($_POST['Login'], $_POST['Password'], $_POST['FirstName'], $_POST['LastName'])) {
	// If any of these keys are not set, exit and output an error message.
	exit('Please complete the registration form!');
}

// Check if any of the necessary fields are empty.
if (empty($_POST['Login']) || empty($_POST['Password']) || empty($_POST['FirstName']) || empty($_POST['LastName'])) {
	// If any fields are empty, exit and output an error message.
	exit('Please complete the registration form');
}

// Check the length of the password to ensure it's between 5 and 20 characters.
if (strlen($_POST['Password']) > 20 || strlen($_POST['Password']) < 5) {
	// If the password is too short or too long, exit and output an error message.
	exit('Password must be between 5 and 20 characters long!');
}

// Prepare an SQL query to check if the username is already in use.
if ($stmt = $con->prepare('SELECT ID, password FROM Users WHERE Login = ?')) {

	// Bind the 'Login' POST data to the SQL query.
	$stmt->bind_param('s', $_POST['Login']);
	// Execute the SQL query.
	$stmt->execute();
	// Store the result of the query.
	$stmt->store_result();

	// Check if the username is already in use.
	if ($stmt->num_rows > 0) {
		// If the username is in use, output an error message.
		echo 'Login exists, please choose another!';
	} else {
		// If the username is not in use, prepare an SQL query to insert the new account data.
		if ($stmt = $con->prepare('INSERT INTO Users(FirstName, LastName, Login, Password) VALUES(?,?,?,?)')) {

			// Bind the 'FirstName', 'LastName', 'Login', and 'Password' POST data to the SQL query.
			$stmt->bind_param('ssss', $_POST['FirstName'], $_POST['LastName'], $_POST['Login'], $_POST['Password']);
			// Execute the SQL query.
			$stmt->execute();

			// Output a success message and redirect to the login page.
			echo 'You have successfully registered, you can now login!';
		} else {
			// If there's an error preparing the SQL query, output an error message.
			echo 'Could not prepare statement!';
		}
	}
	// Close the statement to free up resources.
	$stmt->close();
} else {
	// If there's an error preparing the SQL query, output an error message.
	echo 'Could not prepare statement!';
}

// Close the database connection to free up resources.
$con->close();

?>
