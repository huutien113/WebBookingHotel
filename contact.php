<?php
require_once 'includes/config.php';
include 'includes/header.php';
?>

<div class="hero hero-compact">
    <h1>Liên Hệ Với Chúng Tôi</h1>
</div>

<div class="container contact-wrapper">
    <div id="alert-msg" class="alert-msg"></div>

    <form id="contactForm" class="contact-form">
        <div class="form-group">
            <label class="form-label">Họ và tên:</label>
            <input type="text" id="fullname" name="fullname" required class="form-input">
        </div>
        <div class="form-group">
            <label class="form-label">Số điện thoại:</label>
            <input type="text" id="phone" name="phone" required class="form-input">
        </div>
        <div class="form-group">
            <label class="form-label">Email:</label>
            <input type="email" id="email" name="email" required class="form-input">
        </div>
        <div class="form-group">
            <label class="form-label">Lời nhắn:</label>
            <textarea id="message" name="message" rows="5" required class="form-textarea"></textarea>
        </div>
        <button type="submit" class="form-submit">Gửi Thông Tin</button>
    </form>
</div>

<script>
document.getElementById('contactForm').addEventListener('submit', function(e) {
    e.preventDefault();

    let formData = new FormData(this);
    let alertMsg = document.getElementById('alert-msg');

    fetch('process_contact.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        alertMsg.style.display = 'block';
        if(data.trim() === 'success') {
            alertMsg.style.backgroundColor = '#d4edda';
            alertMsg.style.color = '#155724';
            alertMsg.innerHTML = 'Cảm ơn bạn! Thông tin đã được gửi thành công.';
            document.getElementById('contactForm').reset();
        } else if(data.trim() === 'empty') {
            alertMsg.style.backgroundColor = '#fff3cd';
            alertMsg.style.color = '#856404';
            alertMsg.innerHTML = 'Vui lòng điền đầy đủ thông tin!';
        } else {
            alertMsg.style.backgroundColor = '#f8d7da';
            alertMsg.style.color = '#721c24';
            alertMsg.innerHTML = 'Có lỗi xảy ra, vui lòng thử lại!';
        }
    })
    .catch(error => console.error('Error:', error));
});
</script>

<?php include 'includes/footer.php'; ?>
