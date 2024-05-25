<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Settings </title>
</head>
<body>
    <form action="Change-pass-inc.php" method="post">
    <h2>Change Password</h2>
    <input type="password" name="NewPassword" placeholder="New Password">
    <input type="password" name="CurrentPassword" placeholder="Current Password">
    <button type="submit" name="submit"> Apply Changes </button>
    </form>
    <?php
        if (isset($_GET["error"])){
            if($_GET["error"]=="emptyinput"){
                echo "<script> alert('Fill in All Fields !'); </script>";
            }
            else if ($_GET["error"]=="WrongPassword"){
                echo "<script> alert('Wrong Password!'); </script>";
            }
        }
    ?>
</body>
</html>