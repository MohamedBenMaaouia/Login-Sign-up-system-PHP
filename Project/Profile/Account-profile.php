<?php
    session_start();
    include_once '../inc/dbh_inc.php';
    include_once '../inc/Functions_inc.php';
    $username ='UsersUid';
    $email ='UsersEmail';
    $fullname ='UsersName';
    $pass='UsersPwd';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="profile.css">
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins: wght@300;400; 500; 600; 700; 800; 900& display=swap");
    *{
        font-family: "Poppins", sans-serif;

    }
    </style>
</head>
<body>
    <div class="input">
        <div class="value"><p>Full Name : <?php echo afficherdata($fullname,$conn); ?></p></div>
        <div class="value"><p>Email : <?php echo afficherdata($email,$conn); ?></p></div>
        <div class="value"><p>Username : <?php echo afficherdata($username,$conn); ?></p></div>
    </div>
</body>
</html>
