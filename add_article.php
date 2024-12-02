<?php
include_once "includes/header.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $database = new Database();
    $db = $database->getConnection();

    $query = "INSERT INTO articles
 (title, description, full_content, author)
 VALUES (?, ?, ?, ?)";

    $stmt = $db->prepare($query);

    $stmt->execute([
        $_POST['title'],
        $_POST['description'],
        $_POST['full_content'],
        $_POST['author']
    ]);

    header("Location: articles.php");
    exit();
}
?>
<div class="form-container">
        <h2>Add Article</h2>
        <form method="POST">
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Description</label>
                <textarea name="description" class="form-control"></textarea>
            </div>

            <div class="form-group">
                <label>Content</label>
                <textarea name="full_content" class="form-control"></textarea>
            </div>

            <div class="form-group">
                <label>Author</label>
                <input type="text" name="author" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Add Article</button>
        </form>
</div>
<?php
include_once "includes/footer.php";
?>