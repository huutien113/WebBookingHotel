<?php
require_once 'auth.php';
require_once '../includes/config.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $area = $_POST['area'];
    $price = $_POST['price'];
    $location = $_POST['location'];
    $status = $_POST['status'];
    $old_image = $_POST['old_image'];

    $image_url = $old_image;

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $file_name = time() . '_' . basename($_FILES["image"]["name"]);
        $target_file = "../assets/images/" . $file_name;

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $image_url = $file_name;
            
            if (!empty($old_image) && file_exists("../assets/images/" . $old_image)) {
                unlink("../assets/images/" . $old_image);
            }
        }
    }

    $stmt = $conn->prepare("UPDATE apartments SET title=?, description=?, area=?, price=?, location=?, status=?, image_url=? WHERE id=?");
    $stmt->execute([$title, $description, $area, $price, $location, $status, $image_url, $id]);

    header("Location: index.php");
    exit;
}

$stmt = $conn->prepare("SELECT * FROM apartments WHERE id = ?");
$stmt->execute([$id]);
$apt = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$apt) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa Thông Tin Dự Án</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body class="admin-page admin-form admin-form-edit">
    <div class="form-container">
        <h2>Sửa Thông Tin Dự Án</h2>
        <form action="edit.php?id=<?php echo $apt['id']; ?>" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="old_image" value="<?php echo htmlspecialchars($apt['image_url']); ?>">
            
            <div class="form-group">
                <label>Tên dự án / Căn hộ:</label>
                <input type="text" name="title" value="<?php echo htmlspecialchars($apt['title']); ?>" required>
            </div>
            <div class="form-group">
                <label>Mô tả chi tiết:</label>
                <textarea name="description" rows="4" required><?php echo htmlspecialchars($apt['description']); ?></textarea>
            </div>
            <div class="form-group">
                <label>Diện tích:</label>
                <input type="text" name="area" value="<?php echo htmlspecialchars($apt['area']); ?>" required>
            </div>
            <div class="form-group">
                <label>Giá bán:</label>
                <input type="text" name="price" value="<?php echo htmlspecialchars($apt['price']); ?>" required>
            </div>
            <div class="form-group">
                <label>Vị trí:</label>
                <input type="text" name="location" value="<?php echo htmlspecialchars($apt['location']); ?>" required>
            </div>
            <div class="form-group">
                <label>Trạng thái:</label>
                <select name="status" required>
                    <option value="Đang mở bán" <?php if($apt['status'] == 'Đang mở bán') echo 'selected'; ?>>Đang mở bán</option>
                    <option value="Sắp bàn giao" <?php if($apt['status'] == 'Sắp bàn giao') echo 'selected'; ?>>Sắp bàn giao</option>
                    <option value="Đã bàn giao" <?php if($apt['status'] == 'Đã bàn giao') echo 'selected'; ?>>Đã bàn giao</option>
                </select>
            </div>
            <div class="form-group">
                <label>Hình ảnh mới (Để trống nếu không muốn đổi):</label>
                <input type="file" name="image" accept="image/*">
                <?php if(!empty($apt['image_url'])): ?>
                    <img src="../assets/images/<?php echo htmlspecialchars($apt['image_url']); ?>" class="current-image" alt="Current Image">
                <?php endif; ?>
            </div>
            <button type="submit" class="form-submit">Cập Nhật Dự Án</button>
        </form>
        <a href="index.php" class="back-link">Quay lại Bảng quản trị</a>
    </div>
</body>
</html>
