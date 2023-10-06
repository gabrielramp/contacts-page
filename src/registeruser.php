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

<form hx-post="localhost:" hx-trigger="submit" hx-target="#results" hx-indicator="#loading">
    First Name: <input type="text" name="firstName"><br><br>
    Last Name: <input type="text" name="lastName"><br><br>
    User Name: <input type="text" name="userName"><br><br>
    Password: <input type="text" name="password"><br><br>
    <input type="submit" value="Search">
</form>

<h3>Results:</h3>
<pre id="results"></pre>

<!-- Optional: Loading indicator -->
<div id="loading" style="display:none;">Loading...</div>

</body>
</html>

<?php

?>