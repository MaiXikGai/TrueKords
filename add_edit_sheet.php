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

$song_id = '';
$sheet_path = '';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM sheets WHERE id = '$id'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $sheet = $result->fetch_assoc();
        $song_id = $sheet['song_id'];
        $sheet_path = $sheet['sheet_path'];
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $song_id = $_POST['song_id'];
    $sheet_path = $_POST['sheet_path'];

    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $sql = "UPDATE sheets SET song_id = '$song_id', sheet_path = '$sheet_path' WHERE id = '$id'";
    } else {
        $sql = "INSERT INTO sheets (song_id, sheet_path) VALUES ('$song_id', '$sheet_path')";
    }

    if ($conn->query($sql) === TRUE) {
        header('Location: manage_sheets.php');
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$sql_songs = "SELECT id, title FROM songs";
$result_songs = $conn->query($sql_songs);

$conn->close();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($id) ? 'Edit' : 'Add'; ?> Sheet - Admin - TrueKords</title>
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
        <h1><?php echo isset($id) ? 'Edit' : 'Add'; ?> Sheet</h1>
        <form action="add_edit_sheet.php" method="POST" class="form-container">
            <?php if (isset($id)): ?>
                <input type="hidden" name="id" value="<?php echo $id; ?>">
            <?php endif; ?>
            <div class="input-group">
                <label for="song_id">Song Title</label>
                <select id="song_id" name="song_id" required>
                    <?php while ($row = $result_songs->fetch_assoc()): ?>
                        <option value="<?php echo $row['id']; ?>" <?php echo ($row['id'] == $song_id) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($row['title']); ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="input-group">
                <label for="sheet_path">Sheet Path</label>
                <input type="text" id="sheet_path" name="sheet_path" value="<?php echo htmlspecialchars($sheet_path); ?>" required>
            </div>
            <button type="submit" class="button"><?php echo isset($id) ? 'Update' : 'Add'; ?> Sheet</button>
        </form>
    </div>
</body>
</html>
