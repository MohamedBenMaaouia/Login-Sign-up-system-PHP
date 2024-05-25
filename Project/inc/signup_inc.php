<?php
if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $username = $_POST["uid"];
    $pwd = $_POST["pwd"];
    $pwdrepeat = $_POST["pwdrepeat"];

    require_once 'dbh_inc.php';
    require_once 'Functions_inc.php';

    if (emptyInputSignup($name, $email, $username, $pwd, $pwdrepeat) !== false) {
        header("location: ../signup.php?error=emptyinput");
        exit();
    }
    if (InvalidUid($username) !== false) {
        header("location: ../signup.php?error=invalidUsername");
        exit();
    }
    if (UidExists($conn, $username, $email) !== false) {
        header("location: ../signup.php?error=UsernameExists");
        exit();
    }
    if (InvalidEmail($email) !== false) {
        header("location: ../signup.php?error=invalidEmail");
        exit();
    }
    if (UnmatchPwd($pwd, $pwdrepeat) !== false) {
        header("location: ../signup.php?error=passwordsUnmatched");
        exit();
    }
    CreateUser($conn, $name, $email, $username, $pwd);
}
