<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit();
}

// Giả sử thông tin admin đã được lưu trong session
$admin_avatar = 'images/profile.png'; // Đường dẫn tới ảnh avatar của admin
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - TrueKords</title>
    <link rel="stylesheet" href="css/admin.css">
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const avatar = document.getElementById('admin-avatar');
            const dropdownMenu = document.getElementById('dropdown-menu');
            avatar.addEventListener('click', function() {
                dropdownMenu.classList.toggle('show');
            });
            window.addEventListener('click', function(e) {
                if (!avatar.contains(e.target) && !dropdownMenu.contains(e.target)) {
                    dropdownMenu.classList.remove('show');
                }
            });
        });
    </script>
</head>
<body>
    <header>
        <div class="logo">
            <a href="admin.php"><img src="images/logo.png" alt="logo"></a>
        </div>
        <div class="header-right">
            <img id="admin-avatar" src="<?php echo $admin_avatar; ?>" alt="Admin Avatar" class="avatar">
            <div id="dropdown-menu" class="dropdown-menu">
                <a href="manage_chords.php">Manage Chords</a>
                <a href="manage_songs.php">Manage Songs</a>
                <a href="logout.php">Logout</a>
            </div>
        </div>
    </header>
    <div class="admin-container">
        <h1>Admin Panel</h1>
        <nav>
            <ul>
                <li><a href="manage_chords.php">Quản lí hợp âm</a></li>
                <li><a href="manage_songs.php">Quản lí bài hát</a></li>
                <li><a href="manage_sheets.php">Quản lí tổng phổ</a></li>
            </ul>
        </nav>
    </div>
</body>
</html>
