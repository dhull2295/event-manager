<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'includes/db.php';

if (isset($_GET['event_id'])) {
    $event_id = $_GET['event_id']; 
    $email = $_SESSION['user_id'];
    
    $stmt = $conn->prepare("SELECT users.id FROM users JOIN events ON users.username = events.created_by WHERE events.id = ?");
    $stmt->bind_param("i", $event_id);

    $stmt->execute();
    $stmt->bind_result($user_id);
    $stmt->fetch();
    $stmt->close();  // Ensure the statement is closed before running a new query

    // Now that the first statement is closed, you can proceed with the next query
    $stmt = $conn->prepare("INSERT INTO rsvps (user_id, email, event_id) VALUES (?, ?, ?)");
    $stmt->bind_param("isi", $user_id, $email, $event_id);

    if ($stmt->execute() === TRUE) {
        header('Location: events.php');
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    header('Location: events.php');
    exit;
}
?>
