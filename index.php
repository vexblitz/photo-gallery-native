<?php
include 'templates/header.php';
include 'db.php'; // Pastikan ini disertakan

// Pastikan variabel $db didefinisikan dengan benar
$photos = $db->query("SELECT * FROM photos ORDER BY created_at DESC LIMIT 10");
?>
<div class="gallery-container">
    <h1>Photo Gallery</h1>
    <div class="photo-grid">
        <?php foreach ($photos as $photo) { ?>
            <div class='photo-card'>
                <img src='uploads/<?php echo $photo['file_name']; ?>' alt='<?php echo htmlspecialchars($photo['title']); ?>' />
                <p><?php echo htmlspecialchars($photo['title']); ?></p>
            </div>
        <?php } ?>
    </div>
</div>
<?php include 'templates/footer.php'; ?>