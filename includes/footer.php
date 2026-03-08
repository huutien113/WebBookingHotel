<style>
    .floating-contact { position: fixed; bottom: 20px; right: 20px; display: flex; flex-direction: column; gap: 15px; z-index: 9999; }
    .float-btn { width: 50px; height: 50px; color: white; border-radius: 50%; display: flex; justify-content: center; align-items: center; text-decoration: none; font-weight: bold; font-size: 14px; box-shadow: 0 4px 10px rgba(0,0,0,0.3); animation: pulse 1.5s infinite; }
    .float-btn.zalo { background: #0068ff; }
    .float-btn.call { background: #28a745; animation-delay: 0.5s; }
    @keyframes pulse { 
        0% { transform: scale(1); box-shadow: 0 0 0 0 rgba(0, 104, 255, 0.7); } 
        70% { transform: scale(1.1); box-shadow: 0 0 0 10px rgba(0, 104, 255, 0); } 
        100% { transform: scale(1); box-shadow: 0 0 0 0 rgba(0, 104, 255, 0); } 
    }
</style>

<div class="floating-contact">
    <a href="https://zalo.me/0928241700" target="_blank" class="float-btn zalo">Zalo</a>
    <a href="tel:0928241700" class="float-btn call">Gọi</a>
</div>

<footer>
    <p>&copy; 2026 Nhóm 3 - Nền tảng Giới thiệu Chung cư</p>
</footer>
<script src="assets/js/script.js"></script>
</body>
</html>