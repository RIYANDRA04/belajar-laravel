<?php

// Direct PDO diagnostic test — bypasses Laravel entirely
if (isset($_GET['test_db'])) {
    header("Content-Type: text/plain");
    
    $host = getenv('DB_HOST') ?: ($_ENV['DB_HOST'] ?? '');
    $port = getenv('DB_PORT') ?: ($_ENV['DB_PORT'] ?? '5432');
    $db   = getenv('DB_DATABASE') ?: ($_ENV['DB_DATABASE'] ?? '');
    $user = getenv('DB_USERNAME') ?: ($_ENV['DB_USERNAME'] ?? '');
    $pass = getenv('DB_PASSWORD') ?: ($_ENV['DB_PASSWORD'] ?? '');
    
    $endpoint = explode('.', $host)[0];
    
    echo "=== ENV VALUES ===\n";
    echo "DB_HOST: $host\n";
    echo "DB_DATABASE: $db\n";
    echo "DB_USERNAME: $user\n";
    echo "Endpoint ID: $endpoint\n\n";

    // Method 1: options in DSN
    echo "=== Method 1: options in DSN ===\n";
    try {
        $dsn1 = "pgsql:host=$host;port=$port;dbname=$db;sslmode=require;options='endpoint=$endpoint'";
        echo "DSN: $dsn1\n";
        $pdo1 = new PDO($dsn1, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        echo "RESULT: SUCCESS!\n\n";
    } catch (Exception $e) {
        echo "RESULT: FAILED — " . $e->getMessage() . "\n\n";
    }

    // Method 2: endpoint in username
    echo "=== Method 2: endpoint in username ===\n";
    try {
        $dsn2 = "pgsql:host=$host;port=$port;dbname=$db;sslmode=require";
        $userWithEndpoint = $user . '$' . $endpoint;
        echo "DSN: $dsn2\n";
        echo "Username: $userWithEndpoint\n";
        $pdo2 = new PDO($dsn2, $userWithEndpoint, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        echo "RESULT: SUCCESS!\n\n";
    } catch (Exception $e) {
        echo "RESULT: FAILED — " . $e->getMessage() . "\n\n";
    }

    exit;
}

try {
    require __DIR__ . '/../public/index.php';
} catch (\Throwable $e) {
    header("HTTP/1.1 500 Internal Server Error");
    echo "<h1>Laravel Bootstrap Error:</h1>";
    echo "<p><strong>Message:</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
    echo "<p><strong>File:</strong> " . htmlspecialchars($e->getFile()) . " on line " . $e->getLine() . "</p>";
    echo "<h2>Stack Trace:</h2>";
    echo "<pre>" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
}
