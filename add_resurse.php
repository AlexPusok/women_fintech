<?php
include_once "includes/header.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Directory to save the uploaded files
    $uploadDir = 'resources/resurse_downloadabile/';

    // Check if the file was uploaded without errors
    if (isset($_FILES['resource_file']) && $_FILES['resource_file']['error'] == UPLOAD_ERR_OK) {
        $fileName = basename($_FILES['resource_file']['name']);
        $targetFilePath = $uploadDir . $fileName;

        // Validate file type if necessary
        $allowedTypes = ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'png', 'jpg', 'jpeg', 'zip', 'rar'];
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        if (in_array(strtolower($fileType), $allowedTypes)) {
            if (move_uploaded_file($_FILES['resource_file']['tmp_name'], $targetFilePath)) {
                // Redirect to resurse_downloadabile.php after successful upload
                header("Location: resurse_downloadabile.php?success=1");
                exit();
            } else {
                echo "<p class='text-danger'>Error moving the uploaded file.</p>";
            }
        } else {
            echo "<p class='text-danger'>Invalid file type. Allowed types: " . implode(', ', $allowedTypes) . "</p>";
        }
    } else {
        echo "<p class='text-danger'>Error uploading the file. Please try again.</p>";
    }

}
?>

    <div class="form-container">
        <h2>Add Resource</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label>Choose a file</label>
                <input type="file" name="resource_file" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Upload Resource</button>
        </form>
    </div>

<?php
include_once "includes/footer.php";
?>