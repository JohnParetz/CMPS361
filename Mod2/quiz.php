<!DOCTYPE html>
<html>
<head>
    <title>Even or Odd</title>
</head>
<body>

<h2>Even or Odd?</h2>

<!-- Enter a number -->
<form method="post">
    <label>Enter a number:</label>
    <input type="number" name="number" required>

    <input type="submit" value="Check">
</form>

<?php
// Check for form submision
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $number = $_POST["number"];

    //  Find if number is even or odd
    if ($number % 2 == 0) {
        echo "<p>$number is even.</p>";
    } else {
        echo "<p>$number is odd.</p>";
    }
}
?>

</body>
</html>