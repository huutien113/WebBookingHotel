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
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body class="admin-page admin-dashboard">
    <div class="admin-container">
        <h2>Bảng Quản Trị Hệ Thống</h2>
        
        <div class="dashboard-cards">
            <div class="card-stat">
                <h3>Tổng Số Dự Án</h3>
                <p><?php echo $total_apt; ?></p>
            </div>
            <div class="card-stat card-stat-contact">
                <h3>Số Khách Hàng Đã Liên Hệ</h3>
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
                <a href="logout.php" class="btn btn-delete logout-btn">Đăng Xuất</a>
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
