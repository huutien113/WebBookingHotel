<?php
require_once 'includes/config.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM apartments WHERE id = ?");
$stmt->execute([$id]);
$apt = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$apt) {
    header("Location: index.php");
    exit;
}

include 'includes/header.php';
?>

<div class="container detail-container">
    <div class="detail-content">
        
        <div class="detail-media">
            <img src="assets/images/<?php echo htmlspecialchars($apt['image_url']); ?>" class="detail-image" alt="Hình ảnh căn hộ">
        </div>
        
        <div class="detail-info">
            <span class="badge-status detail-status"><?php echo htmlspecialchars($apt['status']); ?></span>
            
            <h1 class="detail-title"><?php echo htmlspecialchars($apt['title']); ?></h1>
            
            <div class="price-box">
                <p class="price-text">💰 Giá bán: <?php echo htmlspecialchars($apt['price']); ?></p>
            </div>
            
            <p class="detail-meta">📍 <strong>Vị trí dự án:</strong> <?php echo htmlspecialchars($apt['location']); ?></p>
            <p class="detail-meta">📐 <strong>Diện tích sử dụng:</strong> <?php echo htmlspecialchars($apt['area']); ?></p>
            
            <h3 class="detail-section-title">Thông tin mô tả chi tiết</h3>
            <div class="detail-description">
                <?php echo nl2br(htmlspecialchars($apt['description'])); ?>
            </div>
            <h3 class="detail-section-title detail-map-title">Vị trí trên Bản đồ</h3>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3928.841518408643!2d105.76842661471182!3d10.029933692830615!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31a0895a51d60719%3A0x9d76b0035f6d53d0!2sCan%20Tho!5e0!3m2!1sen!2s!4v1640000000000!5m2!1sen!2s" class="map-frame" allowfullscreen="" loading="lazy"></iframe>
            <div class="cta-box">
                <p class="cta-text">Bạn quan tâm đến dự án này?</p>
                <a href="contact.php" class="cta-button">Nhận Tư Vấn Miễn Phí Ngay</a>
            </div>
        </div>

    </div>
</div>

<?php include 'includes/footer.php'; ?>
