<?php
require_once 'auth.php';
require_once '../includes/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $area = $_POST['area'];
    $price = $_POST['price'];
    $location = $_POST['location'];
    $status = $_POST['status'];

    $image_url = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $file_name = time() . '_' . basename($_FILES["image"]["name"]);
        $target_file = "../assets/images/" . $file_name;

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $image_url = $file_name;
        }
    }

    $stmt = $conn->prepare("INSERT INTO apartments (title, description, area, price, location, status, image_url) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$title, $description, $area, $price, $location, $status, $image_url]);

    header("Location: ../index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm Dự Án Mới</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body class="admin-page admin-form admin-form-add">
    <div class="form-container">
        <h2>Thêm Căn Hộ / Dự Án Mới</h2>
        <form action="add.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label>Tên dự án / Căn hộ:</label>
                <input type="text" name="title" required>
            </div>
            <div class="form-group">
                <label>Mô tả chi tiết:</label>
                <textarea name="description" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <label>Diện tích (vd: 65m2):</label>
                <input type="text" name="area" required>
            </div>
            <div class="form-group">
                <label>Giá bán (vd: 2.5 Tỷ):</label>
                <input type="text" name="price" required>
            </div>
            <div class="form-group">
                <label>Vị trí (vd: Ninh Kiều, Cần Thơ):</label>
                <input type="text" name="location" required>
            </div>
            <div class="form-group">
                <label>Trạng thái:</label>
                <select name="status" required>
                    <option value="Đang mở bán">Đang mở bán</option>
                    <option value="Sắp bàn giao">Sắp bàn giao</option>
                    <option value="Đã bàn giao">Đã bàn giao</option>
                </select>
            </div>
            <div class="form-group">
                <label>Hình ảnh (Upload file từ máy):</label>
                <input type="file" name="image" accept="image/*" required>
            </div>
            <button type="submit" class="form-submit">Lưu Dự Án</button>
        </form>
        <a href="../index.php" class="back-link">Quay lại Trang chủ</a>
    </div>
</body>
</html>
