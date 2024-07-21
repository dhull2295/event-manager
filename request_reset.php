<?php
require 'vendor/autoload.php';
use Twilio\Rest\Client;
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
        $dotenv->load();

include 'includes/db.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$notification = '';
$success = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        $reset_code = rand(100000, 999999);

        $stmt = $conn->prepare("UPDATE users SET reset_code = ? WHERE email = ?");
        $stmt->bind_param("ss", $reset_code, $email);
        $stmt->execute();

        
        
       
      $sid = $_ENV['TWILIO_SID'];
    $token = $_ENV['TWILIO_AUTH_TOKEN'];
        $twilio_number = '+12247231522';
        $client = new Client($sid, $token);

        function formatPhoneNumber($phoneNumber) {
            $formattedNumber = preg_replace('/\D/', '', $phoneNumber);
            if (strlen($formattedNumber) == 10) {
                $formattedNumber = '+1' . $formattedNumber;
            } elseif (strlen($formattedNumber) == 11 && $formattedNumber[0] == '0') {
                $formattedNumber = '+1' . substr($formattedNumber, 1);
            }
            return $formattedNumber;
        }

        $formattedPhoneNumber = formatPhoneNumber($user['phone_number']);

        try {
            $client->messages->create(
                $formattedPhoneNumber, 
                [
                    'from' => $twilio_number,
                    'body' => "Your password reset code is: $reset_code"
                ]
            );

            $notification = 'An OTP has been sent to your phone number.Redirecting to Update page.........';
            $success = true;
        } catch (\Twilio\Exceptions\RestException $e) {
            $notification = 'Failed to send OTP. Error: ' . $e->getMessage();
            $success = false;
        }
    } else {
        $notification = 'No account found with that email address.';
        $success = false;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Password Reset</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* General Styles */
       

        /* Container Styles */
        .containersp {
            max-width: 500px;
            min-height: 300px;
            margin-top: 55px;
            margin-bottom: 60px;
            margin-left: auto;
            margin-right: auto;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            padding: 70px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #2575fc;
            margin-bottom: 100px;
            
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
            
            background-color: #2575fc;
            border: none;
            border-radius: 5px;
            padding: 10px;
            transition: background-color 0.3s;
        }

        .btn-primary:hover {
            background-color: #6a11cb;
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
   
    <div class="containersp" style="margin-top: 100px;">
        <h2>Request Password Reset</h2>
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
                        window.location.href = 'reset_password.php';
                    }, 3000); // Redirect after 3 seconds
                </script>
            <?php endif; ?>

        <?php endif; ?>
        <form method="post">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Request Reset</button>
        </form>
    </div>

    <?php include 'includes/footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
