<?php
include 'db.php'; // Sertakan file db.php untuk koneksi database

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tag_name'])) {
    $tagName = $_POST['tag_name'];

    try {
        $stmt = $db->prepare("INSERT INTO tags (name) VALUES (?) ON DUPLICATE KEY UPDATE name=name");
        $stmt->execute([$tagName]);
        $message = "Tag added successfully!";
    } catch (PDOException $e) {
        $message = "Failed to add tag: " . $e->getMessage();
    }
}
?>

<form action="add_tag.php" method="POST">
    <label for="tag_name">New Tag:</label>
    <input type="text" id="tag_name" name="tag_name" required>
    <button type="submit">Add Tag</button>
</form>