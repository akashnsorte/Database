<?php
session_start();

include("db.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $query = "SELECT * FROM form WHERE email = '$email' LIMIT 1";
        $result = mysqli_query($con, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $user_data = mysqli_fetch_assoc($result);

            if (password_verify($password, $user_data['password'])) {
                header("location: index.php");
                die;
            } else {
                echo "<script type='text/javascript'> alert('Wrong Username or password')</script>";
            }
        } else {
            echo "<script type='text/javascript'> alert('Wrong Username or password')</script>";
        }
    } else {
        echo "<script type='text/javascript'> alert('Invalid email format')</script>";
    }
}
?>



<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>On The Go Logins</title>
        <link rel="stylesheet" href="Style.css">
    </head>
    <body>
        <div class="Sign-up">
            <h1>Welcome Back</h1>
            <h4>Just Your credentials</h4>
            <form method="POST">
                <label>Email</label>
                <input type="email" name="email" required>
                <label>Password</label>
                <input type="password" name="password" required>
                <input type="submit" name="" value="Submit">
            </form>
            <p>Not have An Account?<a href="signup.php">Signup Here</a></p>
        </div>
    </body>
</html>