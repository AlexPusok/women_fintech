<?php
include_once "includes/header.php";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $database = new Database();
    $db = $database->getConnection();

    $query = "INSERT INTO jobs
        (title, description, company, location, skills, max_applicants, app_limit)
        VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = $db->prepare($query);

    $stmt->execute([
        $_POST['title'],
        $_POST['description'],
        $_POST['company'],
        $_POST['location'],
        $_POST['skills'],
        $_POST['max_applicants'],
        $_POST['app_limit']
    ]);

    // Redirect after successful job creation
    header("Location: jobs.php");
    exit();
}
?>
    <div class="form-container">
        <h2>Add Job</h2>
        <form method="POST">
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Description</label>
                <textarea name="description" class="form-control"></textarea>
            </div>

            <div class="form-group">
                <label>Company</label>
                <input type="text" name="company" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Location</label>
                <input type="text" name="location" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Skills</label>
                <textarea name="skills" class="form-control"></textarea>
            </div>

            <div class="form-group">
                <label>Max applicants</label>
                <input type="number" name="max_applicants" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Last Day to Apply</label>
                <input type="date" name="app_limit" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Add Job</button>
        </form>
    </div>
<?php
include_once "includes/footer.php";
?>