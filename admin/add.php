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
    <style>
        body { font-family: Arial, sans-serif; background: #f4f7f6; padding: 20px; }
        .form-container { max-width: 600px; margin: 0 auto; background: white; padding: 25px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        h2 { color: #003366; text-align: center; margin-bottom: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; font-weight: bold; margin-bottom: 5px; color: #333; }
        input[type="text"], select, textarea { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        input[type="file"] { padding: 5px 0; }
        button { background: #003366; color: white; padding: 12px 20px; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; width: 100%; font-weight: bold; transition: 0.3s; }
        button:hover { background: #ffcc00; color: #003366; }
        .back-link { display: block; text-align: center; margin-top: 15px; text-decoration: none; color: #555; }
        .back-link:hover { color: #003366; font-weight: bold; }
    </style>
</head>
<body>
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
            <button type="submit">Lưu Dự Án</button>
        </form>
        <a href="../index.php" class="back-link">Quay lại Trang chủ</a>
    </div>
</body>
</html>