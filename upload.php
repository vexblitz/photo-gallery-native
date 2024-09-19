<?php include 'templates/header.php'; ?>

<div class="upload-container">
    <h2>Upload New Photo</h2>
    <form action="manage.php" method="POST" enctype="multipart/form-data">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required>

        <label for="album">Album:</label>
        <input type="text" id="album" name="album">

        <label for="tags">Tags (comma separated):</label>
        <input type="text" id="tags" name="tags">

        <label for="photo">Choose a photo:</label>
        <input type="file" id="photo" name="photo" accept="image/*" required>

        <button type="submit">Upload</button>
    </form>
</div>

<?php include 'templates/footer.php'; ?>