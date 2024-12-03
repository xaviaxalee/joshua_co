<?php
require 'connect.php';

$error = ''; // Initialize error variable

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['user_name']); // Adjusted to match form input name
    $email = trim($_POST['user_email']); // Adjusted to match form input name
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirmpassword']);

    // Validation
    if ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } elseif (strlen($password) < 6) {
        $error = "Password must be at least 6 characters.";
    } else {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Check if email already exists
        $stmt = $conn->prepare("SELECT COUNT(*) FROM subscribers WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($email_exists);
        $stmt->fetch();
        $stmt->close();

        if ($email_exists) {
            $error = "Email is already registered.";
        } else {
            // Insert new user
            $stmt = $conn->prepare("INSERT INTO subscribers (full_name, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $name, $email, $hashed_password);

            if ($stmt->execute()) {
                header("Location: login.php?signup=success");
                exit;
            } else {
                $error = "An error occurred. Please try again.";
            }

            $stmt->close();
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/form.css">
</head>
<body>
<div class="container-fluid d-flex justify-content-center align-items-center vh-100 bg-gradient">
    <div class="glass-form p-4">
        <div class="text-center">
            <img src="img/logo-black.png" alt="Logo" class="w-50 my-4">
        </div>

        <!-- Display Error Message -->
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger text-center"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form class="row g-3" action="" method="post" autocomplete="off">
            <div class="col-12">
                <label for="user_name" class="form-label">Full Name:</label>
                <input type="text" name="user_name" class="form-control" id="user_name" required>
            </div>
            <div class="col-12">
                <label for="user_email" class="form-label">Email:</label>
                <input type="email" name="user_email" class="form-control" id="user_email" required>
            </div>
            <div class="col-md-6">
                <label for="password" class="form-label">Password:</label>
                <input type="password" class="form-control" name="password" id="password" required>
            </div>
            <div class="col-md-6">
                <label for="confirmpassword" class="form-label">Confirm Password:</label>
                <input type="password" name="confirmpassword" class="form-control" id="confirmpassword" required>
            </div>
            <div class="col-12 text-center">
                <button type="submit" class="btn btn-primary w-100">Sign Up</button>
            </div>
            <div class="text-center">
                <a href="login.php" class="text-decoration-none text-primary">Already have an account? Login</a>
            </div>
        </form>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
