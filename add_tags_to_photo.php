<?php
include 'db.php'; // Sertakan file db.php untuk koneksi database

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Periksa apakah 'photo_id' dan 'tag_ids' ada dalam array $_POST
    if (isset($_POST['photo_id']) && isset($_POST['tag_ids'])) {
        $photoId = $_POST['photo_id'];
        $tagIds = $_POST['tag_ids']; // Array of tag IDs

        try {
            $db->beginTransaction();
            $stmt = $db->prepare("INSERT INTO photo_tags (photo_id, tag_id) VALUES (?, ?)");

            foreach ($tagIds as $tagId) {
                $stmt->execute([$photoId, $tagId]);
            }

            $db->commit();
            $message = "Tags added to photo successfully!";
        } catch (PDOException $e) {
            $db->rollBack();
            $message = "Failed to add tags: " . $e->getMessage();
        }
    } else {
        $message = "Missing photo ID or tags.";
    }
} else {
    $message = "Invalid request method.";
}
?>

<p><?php echo htmlspecialchars($message); ?></p>