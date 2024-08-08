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
    $sql = "DELETE FROM chords WHERE id=$id";
    $conn->query($sql);
}

$sql = "SELECT * FROM chords";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Chords - Admin - TrueKords</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
    <header>
        <div class="logo">
            <a href="admin.php"><img src="images/logo.png" alt="logo"></a>
        </div>
    </header>
    <div class="admin-container">
        <h1>Manage Chords</h1>
        <a href="add_chord.php" class="button">Add Chord</a>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($chord = $result->fetch_assoc()) {
                        echo "<tr><td>" . htmlspecialchars($chord['name']) . "</td>" .
                             "<td><a href='edit_chord.php?id=" . $chord['id'] . "'>Edit</a>" .
                             " <a href='manage_chords.php?delete=" . $chord['id'] . "'>Delete</a></td></tr>";
                    }
                } else {
                    echo "<tr><td colspan='2'>No chords found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
