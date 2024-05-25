
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <link href='style.css' rel='stylesheet'>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <div class="form">
        <h2>Log In</h2>
        </br>
        <form action="inc/login_inc.php" method="post">
            <div class="input-box">
                <input type="text" name="name" placeholder="username / email">
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="password" name="pwd" placeholder="password">
                <i class='bx bxs-lock-alt'></i>
            </div>
            <button class="btn" type="submit" name="submit">Log In</button>
            <div class="signup-link">
                <p>Don't have an account? <a href="signup.php">Register</a></p>
            </div>
        </form>
    </div>

    <?php if (isset($_GET["error"])) {
        if ($_GET["error"] == "emptyinput") {
            echo "<script> alert('Fill in All Fields !'); </script>";
        } else if ($_GET["error"] == "WrongLogin") {
            echo "<script> alert('Passwords or Username Incorrect !'); </script>";
        }
    } ?>
</body>

</html>