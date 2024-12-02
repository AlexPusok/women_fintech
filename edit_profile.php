<?php
include 'includes/header.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$database = new Database();
$db = $database->getConnection();
$userId = $_SESSION['user']['id'];

$query = "SELECT * FROM members WHERE id = :id";
$stmt = $db->prepare($query);
$stmt->bindParam(':id', $userId, PDO::PARAM_INT);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "User not found.";
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = trim($_POST['first_name']);
    $lastName = trim($_POST['last_name']);
    $email = trim($_POST['email']);
    $profession = trim($_POST['profession']);
    $company = trim($_POST['company']);
    $expertise = trim($_POST['expertise']);
    $linkedin_profile = trim($_POST['linkedin_profile']);
    $password = !empty($_POST['password']) ? password_hash(trim($_POST['password']), PASSWORD_DEFAULT) : $user['password'];


    $pfpPath = $user['pfp']; // Default to the existing picture
    if (isset($_FILES['pfp']) && $_FILES['pfp']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = __DIR__ . '/resources/';
        $uploadedFile = $_FILES['pfp'];
        $extension = pathinfo($uploadedFile['name'], PATHINFO_EXTENSION);
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array(strtolower($extension), $allowedExtensions)) {
            $newFileName = uniqid('pfp_', true) . '.' . $extension;
            $destination = $uploadDir . $newFileName;

            if (move_uploaded_file($uploadedFile['tmp_name'], $destination)) {
                $pfpPath = 'resources/' . $newFileName; // Save relative path to database
            } else {
                echo "<script>alert('Failed to upload profile picture.');</script>";
            }
        } else {
            echo "<script>alert('Invalid file type. Please upload a JPG, PNG, or GIF.');</script>";
        }
    }


    $updateQuery = "UPDATE members SET first_name = :first_name, last_name = :last_name, email = :email, 
                    profession = :profession, company = :company, expertise = :expertise, linkedin_profile = :linkedin_profile, password = :password, pfp = :pfp WHERE id = :id";
    $updateStmt = $db->prepare($updateQuery);
    $updateStmt->bindParam(':first_name', $firstName);
    $updateStmt->bindParam(':last_name', $lastName);
    $updateStmt->bindParam(':email', $email);
    $updateStmt->bindParam(':profession', $profession);
    $updateStmt->bindParam(':company', $company);
    $updateStmt->bindParam(':expertise', $expertise);
    $updateStmt->bindParam(':linkedin_profile', $linkedin_profile);
    $updateStmt->bindParam(':password', $password);
    $updateStmt->bindParam(':pfp', $pfpPath);
    $updateStmt->bindParam(':id', $userId, PDO::PARAM_INT);

    if ($updateStmt->execute()) {
        echo "<script>alert('Profile updated successfully.');</script>";
        header("Location: dashboard.php"); // Redirect to dashboard or another page
        exit;
    } else {
        echo "<script>alert('Failed to update profile.');</script>";
    }
}
?>
<div class="container">
    <h2>Edit Profile</h2>
    <form method="POST" action="edit_profile.php" enctype="multipart/form-data">
        <div class="form-group text-center">
            <label for="pfp">
                <img src="<?php echo htmlspecialchars($user['pfp'] ?? 'resources/default_profile_pic.jpg'); ?>" alt="Profile Picture" class="profile-pic" id="profilePicPreview" width="200" height="200">
            </label>
            <input type="file" id="pfp" name="pfp" class="hidden-input" accept="image/*" onchange="previewProfilePicture(event)">
        </div>
        <div class="form-group">
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" class="form-control" value="<?php echo htmlspecialchars($user['first_name']); ?>" required>
        </div>
        <div class="form-group">
            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" class="form-control" value="<?php echo htmlspecialchars($user['last_name']); ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" class="form-control" value="<?php echo htmlspecialchars($user['email']); ?>" required>
        </div>
        <div class="form-group">
            <label for="profession">Profession:</label>
            <input type="text" id="profession" name="profession" class="form-control" value="<?php echo htmlspecialchars($user['profession']); ?>">
        </div>
        <div class="form-group">
            <label for="company">Company:</label>
            <input type="text" id="company" name="company" class="form-control" value="<?php echo htmlspecialchars($user['company']); ?>">
        </div>
        <div class="form-group">
            <label for="expertise">Expertise:</label>
            <textarea id="expertise" name="expertise" class="form-control"><?php echo htmlspecialchars($user['expertise']); ?></textarea>
        </div>
        <div class="form-group">
            <label for="linkedin_profile">LinkedIn Profile:</label>
            <input type="text" id="linkedin_profile" name="linkedin_profile" class="form-control" value="<?php echo htmlspecialchars($user['linkedin_profile']); ?>">
        </div>
        <div class="form-group">
            <label for="password">Password (Leave blank to keep current):</label>
            <input type="password" id="password" name="password" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Save Changes</button>
        <a href="dashboard.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
<hr>

<script>
    function previewProfilePicture(event) {
        const reader = new FileReader();
        reader.onload = function () {
            document.getElementById('profilePicPreview').src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
<?php
include_once 'includes/footer.php';
?>