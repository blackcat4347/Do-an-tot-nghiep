<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "my_database";
if (isset($_SESSION['time'])) {
    $real_time = time();
    if ($real_time - $_SESSION['time'] > 60 * 30) {
        unset($_SESSION['time']);
        $_SESSION['count'] = 0;
    }
}
// echo system("whoami");
if (isset($_GET['login'])) {

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (!isset($_SESSION['count'])) {
        $_SESSION['count'] = 0;
    }

    if ($_SESSION['count'] <= 3000) {
        $username = $_GET['username'];
        $password = $_GET['password'];
        $sql = "SELECT * FROM users_account WHERE username='$username' AND password='$password'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo "<div class='container mt-5'>";
            echo "<div class='alert alert-success' role='alert'>";
            echo "<h4 class='alert-heading'>Welcome!</h4>";
            echo "<p>Username: " . $row['username'] . "</p>";
            echo "<hr>";
            echo "<p class='mb-0'>You have successfully logged in.</p>";
            echo "</div>";
            echo "</div>";
        } else {
            $_SESSION['count'] = $_SESSION['count'] + 1;
            echo "<div class='container mt-5'>";
            echo "<div class='alert alert-danger' role='alert'>";
            echo "<h4 class='alert-heading'>Login Failed!</h4>";
            echo "<p>Invalid username or password.</p>";
            echo "</div>";
            echo "</div>";
        }
    } else {
        if (!isset($_SESSION['time'])) {
            $_SESSION['time'] = time();
            echo "<div class='container mt-5'>";
            echo "<div class='alert alert-warning' role='alert'>";
            echo "<h4 class='alert-heading'>Too Many Attempts!</h4>";
            echo "<p>Please try again after 30 minutes.</p>";
            echo "</div>";
            echo "</div>";
        }
    }
    $conn->close();
}
?>

<!doctype html>
<html lang="en">

<head>
    <title>PTIT - Information Security</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Login</div>
                    <div class="card-body">
                        <form action="login.php" method="GET">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password" name="password">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button" id="showPasswordToggle"><i class="fas fa-eye"></i></button>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary" name="login">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const passwordInput = document.getElementById("password");
            const showPasswordToggle = document.getElementById("showPasswordToggle");

            showPasswordToggle.addEventListener("click", function() {
                if (passwordInput.type === "password") {
                    passwordInput.type = "text";
                } else {
                    passwordInput.type = "password";
                }
            });
        });
    </script>

</body>

</html>