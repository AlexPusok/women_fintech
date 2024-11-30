<?php
require 'config/database.php';
session_start();

if (isset($_SESSION['user']) && isset($_POST['id'])) {
    $notificationId = intval($_POST['id']);
    $userId = $_SESSION['user']['id']; // Ensure the notification belongs to the logged-in user

    $database = new Database();
    $db = $database->getConnection();

    $query = "UPDATE notifications SET read_status = 1 WHERE id = :id AND member_id = :member_id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':id', $notificationId, PDO::PARAM_INT);
    $stmt->bindParam(':member_id', $userId, PDO::PARAM_INT);

    if ($stmt->execute()) {
        // Redirect back to the previous page or refresh
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    } else {
        echo "Failed to mark the notification as read.";
    }
} else {
    // Redirect to home if unauthorized access
    header('Location: index.php');
    exit;
}
