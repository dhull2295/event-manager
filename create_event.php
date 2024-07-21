<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}


include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $location = $_POST['location'];
    $category = $_POST['category'];
    $created_by = $_SESSION['user_name'];

    $image = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $image = 'images/' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $image);
    }

    $sql = "INSERT INTO events (title, description, date, time, location, category, image, created_by) VALUES ('$title', '$description', '$date', '$time', '$location', '$category', '$image', '$created_by')";
    if ($conn->query($sql) === TRUE) {
        header('Location: events.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Event</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
      
        
        .create-event-form {
            background: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            margin-top: 50px;
        }

        .create-event-form h2 {
            margin-bottom: 20px;
        }

        .create-event-form .form-group label {
            font-weight: bold;
        }

        .create-event-form .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .create-event-form .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }

        .create-event-form .form-control,
        .create-event-form .form-control-file {
            border-radius: 5px;
        }
    </style>
</head>
<body style="background-image: url('./images/IMG4.png');">
    <?php include 'includes/header.php'; ?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="create-event-form">
                    <h2>Create Event</h2>
                    <form method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="5" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="date" class="form-control" id="date" name="date" required>
                        </div>
                        <div class="form-group">
                            <label for="time">Time</label>
                            <input type="time" class="form-control" id="time" name="time" required>
                        </div>
                        <div class="form-group">
                            <label for="location">Location</label>
                            <input type="text" class="form-control" id="location" name="location" required>
                        </div>
                        <div class="form-group">
                            <label for="category">Category</label>
                            <input type="text" class="form-control" id="category" name="category" required>
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control-file" id="image" name="image">
                        </div>
                        <button type="submit" class="btn btn-primary">Create Event</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

