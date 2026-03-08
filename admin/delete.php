<?php
require_once 'auth.php';
require_once '../includes/config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("SELECT image_url FROM apartments WHERE id = ?");
    $stmt->execute([$id]);
    $apt = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($apt) {
        $image_path = "../assets/images/" . $apt['image_url'];
        if (file_exists($image_path) && !empty($apt['image_url'])) {
            unlink($image_path);
        }

        $del_stmt = $conn->prepare("DELETE FROM apartments WHERE id = ?");
        if ($del_stmt->execute([$id])) {
            echo 'success';
        } else {
            echo 'error';
        }
    }
}
?>