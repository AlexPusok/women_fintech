<?php
include_once "includes/header.php"; // Includes the header section

// Fetch upcoming events (events that are yet to happen)
$query_upcoming = "SELECT id, title, description, event_date, location, event_type, max_participants FROM events WHERE event_date >= NOW() ORDER BY event_date ASC";
$stmt_upcoming = $db->prepare($query_upcoming);
$stmt_upcoming->execute();
$events_upcoming = $stmt_upcoming->fetchAll(PDO::FETCH_ASSOC);

// Fetch past events (events that happened within the past month)
$query_past = "SELECT id, title, description, event_date, location, event_type, max_participants FROM events WHERE event_date < NOW() AND event_date >= DATE_SUB(NOW(), INTERVAL 1 MONTH) ORDER BY event_date DESC";
$stmt_past = $db->prepare($query_past);
$stmt_past->execute();
$events_past = $stmt_past->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="jumbotron">
    <h1 class="display-4">Upcoming Events</h1>
    <p class="lead">Join our exciting events designed to connect and empower women in the FinTech space.</p>
    <hr class="my-4">
    <p>Register for workshops, networking sessions, conferences, and more!</p>
</div>

<!-- Upcoming Events Section -->
<div class="container mt-4">
    <h2 class="text-center mb-4">Upcoming Events</h2>
    <?php if (!empty($events_upcoming)): ?>
        <div class="row">
            <?php foreach ($events_upcoming as $event): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 d-flex flex-column">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?php echo htmlspecialchars($event['title']); ?></h5>
                            <p class="card-text">
                                <strong>Date:</strong> <?php echo date('d M Y, H:i', strtotime($event['event_date'])); ?><br>
                                <strong>Location:</strong> <?php echo htmlspecialchars($event['location']); ?><br>
                                <strong>Type:</strong> <?php echo ucfirst($event['event_type']); ?><br>
                                <strong>Max Participants:</strong> <?php echo $event['max_participants']; ?>
                            </p>
                            <p class="card-text">
                                <?php echo nl2br(htmlspecialchars(substr($event['description'], 0, 100))); ?>...
                            </p>
                            <div class="mt-auto">
                                <a href="event_details.php?id=<?php echo $event['id']; ?>" class="btn btn-primary btn-block">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p class="text-center">No upcoming events at the moment. Please check back later.</p>
    <?php endif; ?>
</div>

<!-- Past Events Section -->
<div class="container mt-4">
    <h2 class="text-center mb-4">Past Events (Last Month)</h2>
    <?php if (!empty($events_past)): ?>
        <div class="row">
            <?php foreach ($events_past as $event): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 d-flex flex-column">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?php echo htmlspecialchars($event['title']); ?></h5>
                            <p class="card-text">
                                <strong>Date:</strong> <?php echo date('d M Y, H:i', strtotime($event['event_date'])); ?><br>
                                <strong>Location:</strong> <?php echo htmlspecialchars($event['location']); ?><br>
                                <strong>Type:</strong> <?php echo ucfirst($event['event_type']); ?><br>
                                <strong>Max Participants:</strong> <?php echo $event['max_participants']; ?>
                            </p>
                            <p class="card-text">
                                <?php echo nl2br(htmlspecialchars(substr($event['description'], 0, 100))); ?>...
                            </p>
                            <div class="mt-auto">
                                <a href="event_details.php?id=<?php echo $event['id']; ?>" class="btn btn-primary btn-block">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p class="text-center">No past events in the last month. Please check back later.</p>
    <?php endif; ?>
</div>

<?php
include_once "includes/footer.php"; // Includes the footer section
?>
