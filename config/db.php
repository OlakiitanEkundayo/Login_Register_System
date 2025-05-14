<?php

try {
    $pdo = new PDO("mysql:host=localhost;dbname=login_system", 'root', '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    die("Connection was not successful..." . $e->getMessage());
}
