<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link href='style.css' rel='stylesheet'>
</head>

<body>
    <div class="form">
        <h2>Sign Up</h2>
        <form action="inc/signup_inc.php" method="post">
            <div class="input-box">
                <input type="text" name="name" placeholder="Full name">
            </div>
            <div class="input-box">
                <input type="text" name="email" placeholder="email">
            </div>
            <div class="input-box">
                <input type="text" name="uid" placeholder="username">
            </div>
            <div class="input-box">
                <input type="password" name="pwd" placeholder="password">
            </div>
            <div class="input-box">
                <input type="password" name="pwdrepeat" placeholder="repeat password">
            </div>
            <button class="btn" type="submit" name="submit">Sign Up</button>
            <div class="signup-link">
                <p>You have an account? <a href="login.php">Log in</a></p>
            </div>
        </form>
    </div>
    <?php
    if (isset($_GET["error"])) {
        if ($_GET["error"] == "emptyinput") {
            echo "<script>
                    alert('Fill In All Fields !');
                  </script>";
        } else if ($_GET["error"] == "invalidUsername") {
            echo "<script>
                    alert('Your Username is not matching the conditions ! Use : a-z A-Z 0-9');
                  </script>";
        } else if ($_GET["error"] == "UsernameExists") {
            echo "<script>
                    alert('Username already exists !');
                    </script>";
        } else if ($_GET["error"] == "invalidEmail") {
            echo "<script>
                    alert('Your email is not valid !');
                  </script>";
        } else if ($_GET["error"] == "passwordsUnmatched") {
            echo "<script>
                    alert('Unmatched Passwords !');
                  </script>";
        } else if ($_GET["error"] == "stmtfailed") {
            echo "<script>
                    alert('Something went Wrong !');
                  </script>";
        } else if ($_GET["error"] == "none") {
            echo "<script>
                    alert('Your account has been Created !');
                  </script>";
        }
    }
    ?>

</body>

</html>