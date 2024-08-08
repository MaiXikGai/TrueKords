<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "truekords";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$artist = $_GET['artist'];

// Lấy danh sách bài hát của ca sĩ từ cơ sở dữ liệu
$sql = "SELECT id, title, release_date FROM songs WHERE artist = '$artist'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TrueKords - Songs by <?php echo htmlspecialchars($artist); ?></title>
    <link rel="stylesheet" href="css/artist_songs.css">
</head>
<body>
    <header>
        <div class="logo">
            <a href="index.html"><img src="images/logo.png" alt="logo"></a>
        </div>
    </header>
    <div class="content-container">
        <div class="song-container">
            <h1>Songs by <?php echo htmlspecialchars($artist); ?></h1>
            <?php
            if ($result->num_rows > 0) {
                echo "<ul class='song-list'>";
                while ($song = $result->fetch_assoc()) {
                    echo "<li class='song-item'><a href='view_song.php?id=" . $song['id'] . "'>" . htmlspecialchars($song['title']) . "</a><span class='release-date'>" . htmlspecialchars($song['release_date']) . "</span></li>";
                }
                echo "</ul>";
            } else {
                echo "<p>No songs found for this artist.</p>";
            }
            ?>
        </div>
    </div>
</body>
</html>
