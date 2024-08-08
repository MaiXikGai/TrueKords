<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "truekords";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['q'])) {
    $search = $conn->real_escape_string($_GET['q']);
    $sql = "SELECT * FROM songs WHERE title LIKE '%$search%' OR artist LIKE '%$search%'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $song = $result->fetch_assoc();
        header("Location: view_song.php?id=" . $song['id']);
        exit();
    } else {
        echo "<script>alert('No songs found');</script>";
        echo "<script>window.location.href = 'index.html';</script>";
    }
}
?>
