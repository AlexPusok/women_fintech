<?php
include_once "includes/header.php";
$database = new Database();
$db = $database->getConnection();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $query = "UPDATE members
 SET first_name=?, last_name=?, email=?, profession=?,
 company=?, expertise=?, linkedin_profile=?, status=?, password=?
 WHERE id=?";

    $stmt = $db->prepare($query);
    $stmt->execute([
        $_POST['first_name'],
        $_POST['last_name'],
        $_POST['email'],
        $_POST['profession'],
        $_POST['company'],
        $_POST['expertise'],
        $_POST['linkedin_profile'],
        $_POST['status'],
        $_POST['password'],
        $_GET['id']
    ]);

    header("Location: members.php");
    exit();
}
$query = "SELECT * FROM members WHERE id = ?";
$stmt = $db->prepare($query);
$stmt->execute([$_GET['id']]);
$member = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<div class="form-container">
    <h2>Edit Member</h2>
    <form method="POST">
        <div class="form-group">
            <label>First Name</label>
            <input type="text" name="first_name" class="form-control" value="<?php echo htmlspecialchars($member['first_name']); ?>" required>
        </div>

        <div class="form-group">
            <label>Last Name</label>
            <input type="text" name="last_name" class="form-control" value="<?php echo htmlspecialchars($member['last_name']); ?>" required>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($member['email']); ?>" required>
        </div>

        <div class="form-group">
            <label>Profession</label>
            <input type="text" name="profession" class="form-control" value="<?php echo htmlspecialchars($member['profession']); ?>">
        </div>

        <div class="form-group">
            <label>Company</label>
            <input type="text" name="company" class="form-control"
                   value="<?php echo htmlspecialchars($member['company']); ?>">
        </div>

        <div class="form-group">
            <label>Expertise</label>
            <textarea name="expertise" class="form-control"><?php echo htmlspecialchars($member['expertise']); ?></textarea>
        </div>

        <div class="form-group">
            <label>LinkedIn Profile</label>
            <input type="url" name="linkedin_profile" class="form-control" value="<?php echo htmlspecialchars($member['linkedin_profile']); ?>">
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" class="form-control">
                <option value="admin">Admin</option>
                <option value="mentor">Mentor</option>
                <option value="member">Member</option>
            </select>
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Update Member</button>
    </form>
</div>
<?php
include_once "includes/footer.php";
?>
