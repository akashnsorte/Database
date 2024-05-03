<?php
session_start();

include("db.php");

if($_SERVER['REQUEST_METHOD'] == "POST") {
    $firstname = $_POST['fname'];
    $lastname = $_POST['Lname'];
    $gender = $_POST['Gender'];
    $num = $_POST['cnum'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate email
    if(!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare and bind SQL statement
        $query = "INSERT INTO form (fname, Lname, Gender, cnum, address, email, password) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "sssssss", $firstname, $lastname, $gender, $num, $address, $email, $hashed_password);
        
        // Execute the statement
        mysqli_stmt_execute($stmt);

        // Check if the query was successful
        if(mysqli_stmt_affected_rows($stmt) > 0) {
            echo "<script type='text/javascript'> alert('Successfully registered.')</script>";
        } else {
            echo "<script type='text/javascript'> alert('Registration failed.')</script>";
        }

        // Close statement
        mysqli_stmt_close($stmt);
    } else {
        echo "<script type='text/javascript'> alert('Please enter a valid email address.')</script>";
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
            <h1>Sign-up</h1>
            <h4>It's free and only takes seconds to sign up</h4>
            <form method="post">
                <label>First name</label>
                <input type="text" name="fname" required>
                <label>Last name</label>
                <input type="text" name="Lname" required>
                <label>Gender</label>
                <input type="text" name="Gender" required>
                <label>Contact address</label>
                <input type="tel" name="cnum" required>
                <label>Address</label>
                <input type="text" name="address" required>
                <label>Email</label>
                <input type="email" name="email" required>
                <label>Password</label>
                <input type="password" name="password" required>
                <input type="submit" name="" value="Submit">
            </form>
            <p>By clicking Sign-up, you are agreeing to the terms and conditions of our<br>
                <a href="#">Terms and Conditions</a> and <a href="#">Privacy Policy</a>
            </p>
            <p>Already connected with us? <a href="login.php">Login Here</a></p>
        </div> 
    </body>
</html>