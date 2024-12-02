<?php
include_once "includes/header.php";
$database = new Database();
$db = $database->getConnection();

if (!isset($_GET['job_id']) || !is_numeric($_GET['job_id'])) {
    echo "<div class='container mt-4'><p class='text-danger'>Invalid job ID.</p></div>";
    include_once "includes/footer.php";
    exit();
}

$jobId = $_GET['job_id'];

$query = "SELECT title, description, company, location, skills, max_applicants, app_limit, created_at,
       (SELECT COUNT(*) FROM jobs_app WHERE job_id = jobs.job_id) AS applicants
          FROM jobs 
          WHERE job_id = :id";
$stmt = $db->prepare($query);
$stmt->bindParam(':id', $jobId, PDO::PARAM_INT);
$stmt->execute();
$job = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$job) {
    echo "<div class='container mt-4'><p class='text-danger'>Job not found.</p></div>";
    include_once "includes/footer.php";
    exit();
}

$alreadyApplied = false;

if (isset($_SESSION['user'])) {
    $memberId = $_SESSION['user']['id'];

    $check_application_query = "SELECT 1 FROM jobs_app WHERE job_id = :job_id AND member_id = :member_id LIMIT 1";
    $stmt_check_application = $db->prepare($check_application_query);
    $stmt_check_application->bindParam(':job_id', $jobId, PDO::PARAM_INT);
    $stmt_check_application->bindParam(':member_id', $memberId, PDO::PARAM_INT);
    $stmt_check_application->execute();
    $alreadyApplied = $stmt_check_application->rowCount() > 0;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'apply') {
    if (!$alreadyApplied && strtotime($job['app_limit']) >= time()) {
        if ($job['applicants'] < $job['max_applicants']) {
            $cvDir = "resources/CVs/";
            $cvFile = $cvDir . basename($_FILES['CV']['name']);

            if (move_uploaded_file($_FILES['CV']['tmp_name'], $cvFile)) {
                $query_apply = "INSERT INTO jobs_app (member_id, job_id, CV) VALUES (:member_id, :job_id, :cv)";
                $stmt_apply = $db->prepare($query_apply);
                $stmt_apply->bindParam(':member_id', $memberId, PDO::PARAM_INT);
                $stmt_apply->bindParam(':job_id', $jobId, PDO::PARAM_INT);
                $stmt_apply->bindParam(':cv', $cvFile, PDO::PARAM_STR);

                if ($stmt_apply->execute()) {
                    $message = "<div class='alert alert-success'>You have successfully applied for this job!</div>";
                    $alreadyApplied = true;
                } else {
                    $message = "<div class='alert alert-danger'>There was an issue with your application. Please try again later.</div>";
                }
            } else {
                $message = "<div class='alert alert-danger'>Failed to upload your CV. Please try again.</div>";
            }
        } else {
            $message = "<div class='alert alert-warning'>This job application is already full.</div>";
        }
    } else {
        $message = "<div class='alert alert-warning'>You cannot apply for this job.</div>";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'unapply') {
    if ($alreadyApplied) {
        $query_unapply = "DELETE FROM jobs_app WHERE job_id = :job_id AND member_id = :member_id";
        $stmt_unapply = $db->prepare($query_unapply);
        $stmt_unapply->bindParam(':job_id', $jobId, PDO::PARAM_INT);
        $stmt_unapply->bindParam(':member_id', $memberId, PDO::PARAM_INT);

        if ($stmt_unapply->execute()) {
            $message = "<div class='alert alert-success'>You have successfully unapplied from this job.</div>";
            $alreadyApplied = false;
        } else {
            $message = "<div class='alert alert-danger'>There was an issue with your unapply request. Please try again later.</div>";
        }
    } else {
        $message = "<div class='alert alert-warning'>You haven't applied for this job.</div>";
    }
}

?>

<div class="container mt-4">
    <?php echo $message ?? ''; ?>

    <div class="row">
        <div class="col-md-8">
            <h1 class="mb-4"><?php echo htmlspecialchars($job['title']); ?></h1>
            <p><strong>Company:</strong> <?php echo htmlspecialchars($job['company']); ?></p>
            <p><strong>Location:</strong> <?php echo htmlspecialchars($job['location']); ?></p>
            <p><strong>Posted on:</strong> <?php echo date('d M Y', strtotime($job['created_at'])); ?></p>
            <p><strong>Last Day to Apply:</strong> <?php echo date('d M Y', strtotime($job['app_limit'])); ?></p>
            <hr>
            <p><strong>Description:</strong><br/><?php echo nl2br(htmlspecialchars($job['description'])); ?></p>
            <hr>
            <p><strong>Skills:</strong><br/><?php echo nl2br(htmlspecialchars($job['skills'])); ?></p>
            <hr>

            <!-- Apply / Unapply Section -->
            <?php if (isset($_SESSION['user'])): ?>
                <?php if ($alreadyApplied): ?>
                    <p class="text-success">You have already applied for this job.</p>
                    <form method="POST">
                        <input type="hidden" name="action" value="unapply">
                        <button type="submit" class="btn btn-danger">Unapply</button>
                    </form>
                <?php else: ?>
                    <form method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="apply">
                        <div class="form-group">
                            <label for="CV">Upload Your CV</label>
                            <input type="file" class="form-control" name="CV" id="CV" required>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Apply Now</button>
                    </form>
                <?php endif; ?>
            <?php else: ?>
                <p class="text-danger">Please log in to apply for this job.</p>
            <?php endif; ?>
        </div>

        <!-- Sidebar -->
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5>Job Details</h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li><strong>Company:</strong> <?php echo htmlspecialchars($job['company']); ?></li>
                        <li><strong>Location:</strong> <?php echo htmlspecialchars($job['location']); ?></li>
                        <li><strong>Posted on:</strong> <?php echo date('d M Y', strtotime($job['created_at'])); ?></li>
                        <li><strong>Last Day to Apply:</strong> <?php echo date('d M Y', strtotime($job['app_limit'])); ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once "includes/footer.php"; ?>
