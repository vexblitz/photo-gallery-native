<?php
include 'db.php'; // Sertakan file db.php untuk koneksi database

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['photo_id']) && isset($_POST['tag_ids'])) {
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
}
?>

<form action="add_tags_to_photo.php" method="POST">
    <input type="hidden" name="photo_id" value="<?php echo htmlspecialchars($photoId); ?>">
    <label for="tag_ids">Select Tags:</label>
    <select id="tag_ids" name="tag_ids[]" multiple>
        <?php
        $stmt = $db->query("SELECT * FROM tags");
        $tags = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($tags as $tag):
        ?>
            <option value="<?php echo $tag['id']; ?>"><?php echo htmlspecialchars($tag['name']); ?></option>
        <?php endforeach; ?>
    </select>
    <button type="submit">Add Tags</button>
</form>