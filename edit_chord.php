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
    $name = $_POST['name'];
    $image_path = $_POST['image_path'];
    $description = $_POST['description'];

    $sql = "UPDATE chords SET name='$name', image_path='$image_path', description='$description' WHERE id=$id";
    
    if ($conn->query($sql) === TRUE) {
        header('Location: manage_chords.php');
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$id = $_GET['id'];
$sql = "SELECT * FROM chords WHERE id=$id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $chord = $result->fetch_assoc();
} else {
    echo "Chord not found";
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Chord - Admin - TrueKords</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
    <header>
        <div class="logo">
            <a href="admin.php"><img src="images/logo.png" alt="logo"></a>
        </div>
    </header>
    <div class="admin-container">
        <h1>Edit Chord</h1>
        <form action="edit_chord.php?id=<?php echo $chord['id']; ?>" method="POST" class="form-container">
            <div class="input-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($chord['name']); ?>" required>
            </div>
            <div class="input-group">
                <label for="image_path">Image Path</label>
                <input type="text" id="image_path" name="image_path" value="<?php echo htmlspecialchars($chord['image_path']); ?>" required>
            </div>
            <div class="input-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="4"><?php echo htmlspecialchars($chord['description']); ?></textarea>
            </div>
            <button type="submit" class="button">Update Chord</button>
        </form>
    </div>
</body>
</html>
