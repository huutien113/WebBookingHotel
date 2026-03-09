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
    
    <div class="search-box">
        <form action="index.php" method="GET" class="search-form">
            <input type="text" name="keyword" value="<?php echo htmlspecialchars($keyword); ?>" placeholder="Tìm tên dự án hoặc vị trí (vd: Ninh Kiều, Bình Thủy)..." class="search-input">
            <button type="submit" class="search-button">Tìm Kiếm</button>
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
                        <p class="card-info card-location">📍 <?php echo htmlspecialchars($apt['location']); ?></p>
                        <p class="card-info">📐 Diện tích: <?php echo htmlspecialchars($apt['area']); ?></p>
                        <p class="price">💰 Giá: <?php echo htmlspecialchars($apt['price']); ?></p>
                        <a href="detail.php?id=<?php echo $apt['id']; ?>" class="detail-link">Xem Chi Tiết</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="empty-message">Không tìm thấy dự án nào phù hợp.</p>
        <?php endif; ?>
    </div>

    <?php if($total_pages > 1): ?>
        <div class="pagination">
            <?php for($i = 1; $i <= $total_pages; $i++): ?>
                <a href="index.php?page=<?php echo $i; ?><?php echo !empty($keyword) ? '&keyword='.urlencode($keyword) : ''; ?>" 
                   class="page-link <?php echo ($page == $i) ? 'active' : ''; ?>">
                    <?php echo $i; ?>
                </a>
            <?php endfor; ?>
        </div>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>
