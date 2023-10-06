<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test SearchColors API</title>
    <script src="https://unpkg.com/htmx.org@1.9.6" integrity="sha384-FhXw7b6AlE/jyjlZH5iHa/tTe9EpJ1Y55RjcgPbjeWMskSxZt1v9qkxLJWNJaGni" crossorigin="anonymous"></script>
</head>
<body>

<h2>Search Colors</h2>

<div id="registrationResponse"></div>

<form hx-post="http://localhost/src/registeruser.php" hx-target="#registrationResponse">
    <div>
        <label for="Login">Username:</label>
        <input type="text" name="Login" required>
    </div>
    <div>
        <label for="Password">Password:</label>
        <input type="text" name="Password" required>
    </div>
    <div>
        <label for="FirstName">First Name:</label>
        <input type="text" name="FirstName" required>
    </div>
    <div>
        <label for="LastName">Last Name:</label>
        <input type="text" name="LastName" required>
    </div>
    <div>
        <button type="submit">Register</button>
    </div>
</form>

<h3>Results:</h3>
<pre id="results"></pre>

<!-- Optional: Loading indicator -->
<div id="loading" style="display:none;">Loading...</div>

</body>
</html>

<?php

?>