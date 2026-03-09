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
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body class="admin-page admin-contacts">
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
