<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include 'includes/db.php';



if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if (isset($_GET['id'])) {
    $event_id = $_GET['id'];


    $sql = "SELECT events.*, users.username FROM events JOIN users ON events.created_by = users.username WHERE events.id = '$event_id'";
    $result = $conn->query($sql);
    $event = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Details</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .event-details {
            margin-top: 100px;
            background: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .event-image {
            max-height: 400px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .event-info p {
            margin: 5px 0;
        }

        .btn-rsvp {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-rsvp:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
    </style>
</head>
<body style="background-image: url('./images/IMG2.png'); background-size: cover;">
    <?php include 'includes/header.php'; ?>

    <div class="container event-details">
        <div class="row">
            <div class="col-md-8">
                <h2><?php echo $event['title']; ?></h2>
                
                <img src="<?php echo $event['image']; ?>" class="img-fluid event-image" alt="<?php echo $event['title']; ?>">
                <p><?php echo $event['description']; ?></p>
            </div>
            <div class="col-md-4 event-info">
                <h4>Event Information</h4>
                <p><strong>Date:</strong> <?php echo $event['date']; ?></p>
                <p><strong>Time:</strong> <?php echo $event['time']; ?></p>
                <p><strong>Location:</strong> <?php echo $event['location']; ?></p>
                <p><strong>Category:</strong> <?php echo $event['category']; ?></p>
                <p><small class="text-muted">Created by <?php echo $event['username']; ?></small></p>
                <a href="rsvp.php?event_id=<?php echo $event['id']; ?>" class="btn btn-primary btn-rsvp">RSVP</a>
            </div>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
