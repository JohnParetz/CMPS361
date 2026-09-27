<?php
// PostgreSQL connection settings
$host = "localhost";
$port = "5432";
$dbname = "cmps361_test";
$user = "postgres";
$password = "YOUR_POSTGRES_PASSWORD";

try {
    // Connect to the PostgreSQL database using PDO
    $conn = new PDO(
        "pgsql:host=$host;port=$port;dbname=$dbname",
        $user,
        $password
    );

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "<h1>PostgreSQL Connection Successful!</h1>";
    echo "<p>PHP successfully connected to the cmps361_test database.</p>";

} catch (PDOException $e) {
    echo "<h1>Connection Failed</h1>";
    echo "<p>" . $e->getMessage() . "</p>";
}
?>