<?php
function emptyInputSignup($name, $email, $username, $pwd, $pwdrepeat)
{
    $result = false;
    if (empty($name) || empty($email) || empty($username) || empty($pwd) || empty($pwdrepeat)) {
        $result = true;
    }
    return $result;
}
function InvalidUid($username)
{
    $result = false;
    if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        $result = true;
    }
    return $result;
}
function InvalidEmail($email)
{
    $result = false;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    }
    return $result;
}
function UnmatchPwd($pwd, $pwdrepeat)
{
    $result = false;
    if ($pwd !== $pwdrepeat) {
        $result = true;
    }
    return $result;
}
function UidExists($conn, $username, $email)
{
    $sql = "SELECT * FROM users WHERE usersUid=? OR usersEmail = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    } else {
        $result = false;
        return $result;
    }
    mysqli_stmt_close($stmt);
}


function CreateUser($conn, $name, $email, $username, $pwd)
{
    $sql = "INSERT INTO users (usersName,UsersEmail,UsersUid,UsersPwd) VALUES(?,?,?,?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?eroor=stmtfailed");
        exit();
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $username, $hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../signup.php?error=none");
    exit();
}
function emptyInputLogin($username, $pwd)
{
    $result = false;
    if (empty($username) || empty($pwd)) {
        $result = true;
    }
    return $result;
}

function LoginUser($conn, $username, $pwd)
{
    $UidExists = UidExists($conn, $username, $username);
    /*foreach ($UidExists as $cle => $val) {
        echo "$cle => $val ";
    }*/
    if ($UidExists === false) {
        header("location: ../login.php?error=WrongLogin");
        exit();
    }
    $PwdHashed = $UidExists["UsersPwd"];
    $CheckPwd = password_verify($pwd, $PwdHashed);
    if ($CheckPwd === false) {
        header("location: ../login.php?error=WrongLogin");
        exit();
    } else if ($CheckPwd === true) {
        session_start();
        $_SESSION["userid"] = $UidExists["usersID"];
        $_SESSION["useruid"] = $UidExists["UsersUid"];
        $_SESSION["userpwd"] = $UidExists["UsersPwd"];
        $_SESSION["username"] = $UidExists["UsersName"];
        $_SESSION["useremail"] = $UidExists["UsersEmail"];

        header("location: ../index.php");
        exit();
    }
}

function updatePasswordInDatabase($userId, $newPassword, $conn) {
    
    $query = "UPDATE users SET UsersPwd = ? WHERE usersID = ?";
    $statement = mysqli_prepare($conn, $query);
    
    mysqli_stmt_bind_param($statement, "si", $newPassword, $userId);

    if (mysqli_stmt_execute($statement)) {
        mysqli_stmt_close($statement);
        return true; 
    } else {
        mysqli_stmt_close($statement);
        return false; 
    }
}
function emptyInputPasswordChange($newpass,$pass){
    $result = false ;
    if(empty($newpass) || empty($pass)){
        $result = true;
        return $result;
    }
    return $result;
}
function updateEmailInDatabase($userId, $newEmail, $conn) {
    
    $query = "UPDATE users SET UsersEmail = ? WHERE usersID = ?";
    $statement = mysqli_prepare($conn, $query);
    
    mysqli_stmt_bind_param($statement, "si", $newEmail, $userId);

    if (mysqli_stmt_execute($statement)) {
        mysqli_stmt_close($statement);
        return true; 
    } else {
        mysqli_stmt_close($statement);
        return false; 
    }
}
function updateFullNameInDatabase($userId, $newFullName, $conn) {
    
    $query = "UPDATE users SET UsersName = ? WHERE usersID = ?";
    $statement = mysqli_prepare($conn, $query);
    
    mysqli_stmt_bind_param($statement, "si", $newFullName, $userId);

    if (mysqli_stmt_execute($statement)) {
        mysqli_stmt_close($statement);
        return true; 
    } else {
        mysqli_stmt_close($statement);
        return false; 
    }
}
function updateUsernameInDatabase($userId, $newUsername, $conn) {
    
    $query = "UPDATE users SET UsersUid = ? WHERE usersID = ?";
    $statement = mysqli_prepare($conn, $query);
    
    mysqli_stmt_bind_param($statement, "si", $newUsername, $userId);

    if (mysqli_stmt_execute($statement)) {
        mysqli_stmt_close($statement);
        return true; 
    } else {
        mysqli_stmt_close($statement);
        return false; 
    }
}
function emptyInputInfoChange($newFullName,$newEmail,$newUsername){
    $result = false ;
    if(empty($newFullName) || empty($newEmail) || empty($newUsername)){
        $result = true;
        return $result;
    }
    return $result;
}
function UidExistsinfo($conn, $username, $email, $newUsername, $newEmail)
{
    // Create a temporary table to store users except the current user
    $sql = "CREATE TEMPORARY TABLE changeinfo AS SELECT * FROM users WHERE UsersEmail != ? OR UsersUid != ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "ss", $email, $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    // Select from the temporary table where email or username matches the new ones
    $sql = "SELECT * FROM changeinfo WHERE UsersEmail = ? OR UsersUid = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "ss", $newEmail, $newUsername);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($resultData)) {
        mysqli_stmt_close($stmt);
        return $row;
    } else {
        mysqli_stmt_close($stmt);
        return false;
    }
}
function afficherdata($x,$conn){
    $sql = "SELECT * FROM users WHERE usersID =".$_SESSION['userid']."";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $data = $row[$x];
    return $data;
}