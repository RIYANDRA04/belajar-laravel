<?php
try {
    if (isset($_GET['debug_env'])) {
        header("Content-Type: text/plain");
        echo "DB_CONNECTION: " . getenv('DB_CONNECTION') . "\n";
        echo "DB_HOST: " . getenv('DB_HOST') . "\n";
        echo "DB_PORT: " . getenv('DB_PORT') . "\n";
        echo "DB_DATABASE: " . getenv('DB_DATABASE') . "\n";
        echo "DB_USERNAME: " . getenv('DB_USERNAME') . "\n";
        echo "DB_SSLMODE: " . getenv('DB_SSLMODE') . "\n";
        exit;
    }
    require __DIR__ . '/../public/index.php';
} catch (\Throwable $e) {
    header("HTTP/1.1 500 Internal Server Error");
    echo "<h1>Laravel Bootstrap Error:</h1>";
    echo "<p><strong>Message:</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
    echo "<p><strong>File:</strong> " . htmlspecialchars($e->getFile()) . " on line " . $e->getLine() . "</p>";
    echo "<h2>Stack Trace:</h2>";
    echo "<pre>" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
}
