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
    $id = $_GET['id'];
    $title = $_POST['title'];
    $artist = $_POST['artist'];
    $release_date = $_POST['release_date'];
    $youtube_link = getYoutubeIdFromUrl($_POST['youtube_link']);
    $root_tone = $_POST['root_tone'];
    $lyric = $_POST['lyric'];

    $sql = "UPDATE songs SET title='$title', artist='$artist', release_date='$release_date', youtube_link='$youtube_link', root_tone='$root_tone' WHERE id=$id";
    $sql_lyrics = "UPDATE lyrics SET lyric='$lyric' WHERE song_id=$id";
    
    if ($conn->query($sql) === TRUE && $conn->query($sql_lyrics) === TRUE) {
        header('Location: manage_songs.php');
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$id = $_GET['id'];
$sql = "SELECT * FROM songs WHERE id=$id";
$result = $conn->query($sql);

$sql_lyrics = "SELECT * FROM lyrics WHERE song_id=$id";
$result_lyrics = $conn->query($sql_lyrics);

if ($result->num_rows > 0) {
    $song = $result->fetch_assoc();
    $lyric = $result_lyrics->fetch_assoc();
} else {
    echo "Song not found";
    exit();
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
    <title>Edit Song - Admin - TrueKords</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
    <header>
        <div class="logo">
            <a href="admin.php"><img src="images/logo.png" alt="logo"></a>
        </div>
    </header>
    <div class="admin-container">
        <h1>Edit Song</h1>
        <form action="edit_song.php?id=<?php echo $song['id']; ?>" method="POST" class="form-container">
            <div class="input-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($song['title']); ?>" required>
            </div>
            <div class="input-group">
                <label for="artist">Artist</label>
                <input type="text" id="artist" name="artist" value="<?php echo htmlspecialchars($song['artist']); ?>" required>
            </div>
            <div class="input-group">
                <label for="release_date">Release Date</label>
                <input type="date" id="release_date" name="release_date" value="<?php echo htmlspecialchars($song['release_date']); ?>" required>
            </div>
            <div class="input-group">
                <label for="youtube_link">YouTube Link</label>
                <input type="text" id="youtube_link" name="youtube_link" value="https://www.youtube.com/watch?v=<?php echo htmlspecialchars($song['youtube_link']); ?>" required>
            </div>
            <div class="input-group">
                <label for="root_tone">Root Tone</label>
                <input type="text" id="root_tone" name="root_tone" value="<?php echo htmlspecialchars($song['root_tone']); ?>" required>
            </div>
            <div class="input-group">
                <label for="lyric">Lyrics</label>
                <textarea id="lyric" name="lyric" rows="10" required><?php echo htmlspecialchars($lyric['lyric']); ?></textarea>
            </div>
            <button type="submit" class="button">Update Song</button>
        </form>
    </div>
</body>
</html>
