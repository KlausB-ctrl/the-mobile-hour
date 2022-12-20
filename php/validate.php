<?php 
include "../model/connect.php";

function test_input($data) {
    // Remove whitespaces in the string
    $data = trim($data);

    // Remove any slashes in the string
    $data = stripslashes($data);
    
    // Convert any special characters in the string
    $data = htmlspecialchars($data);

    // Return the string
    return $data;
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Store entered information
    $username = test_input($_POST['username']);
    $password = hash('sha256', test_input($_POST['password']));

    $sql = "SELECT * FROM user WHERE username = '$username' AND user_password = '$password'";
    $statement = $conn->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll();
    $statement->closeCursor();

    if(!empty($result)) {
        ob_start();
        session_start();
        $_SESSION['valid'] = true;
        $_SESSION['timeout'] = time();
        $_SESSION['username'] = $username;
        $_SESSION['id'] = $result[0]['user_id'];
        $_SESSION['role'] = $result[0]['user_role_user_role_id'];
        header("Location: ../pages/admin-dashboard.php");
    } else {
        header("Location: ../pages/admin-login.php?login-failed=true");
    }
}
?>