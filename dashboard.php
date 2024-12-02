<?php
include_once 'includes/header.php';
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$database = new Database();
$db = $database->getConnection();
?>
<div class="col-md-3"></div>
<div class="col-md-6 well">
    <h2 class="text-primary">Dashboard</h2>
    <hr style="border-top:1px dotted #ccc;"/>
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <?php
        $id = $_SESSION['user']['id'];
        $sql = $db->prepare("SELECT * FROM members WHERE id = :id");
        $sql->bindParam(':id', $id, PDO::PARAM_INT);
        $sql->execute();
        $fetch = $sql->fetch();
        ?>
        <h3>Welcome, <?php echo htmlspecialchars($fetch['first_name'] . " " . $fetch['last_name']); ?>!</h3>
    </div>
    <br/>
    <br/>
    <div>
        <h4>Recomandari de conexiuni:</h4>
        <br/>
        <?php
        $profession = $fetch['profession'];
        $company = $fetch['company'];
        $query = "SELECT * FROM members WHERE (profession = :profession OR company = :company) AND id != :id AND last_name != 'admin'";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':profession', $profession, PDO::PARAM_STR);
        $stmt->bindParam(':company', $company, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        ?>
        <div class="row">
            <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                <div class="col-md-4">
                    <div class="card member-card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($row['first_name'] . ' ' . $row['last_name']); ?></h5>
                            <p class="card-text">
                                <strong>Profession:</strong> <?php echo htmlspecialchars($row['profession']); ?><br>
                                <strong>Company:</strong> <?php echo htmlspecialchars($row['company']); ?>
                            </p>
                            <a href="profile_view.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">View Profile</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
        <br/>
        <h4>Recomandari de joburi:</h4>
        <br/>
        <?php
        $profession = $fetch['profession'];
        $expertise = $fetch['expertise'];
        $expertiseKeywords = explode(' ', $expertise);

        $jobQuery = "
            SELECT * FROM jobs WHERE title LIKE ? OR " . str_repeat("skills LIKE ? OR ", count($expertiseKeywords) - 1) . "skills LIKE ? LIMIT 5";

        $jobStmt = $db->prepare($jobQuery);

        $jobStmt->bindValue(1, '%' . $profession . '%', PDO::PARAM_STR);

        foreach ($expertiseKeywords as $index => $keyword) {
            $jobStmt->bindValue($index + 2, '%' . trim($keyword) . '%', PDO::PARAM_STR);
        }

        $jobStmt->execute();
        ?>
        <div class="row">
            <?php while ($job = $jobStmt->fetch(PDO::FETCH_ASSOC)): ?>
                <div class="col-md-4">
                    <div class="card member-card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($job['title']); ?></h5>
                            <p class="card-text">
                                <strong>Company:</strong> <?php echo htmlspecialchars($job['company']); ?><br>
                                <strong>Location:</strong> <?php echo htmlspecialchars($job['location']); ?>
                            </p>
                            <a href="job_details.php?job_id=<?php echo $job['job_id']; ?>" class="btn btn-success btn-sm">View Job</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>



    </div>
</div>

<?php
include_once "includes/footer.php";
?>
