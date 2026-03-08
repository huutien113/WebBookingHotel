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

<div class="container" style="margin-top: 40px; margin-bottom: 60px;">
    <div style="background: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); display: flex; flex-wrap: wrap; gap: 40px;">
        
        <div style="flex: 1; min-width: 350px;">
            <img src="assets/images/<?php echo htmlspecialchars($apt['image_url']); ?>" style="width: 100%; border-radius: 8px; object-fit: cover; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
        </div>
        
        <div style="flex: 1; min-width: 350px;">
            <span style="background-color: #28a745; color: white; padding: 6px 12px; border-radius: 4px; font-weight: bold; font-size: 14px;"><?php echo htmlspecialchars($apt['status']); ?></span>
            
            <h1 style="color: #003366; margin: 15px 0 20px 0; font-size: 32px;"><?php echo htmlspecialchars($apt['title']); ?></h1>
            
            <div style="background: #f8f9fa; padding: 15px; border-radius: 8px; border-left: 5px solid #dc3545; margin-bottom: 25px;">
                <p style="font-size: 24px; color: #dc3545; font-weight: bold; margin: 0;">💰 Giá bán: <?php echo htmlspecialchars($apt['price']); ?></p>
            </div>
            
            <p style="margin-bottom: 15px; font-size: 18px; color: #333;">📍 <strong>Vị trí dự án:</strong> <?php echo htmlspecialchars($apt['location']); ?></p>
            <p style="margin-bottom: 25px; font-size: 18px; color: #333;">📐 <strong>Diện tích sử dụng:</strong> <?php echo htmlspecialchars($apt['area']); ?></p>
            
            <h3 style="color: #003366; margin-bottom: 10px; border-bottom: 2px solid #eee; padding-bottom: 10px;">Thông tin mô tả chi tiết</h3>
            <div style="line-height: 1.8; color: #444; font-size: 16px; text-align: justify;">
                <?php echo nl2br(htmlspecialchars($apt['description'])); ?>
            </div>
            <h3 style="color: #003366; margin-top: 30px; margin-bottom: 10px; border-bottom: 2px solid #eee; padding-bottom: 10px;">Vị trí trên Bản đồ</h3>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3928.841518408643!2d105.76842661471182!3d10.029933692830615!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31a0895a51d60719%3A0x9d76b0035f6d53d0!2sCan%20Tho!5e0!3m2!1sen!2s!4v1640000000000!5m2!1sen!2s" width="100%" height="250" style="border:0; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);" allowfullscreen="" loading="lazy"></iframe>
            <div style="margin-top: 40px; border-top: 1px solid #eee; padding-top: 20px;">
                <p style="margin-bottom: 15px; color: #666;">Bạn quan tâm đến dự án này?</p>
                <a href="contact.php" style="display: inline-block; background: #ffcc00; color: #003366; padding: 15px 30px; text-decoration: none; font-weight: bold; border-radius: 4px; text-align: center; font-size: 18px; transition: 0.3s; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">Nhận Tư Vấn Miễn Phí Ngay</a>
            </div>
        </div>

    </div>
</div>

<?php include 'includes/footer.php'; ?>