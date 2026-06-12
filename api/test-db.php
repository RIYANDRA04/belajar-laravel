<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "<h3>PHP Diagnostics:</h3>";
echo "PDO drivers available: " . implode(', ', PDO::getAvailableDrivers()) . "<br>";

$host = getenv('DB_HOST');
$port = getenv('DB_PORT') ?: '5432';
$dbname = getenv('DB_DATABASE');
$user = getenv('DB_USERNAME');
$pass = getenv('DB_PASSWORD');

echo "Attempting database connection to: $host ($dbname) as user: $user ...<br>";

try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;sslmode=require";
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
    echo "<h4 style='color:green;'>Connection successful!</h4>";
} catch (Exception $e) {
    echo "<h4 style='color:red;'>Connection failed:</h4>";
    echo "<pre>" . $e->getMessage() . "</pre>";
}
