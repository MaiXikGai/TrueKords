<?php
session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "truekords";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM songs WHERE id=$id";
    $conn->query($sql);
}

$sql = "SELECT * FROM songs";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Songs - Admin - TrueKords</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
    <header>
        <div class="logo">
            <a href="admin.php"><img src="images/logo.png" alt="logo"></a>
        </div>
    </header>
    <div class="admin-container">
        <h1>Quản lí bài hát</h1>
        <a href="add_song.php" class="button">Thêm bài hát</a>
        <table>
            <thead>
                <tr>
                    <th>Tiêu đề</th>
                    <th>Nghệ sĩ</th>
                    <th>Ngày cập nhật</th>
                    <th>Chức năng</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($song = $result->fetch_assoc()) {
                        echo "<tr><td>" . htmlspecialchars($song['title']) . "</td><td>" . htmlspecialchars($song['artist']) . "</td><td>" . htmlspecialchars($song['update_date']) . "</td>" .
                             "<td><a href='edit_song.php?id=" . $song['id'] . "'>Edit</a>" .
                             " <a href='manage_songs.php?delete=" . $song['id'] . "'>Delete</a></td></tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No songs found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
