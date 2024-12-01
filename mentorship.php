<?php
include_once "includes/header.php"; // Include header
include_once "config/database.php"; // Database connection

// Fetch relevant data (mentors, members, matches, requests)
$query_mentors = "SELECT id, first_name, last_name, expertise FROM members WHERE status = 'mentor'";
$mentors = $db->query($query_mentors)->fetchAll(PDO::FETCH_ASSOC);

$query_members = "SELECT id, first_name, last_name FROM members WHERE status = 'member'";
$members = $db->query($query_members)->fetchAll(PDO::FETCH_ASSOC);

$query_matches = "
    SELECT mm.mentor_id, mm.member_id, 
           m1.first_name AS mentor_first, m1.last_name AS mentor_last, 
           m2.first_name AS member_first, m2.last_name AS member_last
    FROM mentorship_matches mm
    JOIN members m1 ON mm.mentor_id = m1.id
    JOIN members m2 ON mm.member_id = m2.id
";

$matches = $db->query($query_matches)->fetchAll(PDO::FETCH_ASSOC);

// ===========================
// Handle Mentor Request (For Members)
// ===========================
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['mentor_request_id'])) {
    $mentor_id = $_POST['mentor_request_id'];
    $member_id = $_SESSION['user']['id']; // Logged-in member's ID

    // Check if request already exists
    $stmt_check = $db->prepare("SELECT 1 FROM mentorship_requests WHERE mentor_id = :mentor_id AND member_id = :member_id");
    $stmt_check->execute([':mentor_id' => $mentor_id, ':member_id' => $member_id]);

    if (!$stmt_check->rowCount()) {
        // Insert new request
        $stmt_insert = $db->prepare("INSERT INTO mentorship_requests (mentor_id, member_id) VALUES (:mentor_id, :member_id)");
        $stmt_insert->execute([':mentor_id' => $mentor_id, ':member_id' => $member_id]);
        $message = "<div class='alert alert-success'>Request sent successfully!</div>";
    } else {
        $message = "<div class='alert alert-warning'>You have already requested this mentor.</div>";
    }
}

// =====================
// Handle Manual Matching (For Admins)
// =====================
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['mentor_id'], $_POST['member_id'])) {
    $mentor_id = $_POST['mentor_id'];
    $member_id = $_POST['member_id'];

    // Check if match already exists
    $stmt_check = $db->prepare("SELECT 1 FROM mentorship_matches WHERE mentor_id = :mentor_id AND member_id = :member_id");
    $stmt_check->execute([':mentor_id' => $mentor_id, ':member_id' => $member_id]);

    if (!$stmt_check->rowCount()) {
        // Insert new match
        $stmt_insert = $db->prepare("INSERT INTO mentorship_matches (mentor_id, member_id) VALUES (:mentor_id, :member_id)");
        $stmt_insert->execute([':mentor_id' => $mentor_id, ':member_id' => $member_id]);
        $message = "<div class='alert alert-success'>Mentor and Member matched successfully!</div>";
    } else {
        $message = "<div class='alert alert-warning'>This mentor and member are already matched.</div>";
    }
}

// =====================
// Handle Request Responses (For Mentors)
// =====================
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['request_id'], $_POST['action'])) {
    $request_id = $_POST['request_id'];
    $action = $_POST['action'];

    if (in_array($action, ['accept', 'reject'])) {
        try {
            // Begin transaction
            $db->beginTransaction();

            // Update the mentorship_requests table
            $stmt_update = $db->prepare("UPDATE mentorship_requests SET status = :status WHERE id = :request_id");
            $stmt_update->execute([':status' => $action, ':request_id' => $request_id]);

            if ($action === 'accept') {
                // Fetch member_id and mentor_id from the mentorship_requests table
                $stmt_fetch = $db->prepare("SELECT member_id, mentor_id FROM mentorship_requests WHERE id = :request_id");
                $stmt_fetch->execute([':request_id' => $request_id]);
                $request = $stmt_fetch->fetch(PDO::FETCH_ASSOC);

                if ($request) {
                    // Insert into mentorship_matches table
                    $stmt_insert = $db->prepare("INSERT INTO mentorship_matches (mentor_id, member_id) VALUES (:mentor_id, :member_id)");
                    $stmt_insert->execute([
                        ':mentor_id' => $request['mentor_id'],
                        ':member_id' => $request['member_id'],
                    ]);
                }
            }

            // Commit transaction
            $db->commit();
            $message = "<div class='alert alert-success'>Request has been $action.</div>";
        } catch (Exception $e) {
            // Rollback transaction on failure
            $db->rollBack();
            error_log("Error handling mentorship request: " . $e->getMessage());
            $message = "<div class='alert alert-danger'>Failed to process the request. Please try again.</div>";
        }

        // Redirect to avoid resubmission
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
}


?>

<div class="container mt-4">
    <?php echo $message ?? ''; ?>

    <h2>Available Mentors</h2>
    <div class="row">
        <?php foreach ($mentors as $mentor): ?>
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5><?php echo htmlspecialchars($mentor['first_name'] . " " . $mentor['last_name']); ?></h5>
                        <p><strong>Expertise:</strong> <?php echo htmlspecialchars($mentor['expertise'] ?? 'N/A'); ?></p>
                        <?php if ($_SESSION['user']['status'] === 'member'): ?>
                            <form method="POST" action="">
                                <input type="hidden" name="mentor_request_id" value="<?php echo $mentor['id']; ?>">
                                <button type="submit" class="btn btn-primary mt-2">Request Mentorship</button>
                            </form>
                        <?php else: ?>
                            <p class="text-danger">Log in as a member to request mentorship.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- List Matched Mentor-Member Pairs -->
    <h2>Current Mentorship Matches</h2>
    <ul class="list-group mb-4">
        <?php foreach ($matches as $match): ?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
            <span>
                Mentor: <?php echo htmlspecialchars($match['mentor_first'] . " " . $match['mentor_last']); ?>
                | Member: <?php echo htmlspecialchars($match['member_first'] . " " . $match['member_last']); ?>
            </span>

                <?php
                // Check if the logged-in user is related to this match or is an admin
                if (
                    $_SESSION['user']['status'] === 'admin' ||
                    $_SESSION['user']['id'] == $match['mentor_id'] ||
                    $_SESSION['user']['id'] == $match['member_id']
                ): ?>
                    <a href="view_mentorship.php?mentor_id=<?php echo $match['mentor_id']; ?>&member_id=<?php echo $match['member_id']; ?>"
                       class="btn btn-info btn-sm">
                        View Mentorship
                    </a>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>



    <?php if ($_SESSION['user']['status'] === 'admin'): ?>
        <h2>Manual Mentor-Member Matching</h2>
        <form method="POST" action="" class="bg-light p-4 rounded shadow-sm">
            <div class="mb-3">
                <label for="mentor_id" class="form-label">Select Mentor:</label>
                <select id="mentor_id" name="mentor_id" class="form-select" required>
                    <option value="" disabled selected>Choose a Mentor</option>
                    <?php foreach ($mentors as $mentor): ?>
                        <option value="<?php echo $mentor['id']; ?>">
                            <?php echo htmlspecialchars($mentor['first_name'] . " " . $mentor['last_name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="member_id" class="form-label">Select Member:</label>
                <select id="member_id" name="member_id" class="form-select" required>
                    <option value="" disabled selected>Choose a Member</option>
                    <?php foreach ($members as $member): ?>
                        <option value="<?php echo $member['id']; ?>">
                            <?php echo htmlspecialchars($member['first_name'] . " " . $member['last_name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Match</button>
        </form>
    <?php endif; ?>

    <?php if ($_SESSION['user']['status'] === 'mentor'): ?>
        <h2>Mentorship Requests</h2>
        <?php
        $mentor_id = $_SESSION['user']['id'];
        $query_requests = "SELECT r.id AS request_id, m.first_name, m.last_name, r.status
                           FROM mentorship_requests r
                           JOIN members m ON r.member_id = m.id
                           WHERE r.mentor_id = :mentor_id AND r.status = 'pending'";
        $stmt_requests = $db->prepare($query_requests);
        $stmt_requests->execute([':mentor_id' => $mentor_id]);
        $requests = $stmt_requests->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <?php if ($requests): ?>
            <table class="table">
                <thead>
                <tr>
                    <th>Member</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($requests as $request): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($request['first_name'] . " " . $request['last_name']); ?></td>
                        <td><?php echo ucfirst($request['status']); ?></td>
                        <td>
                            <form method="POST" action="">
                                <input type="hidden" name="request_id" value="<?php echo $request['request_id']; ?>">
                                <button type="submit" name="action" value="accept" class="btn btn-success btn-sm">Accept</button>
                                <button type="submit" name="action" value="reject" class="btn btn-danger btn-sm">Reject</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No pending requests.</p>
        <?php endif; ?>
    <?php endif; ?>
</div>

<?php include_once "includes/footer.php"; // Include footer ?>
