<?php
include_once "includes/header.php"; // Include header
include_once "config/database.php"; // Database connection

// Validate and fetch mentor_id and member_id from query parameters
$mentor_id = $_GET['mentor_id'] ?? null;
$member_id = $_GET['member_id'] ?? null;

if (!$mentor_id || !$member_id) {
    echo "<div class='alert alert-danger'>Invalid mentorship details.</div>";
    exit;
}

// Fetch mentorship details
$query = "
    SELECT 
        mm.id AS match_id,
        mm.created_at AS match_date,
        mm.progress,
        m1.first_name AS mentor_first, m1.last_name AS mentor_last, m1.expertise,
        m2.first_name AS member_first, m2.last_name AS member_last
    FROM mentorship_matches mm
    JOIN members m1 ON mm.mentor_id = m1.id
    JOIN members m2 ON mm.member_id = m2.id
    WHERE mm.mentor_id = :mentor_id AND mm.member_id = :member_id
";
$stmt = $db->prepare($query);
$stmt->execute([':mentor_id' => $mentor_id, ':member_id' => $member_id]);
$mentorship = $stmt->fetch(PDO::FETCH_ASSOC);

// Check if mentorship exists
if (!$mentorship) {
    echo "<div class='alert alert-danger'>Mentorship not found.</div>";
    exit;
}

// Check if the user is authorized to view the mentorship
if (
    $_SESSION['user']['status'] !== 'admin' &&
    $_SESSION['user']['id'] != $mentor_id &&
    $_SESSION['user']['id'] != $member_id
) {
    echo "<div class='alert alert-danger'>You are not authorized to view this mentorship.</div>";
    exit;
}

// Handle progress update (only for mentor or admin)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['progress'])) {
    $new_progress = $_POST['progress'];

    // Validate the progress value
    $valid_progress = ['beginner', 'intermediate', 'advanced', 'complete'];
    if (in_array($new_progress, $valid_progress)) {
        // Update progress in the database
        $update_query = "UPDATE mentorship_matches SET progress = :progress WHERE id = :match_id";
        $stmt_update = $db->prepare($update_query);
        $stmt_update->execute([':progress' => $new_progress, ':match_id' => $mentorship['match_id']]);
        $message = "<div class='alert alert-success'>Progress updated successfully.</div>";
    } else {
        $message = "<div class='alert alert-danger'>Invalid progress value.</div>";
    }
}

// Handle session scheduling form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['session_date'], $_POST['location'], $_POST['notes'])) {
    $session_date = $_POST['session_date'];
    $location = $_POST['location'];
    $notes = $_POST['notes'];

    $query_insert = "
        INSERT INTO mentorship_sessions (mentor_id, member_id, session_date, location, notes)
        VALUES (:mentor_id, :member_id, :session_date, :location, :notes)
    ";
    $stmt_insert = $db->prepare($query_insert);
    $stmt_insert->execute([
        ':mentor_id' => $mentor_id,
        ':member_id' => $member_id,
        ':session_date' => $session_date,
        ':location' => $location,
        ':notes' => $notes,
    ]);

    echo "<div class='alert alert-success'>Mentoring session scheduled successfully!</div>";
}

// Handle feedback form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['feedback'], $_POST['session_id'])) {
    $feedback = $_POST['feedback'];
    $session_id = $_POST['session_id'];

    // Insert feedback into the database
    $query_feedback = "
        INSERT INTO feedback (session_id, feedback)
        VALUES (:session_id, :feedback)
    ";
    $stmt_feedback = $db->prepare($query_feedback);
    $stmt_feedback->execute([':session_id' => $session_id, ':feedback' => $feedback]);

    echo "<div class='alert alert-success'>Feedback submitted successfully!</div>";
}

// Fetch scheduled sessions
$query_sessions = "
    SELECT id, session_date, location, notes, created_at
    FROM mentorship_sessions
    WHERE mentor_id = :mentor_id AND member_id = :member_id
    AND session_date > NOW()  -- Only show future sessions
    ORDER BY session_date ASC
";
$stmt_sessions = $db->prepare($query_sessions);
$stmt_sessions->execute([':mentor_id' => $mentor_id, ':member_id' => $member_id]);
$sessions = $stmt_sessions->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container mt-4">
    <h2>Mentorship Details</h2>
    <div class="card mb-4">
        <div class="card-body">
            <h5>Mentor</h5>
            <p>Name: <?php echo htmlspecialchars($mentorship['mentor_first'] . " " . $mentorship['mentor_last']); ?></p>
            <p>Expertise: <?php echo htmlspecialchars($mentorship['expertise']); ?></p>

            <h5>Member</h5>
            <p>Name: <?php echo htmlspecialchars($mentorship['member_first'] . " " . $mentorship['member_last']); ?></p>

            <h5>Match Details</h5>
            <p>Date Created: <?php echo htmlspecialchars($mentorship['match_date']); ?></p>

            <!-- Display Progress -->
            <h5>Progress</h5>
            <p>Current Progress: <?php echo htmlspecialchars($mentorship['progress']); ?></p>

            <?php if ($_SESSION['user']['status'] === 'mentor' || $_SESSION['user']['status'] === 'admin'): ?>
                <!-- Form to update progress -->
                <form method="POST" action="" class="mt-3">
                    <div class="mb-3">
                        <label for="progress" class="form-label">Update Progress</label>
                        <select name="progress" id="progress" class="form-select" required>
                            <option value="beginner" <?php echo $mentorship['progress'] == 'beginner' ? 'selected' : ''; ?>>Beginner</option>
                            <option value="intermediate" <?php echo $mentorship['progress'] == 'intermediate' ? 'selected' : ''; ?>>Intermediate</option>
                            <option value="advanced" <?php echo $mentorship['progress'] == 'advanced' ? 'selected' : ''; ?>>Advanced</option>
                            <option value="complete" <?php echo $mentorship['progress'] == 'complete' ? 'selected' : ''; ?>>Complete</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Progress</button>
                </form>
            <?php endif; ?>

        </div>
    </div>

    <!-- Schedule a New Session -->
    <?php if ($_SESSION['user']['id'] == $mentor_id || $_SESSION['user']['status'] === 'admin'): ?>
        <div class="card mb-4">
            <div class="card-body">
                <h5>Schedule a Mentoring Session</h5>
                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="session_date" class="form-label">Session Date</label>
                        <input type="datetime-local" name="session_date" id="session_date" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="location" class="form-label">Location</label>
                        <input type="text" name="location" id="location" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="notes" class="form-label">Notes</label>
                        <textarea name="notes" id="notes" class="form-control" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Schedule Session</button>
                </form>
            </div>
        </div>
    <?php endif; ?>

    <!-- Display Scheduled Sessions -->
    <h5>Scheduled Mentoring Sessions</h5>
    <?php if ($sessions): ?>
        <ul class="list-group">
            <?php foreach ($sessions as $session): ?>
                <li class="list-group-item">
                    <strong>Date:</strong> <?php echo htmlspecialchars($session['session_date']); ?><br>
                    <strong>Location:</strong> <?php echo htmlspecialchars($session['location']); ?><br>
                    <strong>Notes:</strong> <?php echo htmlspecialchars($session['notes']); ?><br>
                    <small>Created At: <?php echo htmlspecialchars($session['created_at']); ?></small>

                    <!-- Display Feedback for this session if exists -->
                    <?php
                    $query_feedback = "SELECT feedback FROM feedback WHERE session_id = :session_id";
                    $stmt_feedback = $db->prepare($query_feedback);
                    $stmt_feedback->execute([':session_id' => $session['id']]);
                    $feedback = $stmt_feedback->fetch(PDO::FETCH_ASSOC);
                    if ($feedback):
                        ?>
                        <div class="mt-3">
                            <strong>Feedback:</strong>
                            <p><?php echo htmlspecialchars($feedback['feedback']); ?></p>
                        </div>
                    <?php endif; ?>

                    <!-- Feedback Form -->
                    <?php if ($_SESSION['user']['id'] == $member_id && !$feedback): ?>
                        <form method="POST" action="" class="mt-3">
                            <input type="hidden" name="session_id" value="<?php echo $session['id']; ?>">
                            <div class="mb-3">
                                <label for="feedback" class="form-label">Submit Feedback</label>
                                <textarea name="feedback" id="feedback" class="form-control" rows="3" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit Feedback</button>
                        </form>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No sessions scheduled yet.</p>
    <?php endif; ?>
</div>

<?php include_once "includes/footer.php"; // Include footer ?>
