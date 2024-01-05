<?php
	session_start();

  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
	// Get the contact info from the POST request
	$inData = getRequestInfo();
	$sessionData = getSessionInfo();
	
	$userid = $sessionData["id"];
	$firstname = $inData["firstname"];
	$lastname = $inData["lastname"];
	$email = $inData["email"];
	$phone = $inData["phone"];

	include 'DBConnector.php';
    $conn = (new DatabaseConnector())->getConnection();

	if (!$conn)
	{
		returnWithError('Connection error.');
	}
	else
	{
		$stmt = $conn->prepare("INSERT into Contacts (userid, firstname, lastname, email, phone) VALUES(?,?,?,?,?)");
		$stmt->bindParam(1, $userid, PDO::PARAM_INT);
		$stmt->bindParam(2, $firstname, PDO::PARAM_STR);
		$stmt->bindParam(3, $lastname, PDO::PARAM_STR);
		$stmt->bindParam(4, $email, PDO::PARAM_STR);
		$stmt->bindParam(5, $phone, PDO::PARAM_STR);

		$stmt->execute();

		$stmt = null;
		$conn = null;
		
   
   echo '<script>createAlert("Contact added successfully.", "primary");</script>';
   echo '<script>redirectToSearch();</script>';
		// TODO: Add something to return to the front end to signify a successful contact add.
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