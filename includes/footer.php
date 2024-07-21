<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    .footer {
        background-color: #343a40;
        color: #ffffff;
        padding-top: 2rem;
        padding-bottom: 2rem;
    }

    .footer h5 {
        font-size: 1.2rem;
        margin-bottom: 1rem;
    }

    .footer p {
        margin: 0.5rem 0;
    }

    .footer a {
        text-decoration: none;
        color: #ffffff;
    }

    .footer a:hover {
        color: #007bff;
    }

    .footer .list-unstyled {
        padding-left: 0;
        list-style: none;
    }

    .footer .list-unstyled li {
        margin-bottom: 0.5rem;
    }

    .footer .social-links img {
        width: 32px;
        height: 32px;
        margin-right: 10px;
        transition: transform 0.2s ease-in-out;
    }

    .footer .social-links img:hover {
        transform: scale(1.1);
    }

    .footer-brand {
        font-weight: bold;
        font-size: 1.2rem;
    }
</style>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<footer class="footer mt-auto py-5 bg-dark text-light">

    <div class="container text-center">
        <div class="row">
            <div class="col-md-3 mb-4">
                <h5>Event Manager</h5>
                <p>Your go-to platform for managing all your events seamlessly. Join us and explore the best ways to organize, promote, and manage your events.</p>
                <p>&copy; <?php echo date('Y'); ?></p>
            </div>
            <div class="col-md-3 mb-4">
                <h5>Quick Links</h5>
                <ul class="list-unstyled">
                    <li><a href="home.php" class="text-light">Home</a></li>
                   
                </ul>
            </div>
            <div class="col-md-3 mb-4">
                <h5>Resources</h5>
                <ul class="list-unstyled">
                    <li><a href="events.php" class="text-light">Blog</a></li>
                    <li><a href="mailto:nidhi03@algomau.ca">Send Email</a></li>
                   
                    
                </ul>
            </div>
            <div class="col-md-3 mb-4">
                <h5>Follow Us</h5>
                <div class="social-links">
                    <a href="https://www.facebook.com" target="_blank">
                        <img src="./images/facebook.png" alt="Facebook">
                    </a>
                 
                    <a href="https://www.instagram.com" target="_blank">
                        <img src="./images/instagram.svg.webp" alt="Instagram">
                    </a>
                   
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mt-3">
                <p class="m-0 text-center">
                    <a class="footer-brand text-light" href="../index.php">Event Manager</a>
                    &copy; <?php echo date('Y'); ?>. All Rights Reserved.
                </p>
            </div>
        </div>
    </div>
</footer>

<!-- Add FontAwesome for social media icons -->
<script src="https://kit.fontawesome.com/a076d05399.js"></script>

<!-- Add some custom CSS for better styling -->
</body>
</html>
