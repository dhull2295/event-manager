<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Manager</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Custom styles for navbar */
        body {
            padding-top: 70px; /* Ensure content below navbar */
            background-color: #f8f9fa; /* Light background color */
        }

        .navbar {
            background-color: #ffffff; /* Navbar background color */
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); /* Navbar box shadow */
            padding-top: 10px;
            padding-bottom: 10px;
        }

        .navbar-brand {
            font-weight: bold; /* Navbar brand font weight */
            color: #007bff !important; /* Navbar brand color */
            font-size: 1.5rem; /* Larger font size */
        }

        .navbar-toggler {
            border: none; /* Remove default border */
        }

        .navbar-nav .nav-item {
            margin-right: 15px; /* Space between navbar items */
        }

        .navbar-nav .nav-link {
            color: #333 !important; /* Navbar link color */
            font-weight: 500; /* Navbar link font weight */
            transition: all 0.3s ease; /* Transition for smooth hover effect */
        }

        .navbar-nav .nav-link:hover {
            color: #007bff !important; /* Hover color */
        }

        .profile-image {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            cursor: pointer;
            margin-left: 10px;
            object-fit: cover; /* Ensure circular shape */
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">Event Manager</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="events.php">Events</a>
                    </li>
                    <?php if (isset($_SESSION['user_id'])) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="create_event.php">Create Event</a>
                        </li>
                       
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Logout</a>
                        </li>
                        <li class="nav-item">
                            <img src="./images/user.png" alt="Profile Image" class="profile-image" onclick="viewProfile()">
                          
                        </li>
                    <?php } else { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="register.php">Register</a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>

    <script>
        function viewProfile() {
            <?php if (isset($_SESSION['user_id'])) { ?>
                window.location.href = 'profile.php';
            <?php } else { ?>
                window.location.href = 'login.php';
            <?php } ?>
        }
    </script>

    <!-- Bootstrap JavaScript and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
