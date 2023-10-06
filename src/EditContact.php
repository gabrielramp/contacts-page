// Check if the form has been submitted
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the contact ID from the POST request
    $contact_id = $_POST['contact_id'];

    // Get the contact data from the POST request
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    include 'DBConnector.php';
    $conn = (new DatabaseConnector())->getConnection();

    // Prepare the SQL statement to update the contact
    $stmt = $conn->prepare('UPDATE contacts SET firstname = :first_name, lastname = :last_name, email = :email, phone = :phone WHERE userid = :contact_id');

    // Bind the parameters to the SQL statement
    $stmt->bindParam(':first_name', $first_name);
    $stmt->bindParam(':last_name', $last_name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':id', $contact_id);

    // Execute the SQL statement
    $stmt->execute();

    // Redirect the user back to the contacts page
    header('Location: /contacts.php');

    $stmt->close();
    $conn->close();

    exit;
}
?>