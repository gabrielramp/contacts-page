<?php
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'phplogin';

// Connect to DB
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

if (mysqli_connect_errno()) {
	// Error with connection
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

// Check if the data exists.
if (!isset($_POST['FName'], $_POST['LName'], $_POST['password'], $_POST['email'])) {
	// Data doesn't exist
	exit('Please complete the registration form!');
}
// Check if any field are empty
if (empty($_POST['FName']) || empty($_POST['LName']) || empty($_POST['password']) || empty($_POST['email'])) {
	// there is an empty field
	exit('Please complete the registration form');
}
// Check whether password and confPassword are the same or not
if ($_POST['password'] !== $_POST['confPassword']) {
	// passwords aren't the same
	exit("Passwords don't match");
}
// Check if email is valid
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
	// email isn't valid
	exit('Email is not valid!');
}

// Check if password is too short or long
if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
	// password is too short or too long
	exit('Password must be between 5 and 20 characters long!');
}

// Check if email is used
if ($stmt = $con->prepare('SELECT id, password FROM user WHERE email = ?')) {

	$stmt->bind_param('s', $_POST['email']);
	$stmt->execute();
	$stmt->store_result();


	if ($stmt->num_rows > 0) {
		// email already in use
		echo 'email exists, please choose another!';
	} else {
        // email not in use, insert new account
        if ($stmt = $con->prepare('INSERT INTO user(first_name, last_name, email, password) VALUES (?, ?, ?, ?)')) {
			// Protect password
			$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        	$stmt->bind_param('ssss', $_POST['FName'], $_POST['LName'], $_POST['email'], $password);
        	$stmt->execute();
			// Account created, redirect to login page
        	header("Location: login.html");
        } else {
        	// Error with SQL Query
        	echo 'Could not prepare statement!';
        }
	}
	$stmt->close();
} else {
	// Error with SQL Query
	echo 'Could not prepare statement!';
}
$con->close();
?>