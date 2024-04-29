<?php
session_start();

if (isset($_SESSION["user"])) {
    header("Location: login.php");
    exit(); 
}

require_once "../database/database.php";

if (isset($_POST["submit"])) {
    $fullName = htmlspecialchars($_POST["FullName"]);
    $email = htmlspecialchars($_POST["Email"]);
    $username = htmlspecialchars($_POST["Username"]);
    $password = $_POST["Password"];
    $passwordRepeat = $_POST["RepeatPassword"];

    $errors = array();

    if (empty($fullName) || empty($email) || empty($password) || empty($username) || empty($passwordRepeat)) {
        array_push($errors, "All fields are required");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Email is not valid");
    }
    if (strlen($password) < 8) {
        array_push($errors, "Password must be at least 8 characters long");
    }
    if ($password !== $passwordRepeat) {
        array_push($errors, "Password does not match");
    }


    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = mysqli_stmt_init($conn);

    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        $rowCount = mysqli_num_rows($result);

        if ($rowCount > 0) {
            array_push($errors, "Email already exists!");
        }

        mysqli_stmt_close($stmt);
    } else {
        die("Something went wrong");
    }

    if (count($errors) > 0) {
        foreach ($errors as $error) {
            echo "<div class='alert alert-danger'>$error</div>";
        }
    } else {
        
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        
        $sql = "INSERT INTO users (fullname, email, username, password) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);

        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "ssss", $fullName, $email, $username, $passwordHash);
            mysqli_stmt_execute($stmt);

            echo "<div class='alert alert-success'>You are registered successfully.</div>";

            
            header("Location: login.php");
            exit();
        } else {
            die("Something went wrong");
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/register.css">
</head>
<style>
               body{ background-image: url('../assets/bg.jpg'); 
            background-size: auto;
            background-position: center;
        }
        </style>

<body>
    <div class="container">
        <form action="register.php" method="post">
            <div class="form-group">
                <input type="text" class="form-control" name="FullName" placeholder="Full Name">
            </div>
            <div class="form-group">
                <input type="email" class="form-control" name="Email" placeholder="Email">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="Username" placeholder="Username">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="Password" placeholder="Password">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="RepeatPassword" placeholder="Repeat Password">
            </div>
            <div class="form-btn">
                <input type="submit" class="btn btn-primary" value="Register" name="submit">
            </div>
        </form>
        <div>
            <p>Already Registered <a href="login.php">Login Here</a></p>
        </div>
    </div>
</body>

</html>
