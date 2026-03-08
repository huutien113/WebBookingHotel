<?php
require_once 'auth.php';
require_once '../includes/config.php';

$stmt_apt = $conn->query("SELECT COUNT(*) FROM apartments");
$total_apt = $stmt_apt->fetchColumn();

$stmt_contact = $conn->query("SELECT COUNT(*) FROM contacts");
$total_contact = $stmt_contact->fetchColumn();

$stmt = $conn->query("SELECT * FROM apartments ORDER BY id DESC");
$apartments = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý Chung cư - Admin</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f7f6; padding: 20px; }
        .admin-container { max-width: 1000px; margin: 0 auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        h2 { color: #003366; text-align: center; margin-bottom: 25px; font-size: 28px; }
        .dashboard-cards { display: flex; gap: 20px; margin-bottom: 30px; }
        .card-stat { flex: 1; background: #fff; padding: 20px; border-radius: 8px; border-left: 5px solid #003366; box-shadow: 0 2px 8px rgba(0,0,0,0.05); }
        .card-stat h3 { margin: 0 0 10px 0; color: #666; font-size: 16px; text-transform: uppercase; }
        .card-stat p { margin: 0; font-size: 32px; font-weight: bold; color: #003366; }
        .header-actions { display: flex; justify-content: space-between; margin-bottom: 20px; border-top: 1px solid #eee; padding-top: 20px; }
        .btn { text-decoration: none; padding: 10px 15px; border-radius: 4px; color: white; font-weight: bold; border: none; cursor: pointer; display: inline-block; }
        .btn-add { background: #28a745; }
        .btn-edit { background: #ffc107; color: #333; }
        .btn-delete { background: #dc3545; }
        .btn-home { background: #003366; }
        .btn-contact { background: #17a2b8; margin-left: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { padding: 12px; border: 1px solid #ddd; text-align: left; vertical-align: middle; }
        th { background-color: #003366; color: white; }
        img.thumb { width: 80px; height: 60px; object-fit: cover; border-radius: 4px; }
    </style>
</head>
<body>
    <div class="admin-container">
        <h2>Bảng Quản Trị Hệ Thống</h2>
        
        <div class="dashboard-cards">
            <div class="card-stat">
                <h3>Tổng Số Dự Án</h3>
                <p><?php echo $total_apt; ?></p>
            </div>
            <div class="card-stat" style="border-left-color: #17a2b8;">
                <h3>Khách Hàng Liên Hệ</h3>
                <p><?php echo $total_contact; ?></p>
            </div>
        </div>

        <div class="header-actions">
            <div>
                <a href="../index.php" class="btn btn-home">Về Trang Chủ</a>
                <a href="contacts.php" class="btn btn-contact">Xem Liên Hệ</a>
            </div>
            <div>
                <a href="add.php" class="btn btn-add">+ Thêm Dự Án</a>
                <a href="logout.php" class="btn btn-delete" style="margin-left: 10px;">Đăng Xuất</a>
            </div>
        </div>
        
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Hình ảnh</th>
                    <th>Tên dự án</th>
                    <th>Giá</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($apartments as $apt): ?>
                    <tr id="row-<?php echo $apt['id']; ?>">
                        <td><?php echo $apt['id']; ?></td>
                        <td><img src="../assets/images/<?php echo htmlspecialchars($apt['image_url']); ?>" class="thumb"></td>
                        <td><?php echo htmlspecialchars($apt['title']); ?></td>
                        <td><?php echo htmlspecialchars($apt['price']); ?></td>
                        <td><?php echo htmlspecialchars($apt['status']); ?></td>
                        <td>
                            <a href="edit.php?id=<?php echo $apt['id']; ?>" class="btn btn-edit">Sửa</a>
                            <button onclick="deleteApartment(<?php echo $apt['id']; ?>)" class="btn btn-delete">Xóa</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script>
        function deleteApartment(id) {
            if(confirm('Bạn có chắc chắn muốn xóa dự án này?')) {
                fetch('delete.php?id=' + id, { method: 'GET' })
                .then(response => response.text())
                .then(data => {
                    if(data.trim() === 'success') {
                        let row = document.getElementById('row-' + id);
                        row.parentNode.removeChild(row);
                    } else {
                        alert('Lỗi khi xóa: ' + data);
                    }
                })
                .catch(error => console.error('Error:', error));
            }
        }
    </script>
</body>
</html>