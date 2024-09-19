<?php
// Database connection
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $album = $_POST['album'];
    $tags = $_POST['tags'];
    $file = $_FILES['photo'];

    // Upload the photo
    $file_name = basename($file["name"]);
    $target_file = "uploads/" . $file_name;
    move_uploaded_file($file["tmp_name"], $target_file);

    // Save photo data to the database
    $stmt = $db->prepare("INSERT INTO photos (title, album, tags, file_name) VALUES (?, ?, ?, ?)");
    $stmt->execute([$title, $album, $tags, $file_name]);

    // Redirect back to the gallery
    header("Location: index.php");
}
