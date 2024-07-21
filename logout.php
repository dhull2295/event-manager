<?php
session_start();

if (isset($_SESSION['user_id'])) {

    require_once './includes/header.php';
    session_unset();
    session_destroy();
    setcookie("username", "", time() - 3600, "/");
    setcookie("user_id", "", time() - 3600, "/");

    $msg = 'You have been SUCCESSFULLY logged out!!!';
    $success = true;

    echo '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Logout</title>
        <!-- Bootstrap CSS -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="position: fixed; top: 60px; right: 20px; z-index: 9999;">
            ' . $msg . '
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <script>
            setTimeout(function() {
                document.querySelector(".alert").style.display = "none";
                window.location.href = "index.php";
            }, 1500); // Adjust the timeout as needed
        </script>

        <!-- Bootstrap JS and dependencies -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
    </html>';
} else {

    setcookie("username", "", time() - 3600, "/");
    require_once './includes/header.php';
    $msg = 'Please LOGIN first!!!';
    $success = true;

    echo '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Logout</title>
        <!-- Bootstrap CSS -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="position: fixed; top: 60px; right: 20px; z-index: 9999;">
            ' . $msg . '
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <script>
            setTimeout(function() {
                document.querySelector(".alert").style.display = "none";
                window.location.href = "index.php";
            }, 1500); // Adjust the timeout as needed
        </script>

        <!-- Bootstrap JS and dependencies -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
    </html>';
    exit();
}