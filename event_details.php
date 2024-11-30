<?php
include_once "includes/header.php"; // Include the header

// Validate the event ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<div class='container mt-4'><p class='text-danger'>Invalid event ID.</p></div>";
    include_once "includes/footer.php";
    exit();
}

$eventId = $_GET['id'];

// Fetch event details
$query = "SELECT id, title, description, event_date, location, event_type, max_participants, 
                 (SELECT COUNT(*) FROM event_registrations WHERE event_id = events.id AND status = 'confirmed') AS registered_count 
          FROM events 
          WHERE id = :id";
$stmt = $db->prepare($query);
$stmt->bindParam(':id', $eventId, PDO::PARAM_INT);
$stmt->execute();
$event = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$event) {
    echo "<div class='container mt-4'><p class='text-danger'>Event not found.</p></div>";
    include_once "includes/footer.php";
    exit();
}

// Fetch reviews for the event
$query_reviews = "SELECT r.rating, r.review, r.created_at, m.first_name, m.last_name 
                  FROM reviews r 
                  INNER JOIN members m ON r.member_id = m.id 
                  WHERE r.event_id = :event_id";
$stmt_reviews = $db->prepare($query_reviews);
$stmt_reviews->bindParam(':event_id', $eventId, PDO::PARAM_INT);
$stmt_reviews->execute();
$reviews = $stmt_reviews->fetchAll(PDO::FETCH_ASSOC);

// Check if the logged-in member has already reviewed the event
$hasReviewed = false;
if (isset($_SESSION['user'])) {
    $memberId = $_SESSION['user']['id'];
    $check_review_query = "SELECT 1 FROM reviews WHERE event_id = :event_id AND member_id = :member_id LIMIT 1";
    $stmt_check_review = $db->prepare($check_review_query);
    $stmt_check_review->bindParam(':event_id', $eventId, PDO::PARAM_INT);
    $stmt_check_review->bindParam(':member_id', $memberId, PDO::PARAM_INT);
    $stmt_check_review->execute();
    if ($stmt_check_review->rowCount() > 0) {
        $hasReviewed = true;
    }
}

// Handle review submission for past events
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user']) && !$hasReviewed) {
    $rating = $_POST['rating'] ?? 0;
    $review = $_POST['review'] ?? '';

    // Check if the event is in the past
    if (strtotime($event['event_date']) < time() && $rating >= 1 && $rating <= 5) {
        $memberId = $_SESSION['user']['id'];

        // Insert the review
        $query_insert_review = "INSERT INTO reviews (event_id, member_id, rating, review) 
                                VALUES (:event_id, :member_id, :rating, :review)";
        $stmt_insert_review = $db->prepare($query_insert_review);
        $stmt_insert_review->bindParam(':event_id', $eventId, PDO::PARAM_INT);
        $stmt_insert_review->bindParam(':member_id', $memberId, PDO::PARAM_INT);
        $stmt_insert_review->bindParam(':rating', $rating, PDO::PARAM_INT);
        $stmt_insert_review->bindParam(':review', $review, PDO::PARAM_STR);

        if ($stmt_insert_review->execute()) {
            $message = "<div class='alert alert-success'>Thank you for your review!</div>";
        } else {
            $message = "<div class='alert alert-danger'>There was an issue submitting your review. Please try again later.</div>";
        }
    } else {
        $message = "<div class='alert alert-warning'>You can only leave a review for past events and your rating must be between 1 and 5.</div>";
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && $hasReviewed) {
    $message = "<div class='alert alert-warning'>You have already submitted a review for this event.</div>";
}

// Handle registration for upcoming events
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user'])) {
    $memberId = $_SESSION['user']['id'];

    // Check if the user is already registered for the event
    $check_registration_query = "SELECT 1 FROM event_registrations WHERE event_id = :event_id AND member_id = :member_id LIMIT 1";
    $stmt_check_registration = $db->prepare($check_registration_query);
    $stmt_check_registration->bindParam(':event_id', $eventId, PDO::PARAM_INT);
    $stmt_check_registration->bindParam(':member_id', $memberId, PDO::PARAM_INT);
    $stmt_check_registration->execute();

    if ($stmt_check_registration->rowCount() > 0) {
        $message = "<div class='alert alert-warning'>You are already registered for this event.</div>";
    } else {
        // Check if the event has space for more participants
        if ($event['registered_count'] < $event['max_participants']) {
            $query_register = "INSERT INTO event_registrations (member_id, event_id, status) 
                               VALUES (:member_id, :event_id, 'confirmed')";
            $stmt_register = $db->prepare($query_register);
            $stmt_register->bindParam(':member_id', $memberId, PDO::PARAM_INT);
            $stmt_register->bindParam(':event_id', $eventId, PDO::PARAM_INT);

            if ($stmt_register->execute()) {
                $message = "<div class='alert alert-success'>You have successfully registered for the event!</div>";
            } else {
                $message = "<div class='alert alert-danger'>There was an issue with your registration. Please try again later.</div>";
            }
        } else {
            $message = "<div class='alert alert-warning'>This event is already full.</div>";
        }
    }
}
// Handle unregistration for upcoming events
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'unregister' && isset($_SESSION['user'])) {
    $memberId = $_SESSION['user']['id'];

    // Check if the user is registered for the event
    $check_registration_query = "SELECT 1 FROM event_registrations WHERE event_id = :event_id AND member_id = :member_id LIMIT 1";
    $stmt_check_registration = $db->prepare($check_registration_query);
    $stmt_check_registration->bindParam(':event_id', $eventId, PDO::PARAM_INT);
    $stmt_check_registration->bindParam(':member_id', $memberId, PDO::PARAM_INT);
    $stmt_check_registration->execute();

    if ($stmt_check_registration->rowCount() > 0) {
        // Delete the registration
        $query_unregister = "DELETE FROM event_registrations WHERE event_id = :event_id AND member_id = :member_id";
        $stmt_unregister = $db->prepare($query_unregister);
        $stmt_unregister->bindParam(':event_id', $eventId, PDO::PARAM_INT);
        $stmt_unregister->bindParam(':member_id', $memberId, PDO::PARAM_INT);

        if ($stmt_unregister->execute()) {
            $message = "<div class='alert alert-success'>You have successfully unregistered from the event.</div>";
        } else {
            $message = "<div class='alert alert-danger'>There was an issue with your unregistration. Please try again later.</div>";
        }
    } else {
        $message = "<div class='alert alert-warning'>You are not registered for this event.</div>";
    }
}


?>

<div class="container mt-4">
    <?php echo $message ?? ''; ?>

    <div class="row">
        <div class="col-md-8">
            <h1 class="mb-4"><?php echo htmlspecialchars($event['title']); ?></h1>
            <p><strong>Type:</strong> <?php echo ucfirst($event['event_type']); ?></p>
            <p><strong>Date:</strong> <?php echo date('d M Y, H:i', strtotime($event['event_date'])); ?></p>
            <p><strong>Location:</strong> <?php echo htmlspecialchars($event['location']); ?></p>
            <p><strong>Max Participants:</strong> <?php echo $event['max_participants']; ?></p>
            <p><strong>Registered Participants:</strong> <?php echo $event['registered_count']; ?></p>
            <hr>
            <p><?php echo nl2br(htmlspecialchars($event['description'])); ?></p>
            <hr>

            <!-- Reviews Section -->
            <h3 class="mt-4">Reviews</h3>
            <?php if (!empty($reviews)): ?>
                <ul class="list-unstyled">
                    <?php foreach ($reviews as $review): ?>
                        <li class="border-bottom py-3">
                            <p><strong><?php echo htmlspecialchars($review['first_name']) . ' ' . htmlspecialchars($review['last_name']); ?></strong> - <?php echo date('d M Y', strtotime($review['created_at'])); ?></p>
                            <p><strong>Rating:</strong> <?php echo $review['rating']; ?> / 5</p>
                            <p><?php echo nl2br(htmlspecialchars($review['review'])); ?></p>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>No reviews yet for this event.</p>
            <?php endif; ?>

            <hr>

            <!-- Review Submission Form for Past Events -->
            <?php if (strtotime($event['event_date']) < time() && isset($_SESSION['user']) && !$hasReviewed): ?>
                <h3 class="mt-4">Leave a Review</h3>
                <form method="POST" action="" class="bg-light p-4 rounded shadow-sm">
                    <div class="form-group">
                        <label for="rating">Rating</label>
                        <select name="rating" id="rating" class="form-control" required>
                            <option value="">Select Rating</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                    <div class="form-group mt-3">
                        <label for="review">Review</label>
                        <textarea name="review" id="review" class="form-control" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Submit Review</button>
                </form>
            <?php elseif (strtotime($event['event_date']) < time() && $hasReviewed): ?>
                <p class="text-warning mt-3">You have already reviewed this event.</p>
            <?php elseif (strtotime($event['event_date']) > time()): ?>
                <p class="text-warning mt-3">You can only leave a review for past events.</p>
            <?php endif; ?>

            <hr>

            <!-- Registration Form for Upcoming Events -->
            <?php if (strtotime($event['event_date']) > time()): ?>
                <?php if (isset($_SESSION['user'])): ?>
                    <?php
                    // Check if the user is registered
                    $check_registration_query = "SELECT 1 FROM event_registrations WHERE event_id = :event_id AND member_id = :member_id LIMIT 1";
                    $stmt_check_registration = $db->prepare($check_registration_query);
                    $stmt_check_registration->bindParam(':event_id', $eventId, PDO::PARAM_INT);
                    $stmt_check_registration->bindParam(':member_id', $memberId, PDO::PARAM_INT);
                    $stmt_check_registration->execute();
                    $isRegistered = $stmt_check_registration->rowCount() > 0;
                    ?>

                    <?php if ($isRegistered): ?>
                        <h3>You are registered for this event</h3>
                        <form method="POST" action="" class="bg-light p-4 rounded shadow-sm">
                            <input type="hidden" name="action" value="unregister">
                            <button type="submit" class="btn btn-danger mt-3">Unregister</button>
                        </form>
                    <?php else: ?>
                        <h3>Register for this Event</h3>
                        <form method="POST" action="" class="bg-light p-4 rounded shadow-sm">
                            <input type="hidden" name="action" value="register">
                            <button type="submit" class="btn btn-primary mt-3">Register</button>
                        </form>
                    <?php endif; ?>
                <?php else: ?>
                    <p class="text-danger mt-3">Please <a href="login.php">log in</a> to register or unregister for this event.</p>
                <?php endif; ?>
            <?php else: ?>
                <p class="text-warning mt-3">Registration is closed for this event.</p>
            <?php endif; ?>

        </div>

        <div class="col-md-4">
            <!-- Sidebar (Optional) -->
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5>Event Details</h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li><strong>Event Date:</strong> <?php echo date('d M Y, H:i', strtotime($event['event_date'])); ?></li>
                        <li><strong>Location:</strong> <?php echo htmlspecialchars($event['location']); ?></li>
                        <li><strong>Max Participants:</strong> <?php echo $event['max_participants']; ?></li>
                        <li><strong>Registered Participants:</strong> <?php echo $event['registered_count']; ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once "includes/footer.php"; ?>
