<?php
	$inData = getRequestInfo();
	$deleteid = $inData["contact_id"];

	// Use the userid below to check if the user performing this operation owns this contact. (Optional)
	$sessionData = getSessionInfo();
	$userid = $sessionData["id"];

	include 'DBConnector.php';
    $conn = (new DatabaseConnector())->getConnection();

	if (!$conn)
	{
		returnWithError('Connection error.');
	}
	else
	{
		// Assuming you have a table named "Contacts" with a primary key column "id" to identify contacts.
		$stmt = $conn->prepare("DELETE FROM Contacts WHERE id = :deleteid");

		// TODO: Finish this statement to delete the contact with the given ID.
		$stmt->bindParam(':deleteid', $deleteid, PDO::PARAM_INT);
		$stmt->execute();
		$stmt->close();
		$conn->close();

		echo "Contact deleted successfully";
		// TODO: Add something to return to the front end to signify a successful contact delete.
	}

	function getRequestInfo()
	{
		return $_POST; // Change from $_POST to $_GET to receive data from the URL query parameters.
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