<?php
include 'templates/header.php';
include 'db.php'; // Sertakan file db.php untuk koneksi database

// Handle form submission for adding a new album
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $albumName = $_POST['album_name'];

    try {
        $stmt = $db->prepare("INSERT INTO albums (name) VALUES (?)");
        $stmt->execute([$albumName]);
        $message = "Album added successfully!";
    } catch (PDOException $e) {
        $message = "Failed to add album: " . $e->getMessage();
    }
}

// Fetch albums from the database
try {
    $stmt = $db->query("SELECT * FROM albums ORDER BY name ASC");
    $albums = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $message = "Failed to retrieve albums: " . $e->getMessage();
    $albums = [];
}
?>

<div class="albums-container">
    <h2>Albums</h2>

    <?php if (isset($message)): ?>
        <p><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>

    <form action="albums.php" method="POST">
        <label for="album_name">New Album Name:</label>
        <input type="text" id="album_name" name="album_name" required>
        <button type="submit">Add Album</button>
    </form>

    <div class="albums-list">
        <?php if ($albums): ?>
            <ul>
                <?php foreach ($albums as $album): ?>
                    <li><?php echo htmlspecialchars($album['name']); ?></li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No albums found.</p>
        <?php endif; ?>
    </div>
</div>

<?php include 'templates/footer.php'; ?>