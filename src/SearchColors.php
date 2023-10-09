?php

$inData = getRequestInfo();

$searchResults = "";
$searchCount = 0;

include 'DBConnector.php';

$conn = (new DatabaseConnector())->getConnection();

if (!$conn) {
    returnWithError("Connection error.");
} else {
    $stmt = $conn->prepare("SELECT Name FROM Colors WHERE Name LIKE :colorName AND UserID = :userId");

    $colorName = "%" . $inData["search"] . "%";
    $stmt->bindParam(':colorName', $colorName);
    $stmt->bindParam(':userId', $inData["userId"]);

    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($results as $row) {
        if ($searchCount > 0) {
            $searchResults .= ",";
        }
        $searchCount++;
        $searchResults .= '"' . $row["Name"] . '"';
    }

    if ($searchCount == 0) {
        returnWithError("No Records Found");
    } else {
        returnWithInfo($searchResults);
    }
}

function getRequestInfo() {
    return $_POST;
}

function sendResultInfoAsJson($obj) {
    header('Content-type: application/json');
    echo $obj;
}

function returnWithError($err) {
    $retValue = '{"id":0,"firstName":"","lastName":"","error":"' . $err . '"}';
    sendResultInfoAsJson($retValue);
}

function returnWithInfo($searchResults) {
    $retValue = '{"results":[' . $searchResults . '],"error":""}';
    sendResultInfoAsJson($retValue);
}

?>
