<?php
include 'includes/db.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$notification = '';
$success = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $otp = $_POST['otp'];
    $new_password = $_POST['new_password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND reset_code = ?");
    $stmt->bind_param("ss", $email, $otp);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("UPDATE users SET password = ?, reset_code = NULL WHERE email = ?");
        $stmt->bind_param("ss", $hashed_password, $email);
        $stmt->execute();

        $notification = 'Your password has been reset successfully.';
        $success = true;
    } else {
        $notification = 'Invalid OTP or email. Please try again.';
        $success = false;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
       

       .containerspr {
           max-width: 500px;
           margin-top:auto;
           margin-bottom: 40px;
           margin-left: auto;
           margin-right: auto;
           background-color: rgba(255, 255, 255, 0.9);
           border-radius: 10px;
           padding: 30px;
           box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
       }

       h2 {
           text-align: center;
           color: #4a90e2;
           margin-bottom: 20px;
       }

       .alert {
           margin-bottom: 20px;
       }

       .form-group {
           margin-bottom: 15px;
       }

       .form-control {
           border-radius: 5px;
           padding: 10px;
           border: 1px solid #ddd;
       }

       .btn-primary {
           background-color: #4a90e2;
           border: none;
           border-radius: 5px;
           padding: 10px;
           transition: background-color 0.3s;
       }

       .btn-primary:hover {
           background-color: #9013fe;
       }

       .alert-dismissible .close {
           color: #000;
       }

       .alert-success {
           background-color: #d4edda;
           color: #155724;
       }

       .alert-danger {
           background-color: #f8d7da;
           color: #721c24;
       }

       .alert-dismissible .close {
           position: absolute;
           top: 0;
           right: 10px;
           padding: 0.75rem 1.25rem;
           color: inherit;
       }
   </style>
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <div class="containerspr" style="margin-top: 100px;">
        <h2>Reset Password</h2>
        <?php if (!empty($notification)): ?>
            <div class="alert alert-<?php echo $success ? 'success' : 'danger'; ?> alert-dismissible fade show" role="alert">
                <?php echo $notification; ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <?php if ($success): ?>
                <script>
                    setTimeout(function() {
                        window.location.href = 'index.php'; // Redirect to home page after 3 seconds
                    }, 3000); // Delay of 3 seconds
                </script>
            <?php endif; ?>

        <?php endif; ?>
        <form method="post">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label for="otp">OTP</label>
                <input type="text" class="form-control" id="otp" name="otp" placeholder="Enter OTP" required>
            </div>
            <div class="form-group">
                <label for="new_password">New Password</label>
                <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Enter new password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Reset Password</button>
        </form>
    </div>

    <?php include 'includes/footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
