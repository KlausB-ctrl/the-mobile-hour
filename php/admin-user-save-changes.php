<?php 
include "../model/connect.php";

session_start();

if(!isset($_SESSION['id'])) {
    header("Location: ./admin-login.php");
}

$user_id = addslashes($_POST['user-id']);

if($_POST['action'] == "save") {
    $user_firstname = addslashes($_POST['user-first-name']);
    $user_lastname = addslashes($_POST['user-last-name']);
    $user_username = addslashes($_POST['user-username']);
    $user_password = addslashes($_POST['user-password']);
    if(strlen($user_password) < 64) {$user_password = addslashes(hash('sha256', $user_password));}
    $user_role = addslashes($_POST['user-role']);
 
    $sql = "UPDATE user 
        SET firstname = '$user_firstname', 
        lastname = '$user_lastname', 
        username = '$user_username',
        user_password = '$user_password',
        user_role_user_role_id = $user_role
    WHERE user_id = $user_id";
    echo $sql;
    $statement = $conn->prepare($sql);
    $statement->execute();
} else if ($_POST['action'] == "delete") {
   $sql = "DELETE FROM user WHERE user_id = $user_id";
   $statement = $conn->prepare($sql);
   $statement->execute();
}

header("Location: ../pages/admin-dashboard-users.php");
?>