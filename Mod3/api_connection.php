<?php

// URL for the locally running API
$apiUrl = "http://localhost:3000/api/courses";

// Request data from the API
$response = file_get_contents($apiUrl);

// Convert JSON response into a PHP array
$courses = json_decode($response, true);

?>

<!DOCTYPE html>
<html>
<head>
    <title>CMPS361 Module 3 API Connection</title>
</head>

<body>

<h1>CMPS262 Course API Connection</h1>

<?php
// Display course data returned by the API
if ($courses) {

    foreach ($courses as $course) {
        echo "<h3>" . htmlspecialchars($course["course"]) . "</h3>";
        echo "<p>Course ID: " . htmlspecialchars($course["id"]) . "</p>";
        echo "<p>Title: " . htmlspecialchars($course["title"]) . "</p>";
        echo "<p>Credits: " . htmlspecialchars($course["credits"]) . "</p>";
    }

} else {
    echo "<p>Unable to retrieve API data.</p>";
}
?>

</body>
</html>