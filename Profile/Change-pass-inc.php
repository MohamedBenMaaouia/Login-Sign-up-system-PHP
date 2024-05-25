<?php

session_start();

include_once '../inc/dbh_inc.php';
include_once '../inc/Functions_inc.php';

if (isset($_SESSION['userid']) && isset($_POST['submit'])) {
    $storedPassword = $_SESSION['userpwd'];
    $userId = $_SESSION['userid'];
    $newPassword = $_POST['NewPassword'];
    $currentPassword=$_POST['CurrentPassword'];
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    
    if (emptyInputPasswordChange($newPassword,$currentPassword) !== false){
        header("location: Change-pass.php?error=emptyinput");
        exit();
    }

    if(password_verify( $currentPassword,$storedPassword) == false){
        header("location: Change-pass.php?error=WrongPassword");
        exit();
    }
    
    if (updatePasswordInDatabase($userId, $hashedPassword, $conn)) {
        echo "Password updated successfully.";
    } else {
        echo "Failed to update password.";
    }
}

mysqli_close($conn);
?>



