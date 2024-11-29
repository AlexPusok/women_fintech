<?php
require 'config/database.php';
session_start();

if (isset($_SESSION['user']) && isset($_GET['id'])) {
    $notificationId = intval($_GET['id']);
    $userId = $_SESSION['user']['id']; // Ensure the notification belongs to the logged-in user

    $database = new Database();
    $db = $database->getConnection();

    $query = "UPDATE notifications SET read_status = 1 WHERE id = :id AND member_id = :member_id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':id', $notificationId, PDO::PARAM_INT);
    $stmt->bindParam(':member_id', $userId, PDO::PARAM_INT);

    if ($stmt->execute()) {
        // Success - redirect back to the original page
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {
        // Error - handle as needed
        echo "Error marking notification as read.";
    }
} else {
    // If unauthorized or no ID provided, redirect to home
    header('Location: index.php');
    exit;
}
