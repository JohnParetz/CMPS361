<!DOCTYPE html>
<html>
<head>
    <title>PHP Form</title>
</head>
<body>

<h2>Enter Your Information</h2>

<!-- Entering name and age -->
<form method="post">
    <label>Name:</label>
    <input type="text" name="name" required>

    <br><br>

    <label>Age:</label>
    <input type="number" name="age" required>

    <br><br>

    <input type="submit" value="Submit">
</form>

<?php
// Check for form submision
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get values
    $name = $_POST["name"];
    $age = $_POST["age"];

    // Display
    echo "<p>Hello, $name! You are $age years old.</p>";
}
?>

</body>
</html>