<?php
require 'includes/header.php';
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<div class='alert alert-danger'>Invalid profile ID.</div>";
    include_once 'includes/footer.php';
    exit;
}

$id = (int)$_GET['id'];

$database = new Database();
$db = $database->getConnection();

$sql = $db->prepare("SELECT * FROM members WHERE id = :id");
$sql->bindParam(':id', $id, PDO::PARAM_INT);
$sql->execute();
$user = $sql->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "<div class='alert alert-warning'>Profile not found.</div>";
    include_once 'includes/footer.php';
    exit;
}
?>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-4 text-center">
                <img src="<?php echo htmlspecialchars($user['pfp'] ? $user['pfp'] : 'resources/default_profile_pic.jpg'); ?>"
                     alt="Profile Picture"
                     class="img-fluid rounded-circle border"
                     style="max-width: 200px;">
            </div>
            <div class="col-md-8">
                <h2><?php echo htmlspecialchars($user['first_name'] . " " . $user['last_name']); ?></h2>
                <p><strong>Profession:</strong> <?php echo htmlspecialchars($user['profession']); ?></p>
                <p><strong>Company:</strong> <?php echo htmlspecialchars($user['company']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
                <p><strong>LinkedIn:</strong> <a href="<?php echo htmlspecialchars($user['linkedin_profile']); ?>"><?php echo htmlspecialchars($user['first_name'] . " " . $user['last_name']); ?></a></p>
                <p><strong>Joined:</strong> <?php echo htmlspecialchars(date('F d, Y', strtotime($user['created_at']))); ?></p>
            </div>
        </div>
        <hr>
        <h4>About <?php echo htmlspecialchars($user['first_name']); ?>:</h4>
        <p><?php echo nl2br(htmlspecialchars($user['expertise'])); ?></p>
        <hr>
        <a href="dashboard.php" class="btn btn-secondary">Inapoi la Dashboard</a>
    </div>
<?php
include_once 'includes/footer.php';
?>