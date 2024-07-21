<?php
include 'includes/db.php';
session_start();

$notification = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $email;
            $_SESSION['user_name'] = $user['username'];
            
            $notification = 'Login successful! Redirecting to home page...';
            $success = true;
        } else {
            $notification = 'Invalid password. Please try again.';
            $success = false;
        }
    } else {
        $notification = 'No user found with that email. Please try again.';
        $success = false;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
   
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
      
      
        .containers {
         
           
            max-width: 500px;
            padding: 30px;
            background: white;
            box-shadow: 2px 3px 10px rgba(0, 0, 0, 0.5);
            border-radius: 10px;
            margin-left: auto;
            margin-right: auto;
           margin-top: 50px;
            margin-bottom: 50px;
        }
    </style>
</head>
<body style="   background-image: url('./images/IMG1.png');">
    <?php include 'includes/header.php'; ?>

    <div class="containers login-container"  >
        <h2 class="text-center">Login</h2>
        <hr>
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
                        window.location.href = 'index.php';
                    }, 3000); // Adjust the timeout as needed
                </script>
            <?php else: ?>
                <script>
                    setTimeout(function() {
                        window.location.href = 'login.php';
                    }, 3000); // Adjust the timeout as needed
                </script>
            <?php endif; ?>
        <?php endif; ?>
        <form method="post">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="email"  required>
                <sub><i>We will never share your info with others</i></sub>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="password"  required>
            </div>
            <hr>
            <button type="submit" class="btn btn-primary btn-block">Login</button>
            <hr>
            <a href="./request_reset.php">Forget Password</a>
        </form>

    </div>

    <?php include 'includes/footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
