<?php

$dsn = 'mysql:host=localhost;dbname=assignment_tracker';
$username = 'root';

try {
    $db = new PDO($dsn, $username);
} catch (PDOException $e) {
    $error = "Database Error: " . $e->getMessage();

    include_once 'view/error.php';
    exit();
}
