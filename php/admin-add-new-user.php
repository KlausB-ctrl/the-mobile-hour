<?php 
include "../model/connect.php";

session_start();

if(!isset($_SESSION['id'])) {
    header("Location: ./admin-login.php");
}

$user_id_sql = "SELECT user_id FROM user ORDER BY user_id DESC LIMIT 1";
$user_id_statement = $conn->prepare($user_id_sql);
$user_id_statement->execute();
$user_id_result = $user_id_statement->fetchAll();
$user_id_statement->closeCursor();

$user_id = intval($user_id_result[0]['user_id']) + 1;

$user_sql = "INSERT INTO user (user_id, firstname, lastname, username, user_password, user_role_user_role_id)
VALUES ($user_id, 'New', 'User', 'newuser" . $user_id . "', '113459eb7bb31bddee85ade5230d6ad5d8b2fb52879e00a84ff6ae1067a210d3', 2)";

$user_statement = $conn->prepare($user_sql);
$user_statement->execute();

header("Location: ../pages/admin-dashboard-users.php");
?>