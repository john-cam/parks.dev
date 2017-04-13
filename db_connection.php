<?php

require __DIR__ . '/constants.php'; // don't forget the forward slash when using __DIR__

try {
    $db = new PDO(
        'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME,
        DB_USERNAME,
        DB_PASSWORD
    );

    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    echo $e->getMessage() . PHP_EOL;
}

// echo $db->getAttribute(PDO::ATTR_CONNECTION_STATUS) . PHP_EOL;