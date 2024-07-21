<?php
include 'includes/db.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT events.*, users.username FROM events JOIN users ON events.created_by = users.username ORDER BY events.date DESC";
$result = $conn->query($sql);

if ($result === false) {
    echo "Error: " . $conn->error;
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Custom styles for events page */
        .card {
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 2px 3px 10px rgba(0, 0, 0, 0.5);
        }

        .card-img-top {
            height: 200px;
            object-fit: cover;
        }

        .card-title {
            font-weight: bold;
            color: #007bff;
        }

        .card-text {
            color: #555;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        
        .container {
            margin-top: 0px;
        }

        .event-header {
            text-align: center;
            margin-bottom: 40px;
        }

        @media (max-width: 768px) {
            .card {
                margin-bottom: 20px;
            }
        }
    </style>
</head>
<body style="background-image: url('./images/IMG3.png');">
    <?php include 'includes/header.php'; ?>

    <div class="container">
        <div class="event-header">
            <h1 style="color: 	#00008B;">Events</h1>
            <p style="color: 	#00008B;">Discover and participate in exciting events!</p>
        </div>
        <div class="row">
            <?php if ($result->num_rows > 0) {
                while ($event = $result->fetch_assoc()) { ?>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="<?php echo $event['image']; ?>" class="card-img-top" alt="<?php echo $event['title']; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $event['title']; ?></h5>
                            <p class="card-text"><?php echo $event['description']; ?></p>
                            <p class="card-text"><small class="text-muted">Created by <?php echo $event['username']; ?></small></p>
                            <a href="event.php?id=<?php echo $event['id']; ?>" class="btn btn-primary">View Event</a>
                        </div>
                    </div>
                </div>
            <?php } 
            } else {
                echo "<h1 style='padding: 100px;'>No events found.</h1>";

            } ?>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>

    <!-- Bootstrap JavaScript and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
