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
        $sql = $db->prepare("SELECT * FROM members WHERE id ='$id'");
        $sql->execute();
        $fetch = $sql->fetch();
        ?>
        <h3>Welcome, <?php echo $fetch['first_name'] . " " . $fetch['last_name']; ?>!</h3>
    </div>
    <br/>
    <br/>
    <div>
        <h4>Recomandari de conexiuni:</h4>
        <br/>
        <?php
        $profession = $fetch['profession'];
        $company = $fetch['company'];
        $query = "SELECT * FROM members WHERE (profession = '$profession' OR company = '$company') AND id != '$id'";
        $stmt = $db->prepare($query);
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
    </div>
</div>

<?php
include_once "includes/footer.php";
?>
