<?php
$DATABASE_HOST = '138.197.100.219:3306';
$DATABASE_USER = 'copuser';
$DATABASE_PASS = 'sqlpeople';
$DATABASE_NAME = 'COP4331';

// Connect to DB
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

if (mysqli_connect_errno()) {
	// Error with connection
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

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
// Check whether password and confPassword are the same or not
//if ($_POST['password'] !== $_POST['confPassword']) {
	// passwords aren't the same
	//exit("Passwords don't match");
//}

// Check if password is too short or long
if (strlen($_POST['Password']) > 20 || strlen($_POST['Password']) < 5) {
	// password is too short or too long
	exit('Password must be between 5 and 20 characters long!');
}

// Check if username is used
if ($stmt = $con->prepare('SELECT ID, password FROM Users WHERE Login = ?')) {

	$stmt->bind_param('s', $_POST['Login']);
	$stmt->execute();
	$stmt->store_result();


	if ($stmt->num_rows > 0) {
		// Login already in use
		echo 'Login exists, please choose another!';
	} else {
        // email not in use, insert new account
        if ($stmt = $con->prepare('INSERT INTO Users(FirstName, LastName, Login, Password) VALUES(?,?,?,?)')) {

			// Protect password
        	$stmt->bind_param('ssss', $_POST['FirstName'], $_POST['LastName'], $_POST['Login'], $_POST['Password']);
        	$stmt->execute();

			// Account created, redirect to login page
			echo 'You have successfully registered, you can now login!';
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