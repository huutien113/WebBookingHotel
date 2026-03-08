<?php
$db_host = 'localhost';
$db_name = 'chungcu_db';
$db_user = 'root';
$db_pass = '';

try {
    $conn = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Loi ket noi: " . $e->getMessage());
}
?>