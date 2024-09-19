<?php
include 'templates/header.php';
include 'db.php'; // Pastikan ini disertakan

if (isset($_GET['query'])) {
    $query = "%" . $_GET['query'] . "%";

    try {
        // Query database untuk mencari foto berdasarkan query
        $stmt = $db->prepare("SELECT * FROM photos WHERE title LIKE ? OR album LIKE ? OR tags LIKE ?");
        $stmt->execute([$query, $query, $query]);
        $photos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Database query failed: " . $e->getMessage();
        $photos = []; // Set photos menjadi array kosong jika query gagal
    }
} else {
    $photos = [];
}
?>
<div class="search-container">
    <h2>Search Photos</h2>
    <form method="GET" action="">
        <input type="text" name="query" placeholder="Search by title, album, or tag" value="<?php echo htmlspecialchars($_GET['query'] ?? '', ENT_QUOTES); ?>">
        <button type="submit">Search</button>
    </form>

    <div class="photo-grid">
        <?php if ($photos): ?>
            <?php foreach ($photos as $photo): ?>
                <div class='photo-card'>
                    <img src='uploads/<?php echo htmlspecialchars($photo['file_name']); ?>' alt='<?php echo htmlspecialchars($photo['title']); ?>' />
                    <p><?php echo htmlspecialchars($photo['title']); ?></p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No photos found.</p>
        <?php endif; ?>
    </div>
</div>
<?php include 'templates/footer.php'; ?>