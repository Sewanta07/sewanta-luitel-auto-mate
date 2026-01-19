<?php
try {
    $pdo = new PDO('mysql:host=127.0.0.1;port=3307;dbname=automate_db', 'root', '');
    echo "Connected successfully to Port 3307";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
