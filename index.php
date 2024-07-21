<?php include 'includes/db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Manager</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Custom styles for homepage */
        .hero-section {
            background-image: url('images/IMG1.png');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 150px 0;
            text-align: center;
        }

        .hero-section h2 {
            font-size: 3rem;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .hero-section p {
            font-size: 1.5rem;
            margin-bottom: 40px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .feature-box {
            text-align: center;
            margin-bottom: 30px;
        }

        .feature-icon {
            font-size: 4rem;
            margin-bottom: 20px;
            color: #007bff;
        }

        .feature-title {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .feature-description {
            font-size: 1rem;
        }

        .feature-box .btn {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <?php include 'includes/header.php'; ?>

    <div class="hero-section">
        <div class="container">
            <h2>.</h2>
            <p>.</p>
            
        </div>
    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4">
                <div class="feature-box">
                    <i class="fas fa-calendar-alt feature-icon"></i>
                    <h3 class="feature-title">Event Management</h3>
                    <p class="feature-description">Effortlessly create, manage, and track events at any time.</p>
                    <a href="create_event.php" class="btn btn-outline-primary">Create Event</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-box">
                    <i class="fas fa-users feature-icon"></i>
                    <h3 class="feature-title">Community Engagement</h3>
                    <p class="feature-description">Connect with a vibrant community of event organizers.</p>
                    <a href="https://www.instagram.com/dhullnidhi__19?igsh=MTIyenFscG84OG41YQ%3D%3D&utm_source=qr " class="btn btn-outline-primary">Join Community</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-box">
                    <i class="fas fa-map-marked-alt feature-icon"></i>
                    <h3 class="feature-title">Location-based Services</h3>
                    <p class="feature-description">Discover events near you with our location-based services.</p>
                    <a href="events.php" class="btn btn-outline-primary">Find Events</a>
                </div>
            </div>
        </div>
    </div>

   

    <!-- Bootstrap JavaScript and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php include 'includes/footer.php'; ?>
