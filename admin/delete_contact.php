<?php
require_once 'auth.php';
require_once '../includes/config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $del_stmt = $conn->prepare("DELETE FROM contacts WHERE id = ?");
    if ($del_stmt->execute([$id])) {
        echo 'success';
    } else {
        echo 'error';
    }
}
?>