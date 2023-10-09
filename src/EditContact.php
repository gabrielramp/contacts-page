// Check if the form has been submitted
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Get the contact ID from the POST request
    $cid = $_POST['cid'];

    // Get the contact data from the POST request
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    include 'DBConnector.php';
    $conn = (new DatabaseConnector())->getConnection();

    // Prepare the SQL statement to update the contact
    $stmt = $conn->prepare('UPDATE Contacts SET firstname = :firstname, lastname = :lastname, email = :email, phone = :phone WHERE id = :cid');

    // Bind the parameters to the SQL statement
    $stmt->bindParam(':firstname', $firstname, PDO::PARAM_STR);
    $stmt->bindParam(':lastname', $lastname, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
    $stmt->bindParam(':id', $cid, PDO::PARAM_INT);

    // Execute the SQL statement
    $stmt->execute();

     echo "Contact updated successfully!";

    // Redirect the user back to the contacts page
    header('Location: /contacts.php');

    $stmt->close();
    $conn->close();

    exit;
}
?>