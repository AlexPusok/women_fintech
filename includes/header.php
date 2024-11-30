<?php
require 'config/database.php';
session_start();
$database = new Database();
$db = $database->getConnection();
$notifications = [];
if(isset($_SESSION['user'])){
    $userId = $_SESSION['user']['id']; // Assuming 'id' is stored in session
    $query = "SELECT pfp FROM members WHERE id = :id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

$profilePic = $user['pfp'] ?? 'resources/default_profile_pic.jpg';

    $notificationsQuery = "SELECT id, message, read_status, created_at FROM notifications WHERE member_id = :member_id AND read_status = 0 ORDER BY created_at DESC LIMIT 10";

    $notificationsStmt = $db->prepare($notificationsQuery);
    $notificationsStmt->bindParam(':member_id', $userId, PDO::PARAM_INT);
    $notificationsStmt->execute();
    $notifications = $notificationsStmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $profilePic = 'resources/default_profile_pic.jpg';
}
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Women in FinTech</title>
    <link rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <img class="logo" src="logo.png" style="width: 50px; height: auto; border-radius: 50%; border: 5px solid #087cfc;">
        <a class="navbar-brand" href="<?php echo isset($_SESSION['user']) ? 'dashboard.php' : 'index.php'; ?>">Women in FinTech</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <?php if (isset($_SESSION['user'])): ?>

                    <?php if ($_SESSION['user']['status'] === 'admin' || $_SESSION['user']['status'] === 'mentor'): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="statistics.php">Statistics</a>
                        </li>
                    <?php endif; ?>
                    <?php if ($_SESSION['user']['status'] === 'admin'): ?> <!-- asa ii un ex de cum limitezi la o singura categorie -->
                        <li class="nav-item">
                            <a class="nav-link" href="members.php">Members</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="add_member.php">Add Member</a>
                        </li>
                    <li class="nav-item">
                        <a class="nav-link" href="create_event.php">Create Event</a>
                    </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link" href="events.php">Events</a>
                    </li>

                <?php endif; ?>
            </ul>
        </div>
        <input onclick="darkMode()" id="darkButton" class="btn btn-primary" type="button" value="Toggle Dark Mode">
        <div class="dropdown">
            <img class="pfp dropdown-toggle" id="notificationBell" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                 src="resources/bell.png" style="width: 50px; height: 50px; border-radius: 50%; border: 5px solid #087cfc; cursor: pointer;">
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="notificationBell">
                <h6 class="dropdown-header">Notifications</h6>
                <?php if (!empty($notifications)): ?>
                    <?php foreach ($notifications as $notification): ?>
                        <div class="dropdown-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong><?php echo htmlspecialchars($notification['message']); ?></strong>
                                <small class="text-secondary d-block"><?php echo date('d M Y, H:i', strtotime($notification['created_at'])); ?></small>
                            </div>
                            <form method="POST" action="mark_notification_read.php" style="margin: 0;">
                                <input type="hidden" name="id" value="<?php echo $notification['id']; ?>">
                                <button type="submit" class="btn btn-sm btn-primary">Mark as Read</button>
                            </form>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <span class="dropdown-item text-muted">No notifications</span>
                <?php endif; ?>
                <div class="dropdown-divider"></div>
            </div>
        </div>
        <?php if (isset($_SESSION['user'])): ?>
        <a href="edit_profile.php" style="padding-right: 3px">
            <img class="pfp" src="<?php echo htmlspecialchars($profilePic); ?>" style="width: 50px; height: 50px; border-radius: 50%; border: 5px solid #087cfc;">
        </a>
        <?php endif; ?>
        <div class="ml-auto">
            <?php if (isset($_SESSION['user'])): ?>
                <!-- Logout Button -->
                <a href="logout.php" class="btn btn-danger">Logout</a>
            <?php else: ?>
                <!-- Login Button -->
                <a href="login.php" class="btn btn-success">Login</a>
            <?php endif; ?>
    </div>
</nav>
<div class="container mt-4">
