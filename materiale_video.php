<?php
include_once 'includes/header.php';
$database = new Database();
$db = $database->getConnection();

$query = "SELECT * FROM videos WHERE tip = 'material_video'";
$stmt = $db->prepare($query);
$stmt->execute();
$videos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="container mt-4">
    <h1 class="mb-4">Materiale Video</h1>

    <?php if (!empty($videos)): ?>
        <?php foreach ($videos as $video): ?>
            <div class="card mb-3">
                <div class="card-body">
                    <h4 class="card-title">
                        <?php echo htmlspecialchars($video['titlu']); ?>
                    </h4>
                    <p class="card-text"><?php echo htmlspecialchars($video['desciere']); ?></p>
                    <small class="text-muted">Published on: <?php echo htmlspecialchars($video['published_at']); ?></small>

                    <?php if (filter_var($video['link'], FILTER_VALIDATE_URL)): ?>  <!-- Player video -->
                        <?php if (strpos($video['link'], 'youtube.com') !== false): ?>
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?php echo getYouTubeVideoId($video['link']); ?>" allowfullscreen></iframe>
                            </div>
                        <?php else: ?>
                            <video controls width="100%">
                                <source src="<?php echo htmlspecialchars($video['link']); ?>" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="text-muted">No videos available.</p>
    <?php endif; ?>
</div>

<?php
function getYouTubeVideoId($url) {
    preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $url, $matches);
    return isset($matches[1]) ? $matches[1] : null;
}
include_once "includes/footer.php";
?>
