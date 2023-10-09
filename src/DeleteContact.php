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
		// Assuming you have a table named "Contacts" with a primary key column "id" to identify contacts.
		$stmt = $conn->prepare("DELETE FROM Contacts WHERE userid, firstname, lastname, email, phone = (?,?,?,?,?)");
		$stmt->bind_param("sssss", $userid, $firstname, $lastname, $email, $phone);
		$stmt->execute();
		$stmt->close();
		$conn->close();
		echo "Contact deleted successfully";
		// TODO: Add something to return to the front end to signify a successful contact delete.
	}

	function getRequestInfo()
	{
		return $_GET; // Change from $_POST to $_GET to receive data from the URL query parameters.
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