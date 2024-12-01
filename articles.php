<?php
include_once 'includes/header.php';
$database = new Database();
$db = $database->getConnection();

$articleId = isset($_GET['article_id']) ? intval($_GET['article_id']) : null;

if ($articleId) {

    $query = "SELECT * FROM articles WHERE article_id = :article_id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':article_id', $articleId, PDO::PARAM_INT);
    $stmt->execute();
    $article = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($article) {
        ?>
        <div class="container mt-4">
            <h1 class="mb-4"><?php echo htmlspecialchars($article['title']); ?></h1>
            <p class="text-muted">By <?php echo htmlspecialchars($article['author']); ?> | Published on <?php echo htmlspecialchars($article['published_on']); ?></p>
            <p><?php echo nl2br(htmlspecialchars($article['full_content'])); ?></p>
            <a href="articles.php" class="btn btn-primary mt-3">Back to Articles</a>
        </div>
        <br/>
        <br/>
        <?php
        include_once "includes/footer.php";
        exit;
    } else {
        echo "<p class='text-danger'>Article not found.</p>";
        echo "<a href='articles.php' class='btn btn-primary mt-3'>Back to Articles</a>";
        include_once "includes/footer.php";
        exit;
    }
}

// Search
$searchQuery = isset($_GET['search']) ? trim($_GET['search']) : '';

$query = "SELECT * FROM articles WHERE 1=1";
$params = [];

if (!empty($searchQuery)) {
    $query .= " AND (title LIKE :search OR description LIKE :search OR full_content LIKE :search)";
    $params[":search"] = "%" . $searchQuery . "%";
}

$stmt = $db->prepare($query);

foreach ($params as $key => $value) {
    $stmt->bindValue($key, $value);
}

$stmt->execute();
$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="container mt-4">
    <h1 class="mb-4">Articole si tutoriale</h1>

    <form method="GET" class="mb-4">
        <div class="form-group">
            <input type="text" name="search" class="form-control" placeholder="Cauta..." value="<?php echo htmlspecialchars($searchQuery); ?>">
        </div>
        <button type="submit" class="btn btn-primary">Cauta</button>
    </form>

    <?php if (!empty($articles)): ?>
        <?php foreach ($articles as $article): ?>
            <div class="card mb-3">
                <div class="card-body">
                    <h4 class="card-title">
                        <a href="articles.php?article_id=<?php echo urlencode($article['article_id']); ?>">
                            <?php echo htmlspecialchars($article['title']); ?>
                        </a>
                    </h4>
                    <p class="card-text"><?php echo htmlspecialchars($article['description']); ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="text-muted">No articles found.</p>
    <?php endif; ?>
</div>

<?php
include_once "includes/footer.php";
?>
