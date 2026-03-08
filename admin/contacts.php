<?php
require_once 'auth.php';
require_once '../includes/config.php';

$stmt = $conn->query("SELECT * FROM contacts ORDER BY created_at DESC");
$contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách Liên hệ</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f7f6; padding: 20px; }
        .admin-container { max-width: 1000px; margin: 0 auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        h2 { color: #003366; text-align: center; margin-bottom: 20px; }
        .header-actions { display: flex; justify-content: space-between; margin-bottom: 20px; }
        .btn { text-decoration: none; padding: 10px 15px; border-radius: 4px; color: white; font-weight: bold; border: none; cursor: pointer; }
        .btn-back { background: #6c757d; }
        .btn-delete { background: #dc3545; padding: 6px 10px; font-size: 14px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px; border: 1px solid #ddd; text-align: left; }
        th { background-color: #003366; color: white; }
    </style>
</head>
<body>
    <div class="admin-container">
        <h2>Khách Hàng Liên Hệ</h2>
        <div class="header-actions">
            <a href="index.php" class="btn btn-back">Quay lại Bảng quản trị</a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Họ Tên</th>
                    <th>Điện thoại</th>
                    <th>Email</th>
                    <th>Lời nhắn</th>
                    <th>Ngày gửi</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($contacts as $c): ?>
                    <tr id="row-<?php echo $c['id']; ?>">
                        <td><?php echo $c['id']; ?></td>
                        <td><?php echo htmlspecialchars($c['fullname']); ?></td>
                        <td><?php echo htmlspecialchars($c['phone']); ?></td>
                        <td><?php echo htmlspecialchars($c['email']); ?></td>
                        <td><?php echo nl2br(htmlspecialchars($c['message'])); ?></td>
                        <td><?php echo htmlspecialchars($c['created_at']); ?></td>
                        <td>
                            <button onclick="deleteContact(<?php echo $c['id']; ?>)" class="btn btn-delete">Xóa</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script>
        function deleteContact(id) {
            if(confirm('Bạn có chắc chắn muốn xóa tin nhắn này?')) {
                fetch('delete_contact.php?id=' + id, { method: 'GET' })
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