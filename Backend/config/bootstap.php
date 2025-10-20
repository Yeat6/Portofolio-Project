<?php

require_once __DIR__ . '/db.php';

try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbnmame=" . DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("ERROR: Couldnt connect to database." . $e->getMessage());
}