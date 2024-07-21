<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

include 'includes/db.php';

$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];
$sql = "SELECT * FROM users WHERE email='$user_id'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

$sql_events = "SELECT * FROM events WHERE created_by='$user_name'";
$result_events = $conn->query($sql_events);

$sql_rsvps = "
    SELECT events.* 
    FROM rsvps 
    JOIN events ON rsvps.event_id = events.id 
    WHERE rsvps.email='$user_id'";
$result_rsvps = $conn->query($sql_rsvps);

// Fetch all RSVPs for the user's events
$sql_all_rsvps = "
    SELECT users.username, users.email, events.title 
    FROM rsvps 
    JOIN users ON rsvps.email = users.email 
    JOIN events ON rsvps.event_id = events.id 
    WHERE events.created_by='$user_name'";
$result_all_rsvps = $conn->query($sql_all_rsvps);

// Handle event deletion
if (isset($_POST['delete_event'])) {
    $event_id = $_POST['event_id'];
    $delete_sql = "DELETE FROM events WHERE id='$event_id'";
    $conn->query($delete_sql);
    header('Location: profile.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <div class="container" style="margin-top: 100px;">
        <h2>Profile</h2>
        <p><strong>Username:</strong> <?php echo $user['username']; ?></p>
        <p><strong>Email:</strong> <?php echo $user['email']; ?></p>

        <h3>Your Events</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Location</th>
                    <th>Category</th>
                    <th>Image</th>
                    <th>RSVPs</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($event = $result_events->fetch_assoc()) { 
                    // Fetch the RSVPs for each event
                    $event_id = $event['id'];
                    $sql_event_rsvps = "
                        SELECT users.username, users.email 
                        FROM rsvps 
                        JOIN users ON rsvps.email = users.email 
                        WHERE rsvps.event_id='$event_id'";
                    $result_event_rsvps = $conn->query($sql_event_rsvps);
                ?>
                    <tr>
                        <td><?php echo $event['title']; ?></td>
                        <td><?php echo $event['description']; ?></td>
                        <td><?php echo $event['date']; ?></td>
                        <td><?php echo $event['time']; ?></td>
                        <td><?php echo $event['location']; ?></td>
                        <td><?php echo $event['category']; ?></td>
                        <td><img src="<?php echo $event['image']; ?>" alt="<?php echo $event['title']; ?>" width="100"></td>
                        <td>
                            <?php if ($result_event_rsvps->num_rows > 0) { ?>
                                <ul>
                                    <?php while ($rsvp = $result_event_rsvps->fetch_assoc()) { ?>
                                        <li><?php echo $rsvp['username']; ?> (<?php echo $rsvp['email']; ?>)</li>
                                    <?php } ?>
                                </ul>
                            <?php } else { ?>
                                No RSVPs
                            <?php } ?>
                        </td>
                        <td>
                            <a href="event.php?id=<?php echo $event['id']; ?>" class="btn btn-primary">View</a>
                            <form method="post" style="display:inline;">
                                <input type="hidden" name="event_id" value="<?php echo $event['id']; ?>">
                                <button type="submit" name="delete_event" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <h3>Events You RSVP'd</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Location</th>
                    <th>Category</th>
                    <th>Image</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($event = $result_rsvps->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $event['title']; ?></td>
                        <td><?php echo $event['description']; ?></td>
                        <td><?php echo $event['date']; ?></td>
                        <td><?php echo $event['time']; ?></td>
                        <td><?php echo $event['location']; ?></td>
                        <td><?php echo $event['category']; ?></td>
                        <td><img src="<?php echo $event['image']; ?>" alt="<?php echo $event['title']; ?>" width="100"></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <h3>Users Who Responded to Your Events</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Event Title</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($rsvp = $result_all_rsvps->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $rsvp['username']; ?></td>
                        <td><?php echo $rsvp['email']; ?></td>
                        <td><?php echo $rsvp['title']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <?php include 'includes/footer.php'; ?>
</body>
</html>
