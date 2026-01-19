<?php
$configs = [
    ['host' => '127.0.0.1', 'user' => 'root', 'pass' => ''],
    ['host' => '127.0.0.1', 'user' => 'root', 'pass' => 'root'],
    ['host' => 'localhost', 'user' => 'root', 'pass' => ''], 
];

foreach ($configs as $conf) {
    echo "Trying host={$conf['host']} user={$conf['user']} pass='{$conf['pass']}'... ";
    try {
        // Omitting dbname to test AUTH only
        $dsn = "mysql:host={$conf['host']};port=3306";
        $pdo = new PDO($dsn, $conf['user'], $conf['pass']);
        echo "SUCCESS (Auth only)\n";

        // Now try selecting db
        try {
            $pdo->exec("USE automate_db");
            echo "SUCCESS (Database selected)\n";
        } catch (PDOException $e) {
            echo "FAILED to select DB: " . $e->getMessage() . "\n";
        }
        exit(0);
    } catch (PDOException $e) {
        echo "FAILED: " . $e->getMessage() . "\n";
    }
}
