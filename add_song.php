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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $artist = $_POST['artist'];
    $release_date = $_POST['release_date'];
    $youtube_link = getYoutubeIdFromUrl($_POST['youtube_link']);
    $root_tone = $_POST['root_tone'];
    $lyric = $_POST['lyric'];

    $sql_song = "INSERT INTO songs (title, artist, release_date, youtube_link, root_tone) VALUES ('$title', '$artist', '$release_date', '$youtube_link', '$root_tone')";
    
    if ($conn->query($sql_song) === TRUE) {
        $song_id = $conn->insert_id;  // Lấy ID của bài hát vừa được thêm
        $sql_lyrics = "INSERT INTO lyrics (song_id, lyric) VALUES ('$song_id', '$lyric')";
        if ($conn->query($sql_lyrics) === TRUE) {
            header('Location: manage_songs.php');
            exit();
        } else {
            echo "Error: " . $sql_lyrics . "<br>" . $conn->error;
        }
    } else {
        echo "Error: " . $sql_song . "<br>" . $conn->error;
    }
}

$conn->close();

function getYoutubeIdFromUrl($url) {
    parse_str(parse_url($url, PHP_URL_QUERY), $vars);
    return $vars['v'];
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Song - Admin - TrueKords</title>
    <link rel="stylesheet" href="css/admin.css">
    <script>
        function confirmSubmit() {
            return confirm("Are you sure you want to add this song?");
        }
    </script>
</head>
<body>
    <header>
        <div class="logo">
            <a href="admin.php"><img src="images/logo.png" alt="logo"></a>
        </div>
    </header>
    <div class="admin-container">
        <h1>Add Song</h1>
        <form action="add_song.php" method="POST" class="form-container" onsubmit="return confirmSubmit();">
            <div class="input-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" required>
            </div>
            <div class="input-group">
                <label for="artist">Artist</label>
                <input type="text" id="artist" name="artist" required>
            </div>
            <div class="input-group">
                <label for="release_date">Release Date</label>
                <input type="date" id="release_date" name="release_date" required>
            </div>
            <div class="input-group">
                <label for="youtube_link">YouTube Link</label>
                <input type="text" id="youtube_link" name="youtube_link" required>
            </div>
            <div class="input-group">
                <label for="root_tone">Root Tone</label>
                <input type="text" id="root_tone" name="root_tone" required>
            </div>
            <div class="input-group">
                <label for="lyric">Lyrics</label>
                <textarea id="lyric" name="lyric" rows="10" required></textarea>
            </div>
            <button type="submit" class="button">Add Song</button>
        </form>
    </div>
</body>
</html>
