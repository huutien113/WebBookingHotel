<?php
session_start();
require_once '../includes/config.php';

if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header("Location: index.php");
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? LIMIT 1");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && $password === $user['password']) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_username'] = $user['username'];
        header("Location: index.php");
        exit;
    } else {
        $error = 'Sai tên đăng nhập hoặc mật khẩu!';
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng nhập Quản trị</title>
    <style>
        body { font-family: Arial, sans-serif; background: #003366; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .login-box { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.2); width: 100%; max-width: 400px; }
        h2 { text-align: center; color: #003366; margin-bottom: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; font-weight: bold; margin-bottom: 5px; color: #333; }
        input[type="text"], input[type="password"] { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        button { background: #ffcc00; color: #003366; padding: 12px; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; width: 100%; font-weight: bold; transition: 0.3s; }
        button:hover { background: #e6b800; }
        .error { color: #dc3545; text-align: center; margin-bottom: 15px; font-weight: bold; }
        .back-home { display: block; text-align: center; margin-top: 15px; text-decoration: none; color: #555; }
        .back-home:hover { color: #003366; }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Đăng Nhập Quản Trị</h2>
        <?php if($error): ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <form action="login.php" method="POST">
            <div class="form-group">
                <label>Tên đăng nhập:</label>
                <input type="text" name="username" required>
            </div>
            <div class="form-group">
                <label>Mật khẩu:</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit">Đăng Nhập</button>
        </form>
        <a href="../index.php" class="back-home">Quay lại Trang chủ</a>
    </div>
</body>
</html>