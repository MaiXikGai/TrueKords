<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "truekords";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $song_id = $_GET['id'];

    // Lấy lời bài hát và link YouTube từ cơ sở dữ liệu
    $sql = "
        SELECT s.id, s.title, s.artist, s.release_date, s.youtube_link, s.root_tone, l.lyric
        FROM songs s 
        JOIN lyrics l ON s.id = l.song_id 
        WHERE s.id = '$song_id'
    ";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $song = $result->fetch_assoc();
    } else {
        echo "<p>Song not found.</p>";
        exit();
    }

    // Lấy tất cả các hợp âm từ cơ sở dữ liệu
    $sql_chords = "SELECT id, name, image_path FROM chords";
    $result_chords = $conn->query($sql_chords);

    $chords = [];
    while ($row = $result_chords->fetch_assoc()) {
        $chords[$row['id']] = [
            'name' => $row['name'],
            'image_path' => $row['image_path']
        ];
    }

    // Lấy đường dẫn tổng phổ từ cơ sở dữ liệu
    $sql_sheets = "SELECT sheet_path FROM sheets WHERE song_id = '$song_id'";
    $result_sheets = $conn->query($sql_sheets);

    if ($result_sheets->num_rows > 0) {
        $sheet = $result_sheets->fetch_assoc();
        $sheet_path = $sheet['sheet_path'];
    } else {
        $sheet_path = "";
    }

    function insertChords($lyrics, $chords) {
        return preg_replace_callback('/\[([0-9]+)\]/', function($matches) use ($chords) {
            $chord_id = $matches[1];
            if (isset($chords[$chord_id])) {
                return '[<span class="chord" data-image="' . htmlspecialchars($chords[$chord_id]['image_path']) . '">' . htmlspecialchars($chords[$chord_id]['name']) . '</span>]';
            } else {
                return htmlspecialchars($matches[0]); // Giữ nguyên nếu không phải là hợp âm hợp lệ
            }
        }, htmlspecialchars($lyrics));
    }
} else {
    echo "<p>Invalid song ID.</p>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TrueKords - View Song</title>
    <link rel="stylesheet" href="css/view_song.css">
    <script>
        function toggleView() {
            const lyrics = document.getElementById('lyrics');
            const score = document.getElementById('score');
            const toggleButton = document.getElementById('toggle-button');
            const fontSizeControls = document.querySelector('.font-size-controls');
            const imageSizeControls = document.querySelector('.image-size-controls');

            if (lyrics.style.display === 'none') {
                lyrics.style.display = 'block';
                score.style.display = 'none';
                toggleButton.innerText = 'Xem Tổng Phổ';
                fontSizeControls.style.display = 'flex';
                imageSizeControls.style.display = 'none';
            } else {
                lyrics.style.display = 'none';
                score.style.display = 'block';
                toggleButton.innerText = 'Xem Lời Bài Hát';
                fontSizeControls.style.display = 'none';
                imageSizeControls.style.display = 'flex';
            }
        }

        function toggleColumns() {
            const lyrics = document.getElementById('lyrics');
            lyrics.classList.toggle('two-columns');
        }

        function changeFontSize(amount) {
            const lyrics = document.getElementById('lyrics');
            let currentSize = window.getComputedStyle(lyrics).fontSize;
            currentSize = parseFloat(currentSize);
            let newSize = currentSize + amount;
            if (newSize >= 12) { // Ensure font size does not go below 12pt
                lyrics.style.fontSize = newSize + 'px';
                document.getElementById('font-size-display').innerText = Math.round(newSize) + 'px';
            }
        }

        function changeImageSize(amount) {
            const scoreImage = document.getElementById('score-image');
            let currentWidth = scoreImage.width;
            let newWidth = currentWidth + amount;
            if (newWidth >= 680 && newWidth <= 1000) { // Ensure image width is between 680px and 1000px
                scoreImage.style.width = newWidth + 'px';
                document.getElementById('image-size-display').innerText = newWidth + 'px';
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const chords = document.querySelectorAll('.chord');
            const chordImageContainer = document.createElement('div');
            chordImageContainer.style.position = 'absolute';
            chordImageContainer.style.display = 'none';
            chordImageContainer.style.zIndex = '1000'; // Ensure the image is on top
            chordImageContainer.style.backgroundColor = 'white'; // White background for transparency
            chordImageContainer.style.border = '1px solid #ccc'; // Optional: border for better visibility
            chordImageContainer.style.padding = '5px'; // Padding to create space around the image
            chordImageContainer.style.borderRadius = '5px'; // Rounded corners for a better look

            const imgElement = document.createElement('img');
            imgElement.style.width = '80px'; // Increase the image size
            chordImageContainer.appendChild(imgElement);
            document.body.appendChild(chordImageContainer);

            chords.forEach(chord => {
                chord.addEventListener('click', function(event) {
                    const imagePath = chord.getAttribute('data-image');
                    if (imagePath) {
                        imgElement.src = imagePath;
                        chordImageContainer.style.display = 'block';
                        chordImageContainer.style.left = event.pageX + 'px';
                        chordImageContainer.style.top = (event.pageY - chordImageContainer.offsetHeight - 10) + 'px'; // Position above the cursor
                    }
                });
            });

            document.addEventListener('click', function(event) {
                if (!event.target.classList.contains('chord')) {
                    chordImageContainer.style.display = 'none';
                }
            });
        });
    </script>
</head>
<body>
    <header>
        <div class="logo">
            <a href="index.html"><img src="images/logo.png" alt="logo"></a>
        </div>
    </header>
    <div class="content-container">
        <div class="song-container">
            <div class="song">
                <h1><?php echo htmlspecialchars($song['title']); ?> by <a href="artist_songs.php?artist=<?php echo urlencode($song['artist']); ?>"><?php echo htmlspecialchars($song['artist']); ?></a></h1>
                <p class="root-tone">Tone gốc: <?php echo htmlspecialchars($song['root_tone']); ?></p>
                <div class="controls">
                    <button id="toggle-button" onclick="toggleView()">Xem Tổng Phổ</button>
                    <button onclick="toggleColumns()">Toggle Columns</button>
                    <div class="font-size-controls">
                        <button onclick="changeFontSize(-2)">-</button>
                        <span id="font-size-display">16px</span>
                        <button onclick="changeFontSize(2)">+</button>
                    </div>
                    <div class="image-size-controls" style="display:none;">
                        <button onclick="changeImageSize(-20)">-</button>
                        <span id="image-size-display">800px</span>
                        <button onclick="changeImageSize(20)">+</button>
                    </div>
                </div>
                <div id="lyrics" class="lyrics">
                    <p><?php echo nl2br(insertChords($song['lyric'], $chords)); ?></p>
                </div>
                <div id="score" class="score" style="display:none;">
                    <?php if ($sheet_path): ?>
                        <img id="score-image" src="<?php echo htmlspecialchars($sheet_path); ?>" alt="Tổng phổ bài hát" style="max-width: 100%; width: 800px;">
                    <?php else: ?>
                        <p>No sheet available for this song.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php if (!empty($song['youtube_link'])): ?>
            <div class="video-container">
                <iframe width="280" height="157" src="https://www.youtube.com/embed/<?php echo htmlspecialchars($song['youtube_link']); ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
