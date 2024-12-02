<?php
include_once "includes/header.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $database = new Database();
    $db = $database->getConnection();


    $tip = isset($_GET['tip']) ? $_GET['tip'] : '';

    $query = "INSERT INTO videos (titlu, descriere, tip, link) VALUES (?, ?, ?, ?)";
    $stmt = $db->prepare($query);

    $stmt->execute([
        $_POST['titlu'],
        $_POST['descriere'],
        $tip,
        $_POST['link']
    ]);
    if ($tip == 'material_video')
    {
        header("Location: materiale_video.php");
        exit();
    }elseif($tip == 'podcast')
    {
        header("Location: podcasts.php");
        exit();
    }

}
?>
    <div class="form-container">
        <h2>Add Video</h2>
        <form method="POST">
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="titlu" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Description</label>
                <textarea name="descriere" class="form-control" required></textarea>
            </div>

            <div class="form-group">
                <label>Link</label>
                <input type="url" name="link" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Add Video</button>
        </form>
    </div>

<?php
include_once "includes/footer.php";
?>