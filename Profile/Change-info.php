<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Settings</title>

</head>

<body>
    <form action="Change-info-inc.php" method="post">
        <h2>Change General Information</h2>
        <label for="NewFullName">Full Name:</label><input type="text" name="NewFullName" id="NewFullName" placeholder="<?php echo $_SESSION["username"];?>">
        </br>
        <label for="NewEmail">Email:</label><input type="text" name="NewEmail" id="NewEmail" placeholder="<?php echo $_SESSION["useremail"];?>">
        </br>
        <label for="NewUsername">Username:</label><input type="text" name="NewUsername" id="NewUsername" placeholder="<?php echo $_SESSION["useruid"];?>">
        </br>
        <label for="Passwordconfirmation">Confirm password:</label><input type="password" name="Passwordconfirmation" placeholder="">
        </br>
        <button type="submit" name="submit"> Apply Changes </button>
    </form>










</body>

</html>