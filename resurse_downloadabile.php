<?php
include_once 'includes/header.php';

$directory = 'resources/resurse_downloadabile/';
$downloadableFiles = [];

if (is_dir($directory)) {
    $allFiles = array_diff(scandir($directory), array('..', '.')); // Exclude '.' and '..'
    // Filter to only show files (not directories)
    $downloadableFiles = array_filter($allFiles, function($file) use ($directory) {
        return is_file($directory . $file);
    });
}
?>
<div class="container mt-4">
    <h1 class="mb-4">Resurse Downloadabile</h1>

    <?php if (!empty($downloadableFiles)): ?>
        <ul class="list-group mt-4">
            <?php foreach ($downloadableFiles as $file): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span><?php echo htmlspecialchars($file); ?></span>
                    <a href="<?php echo $directory . htmlspecialchars($file); ?>" class="btn btn-success btn-sm" download>Download</a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p class="text-muted">No downloadable resources available.</p>
    <?php endif; ?>
</div>
<?php
include_once "includes/footer.php";
?>
