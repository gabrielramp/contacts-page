<?php

session_start();
// Debug session

$inData = getRequestInfo();
$sessionData = getSessionInfo();

$keyword = $inData["keyword"];
$id = 17;
//$id = $sessionData["id"];

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
    $searchKeyword = "%" . $keyword . "%";

    // Bind parameters
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':keyword', $searchKeyword);

    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $stmt->closeCursor(); // Close the cursor

    $searchCount = count($results); // Count the search results

    if ($searchCount == 0) {
        returnWithError("No Records Found");
    } else {
        returnWithInfo($results);
    }
}

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