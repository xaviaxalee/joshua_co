<?php
include("connect.php");

session_start();

if(isset($_SESSION['user_id'])) {
    header("Location: dashboard/dashboard.php");
    exit();
}

if(isset($_POST["submit"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $query = "SELECT * FROM subscribers WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if(password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['user_id'];
            header("Location: dashboard/dashboard.php");
            exit();
        } else {
            echo "<script>alert('Invalid password');</script>";
        }
    } else {
        echo "<script>alert('Email not found');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/form.css">
</head>
<body>
<div class="container my-5 d-flex justify-content-center align-items-center vh-100">
    <div class="glass-form p-4">
        <div class="text-center">
            <img src="img/logo-black.png" alt="Logo" class="mb-4 w-50">
        </div>
        <form class="row g-3" action="" method="post" autocomplete="off">
            <div class="col-12">
                <label for="email" class="form-label">Email:</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="col-12">
                <label for="password" class="form-label">Password:</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <div class="col-12">
                <button type="submit" name="submit" class="btn btn-primary w-100">Login</button>
            </div>
            <div class="col-12 text-center">
                <a href="signup.php" class="text-decoration-none text-primary">Don't have an account? Sign up</a>
            </div>
        </form>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>