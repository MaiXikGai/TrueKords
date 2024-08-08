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

if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $sql_delete = "DELETE FROM sheets WHERE id = '$delete_id'";
    $conn->query($sql_delete);
    header('Location: manage_sheets.php');
    exit();
}

$sql = "SELECT sheets.id, songs.title, sheets.sheet_path FROM sheets JOIN songs ON sheets.song_id = songs.id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Sheets - Admin - TrueKords</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
    <header>
        <div class="logo">
            <a href="admin.php"><img src="images/logo.png" alt="logo"></a>
        </div>
        <nav>
            <a href="manage_songs.php">Manage Songs</a>
            <a href="manage_chords.php">Manage Chords</a>
            <a href="manage_sheets.php">Manage Sheets</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>
    <div class="admin-container">
        <h1>Manage Sheets</h1>
        <a href="add_edit_sheet.php" class="button">Add New Sheet</a>
        <table>
            <tr>
                <th>Song Title</th>
                <th>Sheet Path</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['title']); ?></td>
                    <td><?php echo htmlspecialchars($row['sheet_path']); ?></td>
                    <td>
                        <a href="add_edit_sheet.php?id=<?php echo $row['id']; ?>">Edit</a>
                        <a href="manage_sheets.php?delete_id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this sheet?');">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>

<?php
$conn->close();
?>
