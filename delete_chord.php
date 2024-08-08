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

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    // Xóa hợp âm từ cơ sở dữ liệu
    $sql = "DELETE FROM chords WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        header('Location: manage_chords.php');
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    header('Location: manage_chords.php');
}
?>
