<?php
// db.php

try {
    $pdo = new PDO('sqlite:C:/xampp/htdocs/FB-management/fb_managment_system.db');

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;
}
?>
