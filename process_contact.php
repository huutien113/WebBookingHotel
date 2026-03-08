<?php
require_once 'includes/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullname = $_POST['fullname'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $email = $_POST['email'] ?? '';
    $message = $_POST['message'] ?? '';

    if (!empty($fullname) && !empty($phone) && !empty($email) && !empty($message)) {
        $stmt = $conn->prepare("INSERT INTO contacts (fullname, phone, email, message) VALUES (?, ?, ?, ?)");
        if ($stmt->execute([$fullname, $phone, $email, $message])) {
            echo 'success';
        } else {
            echo 'error';
        }
    } else {
        echo 'empty';
    }
}
?>