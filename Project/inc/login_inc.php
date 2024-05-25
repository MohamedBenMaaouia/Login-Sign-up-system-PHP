<?php
if (isset($_POST["submit"])) {
    $username = $_POST["name"];
    $pwd = $_POST["pwd"];

    require_once 'dbh_inc.php';
    require_once 'Functions_inc.php';
    if (emptyInputLogin($username, $pwd) !== false) {
        header("location: ../login.php?error=emptyinput");
        exit();
    }

    LoginUser($conn, $username, $pwd);
} else {
    header("location: ../login.php");
    exit();
}
?>
