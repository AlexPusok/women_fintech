<?php
include_once "includes/header.php";
$database = new Database();
$db = $database->getConnection();

$query_upcoming_jobs = "SELECT job_id, title, company, location, app_limit, created_at FROM jobs WHERE app_limit >= NOW()";

$query_past_jobs = "SELECT job_id, title, company, location, app_limit, created_at FROM jobs WHERE app_limit < NOW() AND app_limit >= DATE_SUB(NOW(), INTERVAL 1 MONTH)";


$filterQuery = '';
$params = [];
if (!empty($_POST['filterType']) && !empty($_POST['filterValue'])) {
    $filterColumn = $_POST['filterType'];
    $filterQuery = " AND $filterColumn = :filterValue";
    $params[':filterValue'] = $_POST['filterValue'];
}

$stmt_upcoming = $db->prepare($query_upcoming_jobs . $filterQuery);
$stmt_upcoming->execute($params);
$jobs_upcoming = $stmt_upcoming->fetchAll(PDO::FETCH_ASSOC);

$stmt_past = $db->prepare($query_past_jobs . $filterQuery);
$stmt_past->execute($params);
$jobs_past = $stmt_past->fetchAll(PDO::FETCH_ASSOC);
?>

<?php if ($_SESSION['user']['status'] === 'admin'): ?>
    <a href="create_job.php" class="btn btn-primary">Create Job</a>
<?php endif; ?>

<!-- Filter Section -->
<button class="btn btn-primary" onclick="toggleFilterSection()">Filtreaza dupa:</button>
<br/>
<div id="filterSection" class="mt-3">
    <form method="post" action="">
        <!-- Select Filter Type -->
        <div class="form-group">
            <label for="filterType">Select Filter Type:</label>
            <select name="filterType" id="filterType" class="form-control" onchange="this.form.submit()">
                <option value="">-- Select Filter Type --</option>
                <option value="title" <?php echo ($_POST['filterType'] ?? '') === 'title' ? 'selected' : ''; ?>>Job Title</option>
                <option value="company" <?php echo ($_POST['filterType'] ?? '') === 'company' ? 'selected' : ''; ?>>Company</option>
                <option value="location" <?php echo ($_POST['filterType'] ?? '') === 'location' ? 'selected' : ''; ?>>Location</option>
            </select>
        </div>

        <!-- Select Filter Value -->
        <?php if (!empty($_POST['filterType'])): ?>
            <div class="form-group mt-3">
                <label for="filterValue">Select Value:</label>
                <select name="filterValue" id="filterValue" class="form-control">
                    <option value="">-- Select Value --</option>
                    <?php
                    $filterColumn = $_POST['filterType'];
                    $query = "SELECT DISTINCT $filterColumn FROM jobs WHERE $filterColumn IS NOT NULL AND $filterColumn != ''";
                    $stmt = $db->prepare($query);
                    $stmt->execute();
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $selected = ($_POST['filterValue'] ?? '') === $row[$filterColumn] ? 'selected' : '';
                        echo '<option value="' . htmlspecialchars($row[$filterColumn]) . '"' . $selected . '>' . htmlspecialchars($row[$filterColumn]) . '</option>';
                    }
                    ?>
                </select>
            </div>
        <?php endif; ?>

        <button type="submit" class="btn btn-success mt-3">Filter</button>
    </form>
</div>
<br/>

<!-- Available Jobs Section -->
<div class="container mt-4">
    <h2 class="text-center mb-4">Available Jobs</h2>
    <?php if (!empty($jobs_upcoming)): ?>
        <div class="row">
            <?php foreach ($jobs_upcoming as $job): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 d-flex flex-column">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?php echo htmlspecialchars($job['title']); ?></h5>
                            <p class="card-text">
                                <strong>Company:</strong> <?php echo htmlspecialchars($job['company']); ?><br>
                                <strong>Location:</strong> <?php echo htmlspecialchars($job['location']); ?><br>
                                <strong>Posted on:</strong> <?php echo date('d M Y', strtotime($job['created_at'])); ?><br>
                                <strong>Last Day to Apply:</strong> <?php echo date('d M Y', strtotime($job['app_limit'])); ?><br>
                            </p>
                            <div class="mt-auto">
                                <a href="job_details.php?job_id=<?php echo $job['job_id']; ?>" class="btn btn-primary btn-block">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p class="text-center">No available jobs at the moment. Please check back later.</p>
    <?php endif; ?>
</div>

<!-- Past Jobs Section -->
<div class="container mt-4">
    <h2 class="text-center mb-4">Past Jobs (Last Month)</h2>
    <?php if (!empty($jobs_past)): ?>
        <div class="row">
            <?php foreach ($jobs_past as $job): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 d-flex flex-column">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?php echo htmlspecialchars($job['title']); ?></h5>
                            <p class="card-text">
                                <strong>Company:</strong> <?php echo htmlspecialchars($job['company']); ?><br>
                                <strong>Location:</strong> <?php echo htmlspecialchars($job['location']); ?><br>
                                <strong>Posted on:</strong> <?php echo date('d M Y', strtotime($job['created_at'])); ?><br>
                                <strong>Last Day to Apply:</strong> <?php echo date('d M Y', strtotime($job['app_limit'])); ?><br>
                            </p>
                            <div class="mt-auto">
                                <a href="job_details.php?job_id=<?php echo $job['job_id']; ?>" class="btn btn-primary btn-block">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p class="text-center">No past jobs in the last month. Please check back later.</p>
    <?php endif; ?>
</div>

<?php
include_once "includes/footer.php";
?>
