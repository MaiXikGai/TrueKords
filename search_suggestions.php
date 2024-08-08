<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "truekords";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['q']) && !empty(trim($_GET['q']))) {
    $search_term = $conn->real_escape_string($_GET['q']);
    
    // Tìm kiếm bài hát hoặc nghệ sĩ dựa trên từ khóa
    $sql = "SELECT id, title, artist FROM songs WHERE title LIKE '%$search_term%' OR artist LIKE '%$search_term%'";
    $result = $conn->query($sql);
    
    $results = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $results[] = $row;
        }
    }
    echo json_encode($results);
} else {
    echo json_encode([]);
}

$conn->close();
?>
