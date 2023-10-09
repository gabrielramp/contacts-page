<?php
	$inData = getRequestInfo();
	$sessionData = getSessionInfo();
	
	$userid = $sessionData["id"];
	$firstname = $inData["firstname"];
	$lastname = $inData["lastname"];
	$email = $inData["email"];
	$phone = $inData["phone"];

	// Include the DBConnector.php file to use the DatabaseConnector class.
	include 'DBConnector.php';

	// Use an alias 'db' for the DatabaseConnector class to shorten the syntax.
	use DatabaseConnector as db;

	// Create a new instance of the DatabaseConnector class, stored in the variable $conn.
	$conn = new db();

	if ($conn->connect_error) 
	{
		returnWithError( $conn->connect_error );
	}
	else
	{
		$stmt = $conn->prepare("INSERT into Contacts (userid, firstname, lastname, email, phone) VALUES(?,?,?,?,?)");
		$stmt->bind_param("sssss", $userid, $firstname, $lastname, $email, $phone);
		$stmt->execute();

		$stmt->close();
		$conn->close();
		
		// Redirect to Search.html
		header("Location: Search.html");
		exit();  // Ensure no further code is executed
	}

	function getRequestInfo()
	{
		return $_POST;
	}

	function getSessionInfo()
	{
		return $_SESSION;
	}

	function sendResultInfoAsJson( $obj )
	{
		header('Content-type: application/json');
		echo $obj;
	}
	
	function returnWithError( $err )
	{
		$retValue = '{"error":"' . $err . '"}';
		sendResultInfoAsJson( $retValue );
	}
	
	function retunWithInfo( $info )
	{
		$retValue = '{"info":"' . $info . '"}';
		sendResultInfoAsJson( $retValue );
	}
?>
