<?php
require_once 'includes/config.php';
include 'includes/header.php';
?>

<div class="hero" style="height: 200px;">
    <h1>Liên Hệ Với Chúng Tôi</h1>
</div>

<div class="container" style="max-width: 600px;">
    <div id="alert-msg" style="display:none; padding: 15px; margin-bottom: 20px; border-radius: 4px; text-align: center; font-weight: bold;"></div>

    <form id="contactForm" style="background: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
        <div style="margin-bottom: 15px;">
            <label style="display: block; font-weight: bold; margin-bottom: 5px; color: #333;">Họ và tên:</label>
            <input type="text" id="fullname" name="fullname" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
        </div>
        <div style="margin-bottom: 15px;">
            <label style="display: block; font-weight: bold; margin-bottom: 5px; color: #333;">Số điện thoại:</label>
            <input type="text" id="phone" name="phone" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
        </div>
        <div style="margin-bottom: 15px;">
            <label style="display: block; font-weight: bold; margin-bottom: 5px; color: #333;">Email:</label>
            <input type="email" id="email" name="email" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
        </div>
        <div style="margin-bottom: 15px;">
            <label style="display: block; font-weight: bold; margin-bottom: 5px; color: #333;">Lời nhắn:</label>
            <textarea id="message" name="message" rows="5" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;"></textarea>
        </div>
        <button type="submit" style="background: #003366; color: white; padding: 12px 20px; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; width: 100%; font-weight: bold; transition: 0.3s;">Gửi Thông Tin</button>
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