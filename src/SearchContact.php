<?php

//session_start();
// Debug session

$inData = getRequestInfo();
$sessionData = getSessionInfo();

$keyword = $inData["keyword"];
$id = $sessionData["id"];

//$id = 0;
// Debug

//echo "Keyword: " . $keyword . "\n";
//echo "ID: " . $id . "\n";
// More debug

$searchResults = "";
$searchCount = 0;

if ($keyword == "" or $keyword == null or !is_numeric($id)) {
    returnWithError("Please enter a search term.");
    exit();
}

include 'DBConnector.php';
$conn = (new DatabaseConnector())->getConnection();

if (!$conn) {
    returnWithError("Connection error.");
} else {
    $stmt = $conn->prepare("SELECT id, firstname, lastname, email, phone FROM Contacts WHERE userid = :id AND (firstname LIKE :keyword OR lastname LIKE :keyword OR email LIKE :keyword)");

    // Bind parameters
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':keyword', $keyword);

    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    //echo json_encode($results);
    //echo "\n";
    //echo "Success!";
    //echo "\n";
    // Debug

    $stmt->closeCursor(); // Close the cursor

    $searchCount = count($results); // Count the search results

    if ($searchCount == 0) {
        returnWithError("No Records Found");
    } else {
        returnWithInfo($results);
    }
}

$conn->close();

function getRequestInfo() {
    return $_GET;
}

function getSessionInfo() {
    return $_SESSION;
}

function sendResultInfoAsJson($obj) {
    header('Content-type: application/json');
    echo $obj;
}

function returnWithError($err) {
    $retValue = '{"id":0, "firstName":"", "lastName":"", "email":"", "phone":"", "error":"' . $err . '"}';
    sendResultInfoAsJson($retValue);
}

function returnWithInfo($searchResults) {
    sendResultInfoAsJson(json_encode($searchResults));
}

?>