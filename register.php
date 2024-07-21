<?php
include 'includes/db.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$msg = '';
$success = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $phone_number=$_POST['phone_number'];

    // Check if user already exists
    $sql_check = "SELECT * FROM users WHERE email='$email'";
    $result_check = $conn->query($sql_check);

    if ($result_check->num_rows > 0) {
        $msg = "User with this email already exists.";
        $success = false;
    } else {
        $sql = "INSERT INTO users (username, email, password,phone_number) VALUES ('$username', '$email', '$password','$phone_number')";
        if ($conn->query($sql) === TRUE) {
            $msg = "Signup successful! Redirecting to home page...";
            $success = true;
            header('refresh:3;url=index.php');
        } else {
            $msg = "Error: " . $sql . "<br>" . $conn->error;
            $success = false;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
     
        .containers {
            max-width: 500px;
            padding: 30px;
            background: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            margin-left: auto;
            margin-right: auto;
           margin-top: 20px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body style="   background-image: url('./images/IMG1.png');">
    <?php include 'includes/header.php'; ?>

    <div class="containers">
        <h2>Register</h2>
        <hr>
        <?php if (!empty($msg)): ?>
            <div class="alert alert-<?php echo $success ? 'success' : 'danger'; ?> alert-dismissible fade show" role="alert">
                <?php echo $msg; ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        <form method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="username" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="email"  required>
            </div>
            <div class="form-group">
                <label for="Phone number">Phone Number</label>
                <input type="number" class="form-control" id="phone_number" name="phone_number" placeholder="Phone Number" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password"placeholder="password" required>
            </div>
            <hr>
            <button type="submit" class="btn btn-primary">Register</button>
            <hr>
            <p>Already have account?<a href="./login.php">Please Login</a></p>
        </form>
    </div>

    <?php include 'includes/footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
