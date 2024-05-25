<?php
    session_start();
    print_r($_POST);
    include_once '../inc/dbh_inc.php';
    include_once '../inc/Functions_inc.php';

    if (isset($_SESSION['userid']) && isset($_POST['submit'])) {
        $pass='UsersPwd';
        $usrnme ='UsersUid';
        $eml ='UsersEmail';
        $newEmail=$_POST['NewEmail'];
        $newFullname=$_POST['NewFullName'];
        $newUsername=$_POST['NewUsername'];
        $Passwordconfirmation=$_POST['Passwordconfirmation'];
        $userId=$_SESSION['userid'];
        $currentPassword= afficherdata($pass,$conn);
        $username=afficherdata($usrnme,$conn);
        $email=afficherdata($eml,$conn);

        if(password_verify($Passwordconfirmation,$currentPassword) == false){
            header("location: Change-info.php?error=WrongPassword");
            exit();
        }
        if (emptyInputInfoChange($newFullname,$newEmail,$newUsername)) {
            header("location: Change-info.php?error=emptyinput");
            exit();
        }

        if(InvalidUid($newUsername)){
            header("location: Change-info.php?error=invalidusername");
            exit();
        };
        if(InvalidEmail($newEmail)){
            header("location: Change-info.php?error=invalidemail");
            exit();
        };
        if(UidExistsinfo($conn, $username, $email,$newUsername,$newEmail) !== false ){
            header("location: Change-info.php?error=UsernameExists");
            exit();
        }

        
        if(updateFullNameInDatabase($userId, $newFullname, $conn)){
            echo "Full name updated successfully.";
            echo'</br>';
        } else {
            echo "Failed to update Full name.";
            echo'</br>';
        }
        

        if(updateUsernameInDatabase($userId, $newUsername, $conn)){
            echo "Username updated successfully.";
            echo'</br>';
        } else {
            echo "Failed to update Username.";
            echo'</br>';
        }
        

        if(updateEmailInDatabase($userId, $newEmail, $conn)){
            echo "Email updated successfully.";
            echo'</br>';
        } else {
            echo "Failed to update Email.";
            echo'</br>';
        }
        
    }