<?php
require_once 'includes/config.php';
include 'includes/header.php';

$keyword = $_GET['keyword'] ?? '';
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 6; 
$offset = ($page - 1) * $limit;

if (!empty($keyword)) {
    $stmt_total = $conn->prepare("SELECT COUNT(*) FROM apartments WHERE title LIKE ? OR location LIKE ?");
    $stmt_total->execute(["%$keyword%", "%$keyword%"]);
    $total_records = $stmt_total->fetchColumn();

    $stmt = $conn->prepare("SELECT * FROM apartments WHERE title LIKE ? OR location LIKE ? ORDER BY id DESC LIMIT $limit OFFSET $offset");
    $stmt->execute(["%$keyword%", "%$keyword%"]);
} else {
    $stmt_total = $conn->query("SELECT COUNT(*) FROM apartments");
    $total_records = $stmt_total->fetchColumn();

    $stmt = $conn->query("SELECT * FROM apartments ORDER BY id DESC LIMIT $limit OFFSET $offset");
}

$total_pages = ceil($total_records / $limit);
$apartments = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="hero">
    <h1>Khám Phá Không Gian Sống Đẳng Cấp</h1>
    <p>Tuyển tập những căn hộ chung cư vị trí đẹp nhất dành cho bạn</p>
    
    <div style="margin-top: 30px; background: rgba(255,255,255,0.2); padding: 15px; border-radius: 8px;">
        <form action="index.php" method="GET" style="display: flex; gap: 10px;">
            <input type="text" name="keyword" value="<?php echo htmlspecialchars($keyword); ?>" placeholder="Tìm tên dự án hoặc vị trí (vd: Ninh Kiều, Bình Thủy)..." style="padding: 12px; width: 400px; border: none; border-radius: 4px; font-size: 16px;">
            <button type="submit" style="padding: 12px 25px; background: #ffcc00; color: #003366; border: none; border-radius: 4px; font-weight: bold; cursor: pointer; font-size: 16px;">Tìm Kiếm</button>
        </form>
    </div>
</div>

<div class="container" id="du-an">
    <h2 class="section-title">
        <?php echo !empty($keyword) ? 'Kết quả tìm kiếm cho: "' . htmlspecialchars($keyword) . '"' : 'Dự án Nổi bật'; ?>
    </h2>
    
    <div class="apartment-grid">
        <?php if(count($apartments) > 0): ?>
            <?php foreach($apartments as $apt): ?>
                <div class="card">
                    <img src="assets/images/<?php echo htmlspecialchars($apt['image_url']); ?>" alt="Hinh anh">
                    <div class="card-body">
                        <span class="badge-status"><?php echo htmlspecialchars($apt['status']); ?></span>
                        <h3 class="card-title"><?php echo htmlspecialchars($apt['title']); ?></h3>
                        <p class="card-info" style="font-weight: bold; color: #003366;">📍 <?php echo htmlspecialchars($apt['location']); ?></p>
                        <p class="card-info">📐 Diện tích: <?php echo htmlspecialchars($apt['area']); ?></p>
                        <p class="price">💰 Giá: <?php echo htmlspecialchars($apt['price']); ?></p>
                        <a href="detail.php?id=<?php echo $apt['id']; ?>" style="display: block; text-align: center; background: #003366; color: white; padding: 10px; margin-top: 15px; text-decoration: none; border-radius: 4px; font-weight: bold; transition: 0.3s;">Xem Chi Tiết</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p style="text-align:center; width: 100%; color: #888; font-size: 18px;">Không tìm thấy dự án nào phù hợp.</p>
        <?php endif; ?>
    </div>

    <?php if($total_pages > 1): ?>
        <div style="display: flex; justify-content: center; gap: 10px; margin-top: 40px;">
            <?php for($i = 1; $i <= $total_pages; $i++): ?>
                <a href="index.php?page=<?php echo $i; ?><?php echo !empty($keyword) ? '&keyword='.urlencode($keyword) : ''; ?>" 
                   style="padding: 8px 15px; border-radius: 4px; text-decoration: none; font-weight: bold; 
                          background: <?php echo ($page == $i) ? '#003366' : '#fff'; ?>; 
                          color: <?php echo ($page == $i) ? '#fff' : '#003366'; ?>; 
                          border: 1px solid #003366;">
                    <?php echo $i; ?>
                </a>
            <?php endfor; ?>
        </div>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>