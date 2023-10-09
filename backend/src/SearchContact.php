<?php

session_start();

$inData = getRequestInfo();
$sessionData = getSessionInfo();

$keyword = $inData["keyword"];
$id = 17;
//$id = $sessionData["id"];

$searchResults = "";
$searchCount = 0;

include 'DBConnector.php';
$conn = (new DatabaseConnector())->getConnection();



if (!$conn) {
    returnWithError("Connection error.");
} else {

    if ($keyword == "" or $keyword == null) {
        // Search for all records with the specified user ID
        $stmt = $conn->prepare("SELECT id, firstname, lastname, email, phone FROM Contacts WHERE userid = :id");
        $stmt->bindParam(':id', $id);
    } else {
        // Search for records matching the keyword and user ID
        $stmt = $conn->prepare("SELECT id, firstname, lastname, email, phone FROM Contacts WHERE userid = :id AND (firstname LIKE :keyword OR lastname LIKE :keyword OR email LIKE :keyword OR phone LIKE :keyword)");
        $searchKeyword = "%" . $keyword . "%";
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':keyword', $searchKeyword);
    }

    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $stmt->closeCursor();

    $searchCount = count($results);

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