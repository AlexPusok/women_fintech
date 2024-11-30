<?php
include_once "includes/header.php"; // Include the header

// Check if the user is an admin
if (!isset($_SESSION['user']) || $_SESSION['user']['status'] !== 'admin') {
    echo "<div class='container mt-4'><p class='text-danger'>You do not have permission to access this page.</p></div>";
    include_once "includes/footer.php";
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize form inputs
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $event_date = $_POST['event_date'];
    $location = trim($_POST['location']);
    $event_type = $_POST['event_type'];
    $max_participants = $_POST['max_participants'];

    // Validate inputs
    $errors = [];
    if (empty($title)) {
        $errors[] = 'Event title is required.';
    }
    if (empty($description)) {
        $errors[] = 'Event description is required.';
    }
    if (empty($event_date) || !strtotime($event_date)) {
        $errors[] = 'Valid event date is required.';
    }
    if (empty($location)) {
        $errors[] = 'Event location is required.';
    }
    if (empty($event_type)) {
        $errors[] = 'Event type is required.';
    }
    if (empty($max_participants) || !is_numeric($max_participants) || $max_participants <= 0) {
        $errors[] = 'Maximum participants must be a positive number.';
    }

    // If no errors, insert the event into the database
    if (empty($errors)) {
        try {
            $query = "INSERT INTO events (title, description, event_date, location, event_type, max_participants) 
                      VALUES (:title, :description, :event_date, :location, :event_type, :max_participants)";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':title', $title, PDO::PARAM_STR);
            $stmt->bindParam(':description', $description, PDO::PARAM_STR);
            $stmt->bindParam(':event_date', $event_date, PDO::PARAM_STR);
            $stmt->bindParam(':location', $location, PDO::PARAM_STR);
            $stmt->bindParam(':event_type', $event_type, PDO::PARAM_STR);
            $stmt->bindParam(':max_participants', $max_participants, PDO::PARAM_INT);

            if ($stmt->execute()) {
                $message = "<div class='alert alert-success'>Event created successfully!</div>";
            } else {
                $message = "<div class='alert alert-danger'>There was an issue creating the event. Please try again later.</div>";
            }
        } catch (PDOException $e) {
            $message = "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>";
        }
    }
}

?>

<div class="container mt-4">
    <?php echo $message ?? ''; ?>

    <h2>Create New Event</h2>
    <form method="POST" action="" class="bg-light p-4 rounded shadow-sm">
        <div class="form-group">
            <label for="title">Event Title</label>
            <input type="text" id="title" name="title" class="form-control" value="<?php echo htmlspecialchars($title ?? '', ENT_QUOTES); ?>" required>
        </div>

        <div class="form-group">
            <label for="description">Event Description</label>
            <textarea id="description" name="description" class="form-control" rows="4" required><?php echo htmlspecialchars($description ?? '', ENT_QUOTES); ?></textarea>
        </div>

        <div class="form-group">
            <label for="event_date">Event Date</label>
            <input type="datetime-local" id="event_date" name="event_date" class="form-control" value="<?php echo htmlspecialchars($event_date ?? '', ENT_QUOTES); ?>" required>
        </div>

        <div class="form-group">
            <label for="location">Event Location</label>
            <input type="text" id="location" name="location" class="form-control" value="<?php echo htmlspecialchars($location ?? '', ENT_QUOTES); ?>" required>
        </div>

        <div class="form-group">
            <label for="event_type">Event Type</label>
            <select id="event_type" name="event_type" class="form-control" required>
                <option value="">Select Type</option>
                <option value="workshop" <?php echo (isset($event_type) && $event_type == 'workshop') ? 'selected' : ''; ?>>Workshop</option>
                <option value="seminar" <?php echo (isset($event_type) && $event_type == 'seminar') ? 'selected' : ''; ?>>Seminar</option>
                <option value="conference" <?php echo (isset($event_type) && $event_type == 'conference') ? 'selected' : ''; ?>>Conference</option>
                <option value="meeting" <?php echo (isset($event_type) && $event_type == 'meeting') ? 'selected' : ''; ?>>Meeting</option>
            </select>
        </div>

        <div class="form-group">
            <label for="max_participants">Max Participants</label>
            <input type="number" id="max_participants" name="max_participants" class="form-control" value="<?php echo htmlspecialchars($max_participants ?? '', ENT_QUOTES); ?>" required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Create Event</button>
    </form>
</div>

<?php
include_once "includes/footer.php"; // Include the footer
?>
