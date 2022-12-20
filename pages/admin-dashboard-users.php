<?php 
include "../model/connect.php"; 

session_start();

if(!isset($_SESSION['id'])) {
    header("Location: ./admin-login.php");
}

$current_user_role = $_SESSION['role'];

if(isset($_GET['permission'])) {
    echo "<script src='../js/misc/insufficient-role.js'></script>";
}

if(isset($_GET['show'])) {
    $show_quantity = intval($_GET['show']);
} else {
    $show_quantity = 6;
}

if(isset($_GET['user-name'])) {
    $user_searched = $_GET['user-name'];
    $user_length_sql = "SELECT * FROM user WHERE username LIKE '%$user_searched%'";
} else {
    $user_searched = "all";
    $user_length_sql = "SELECT * FROM user";
};

$user_length_statement = $conn->prepare($user_length_sql);
$user_length_statement->execute();
$user_length_result = $user_length_statement->fetchAll();
$user_length_statement->closeCursor();

$user_result_quantity = sizeof($user_length_result);
$required_button_quantity = ceil($user_result_quantity / $show_quantity);

if(isset($_GET['page'])) {
    $page_number = intval($_GET['page']);
} else {
    if(isset($_GET['showing'])) {
        $page_number = $_GET['previous-page'];
    } else {
        $page_number = 1;
    }
}

$limit_start = ($page_number - 1) * $show_quantity;

if(isset($_GET['user-name'])) {
    $user_sql = "SELECT * FROM user WHERE username LIKE '%$user_searched%' ORDER BY user_id DESC LIMIT $limit_start, $show_quantity";
} else {
    $user_sql = "SELECT * FROM user ORDER BY user_id DESC LIMIT $limit_start, $show_quantity";
};

$user_statement = $conn->prepare($user_sql);
$user_statement->execute();
$user_result = $user_statement->fetchAll();
$user_statement->closeCursor();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Users | Admin Dashboard | The Mobile Hour</title>
</head>
<body>
    <main class="admin-dashboard">
        <div class="admin-dashboard__left">
            <div class="admin-dashboard__left__title">
                <h1>Users | Admin Dashboard | The Mobile Hour</h1>
            </div>
            <h2>Panels</h2>
            <button class="button--standard" onclick="location.href='./admin-dashboard.php'">Products</button>
            <button class="button--standard panel-active" onclick="location.href='./admin-dashboard-users.php'">Users</button>
            <button class="button--standard" onclick="location.href='./admin-dashboard-changelogs.php'">Changelogs</button>
        </div>
        <div class="admin-dashboard__right">
            <div class="admin-dashboard__right__header">
            </div>
            <div class="admin-dashboard__right__content">
                <div class="admin-dashboard__products">
                    <form class="admin-dashboard__products__list">
                        <h3>Users</h3>
                        <div class="products__list-row">
                            <input name="user-name" <?php if($user_searched != "all") {echo "value=$user_searched";};?>>
                            <button type="submit" class="button--standard">Search</button>
                        </div>
                        <div class="products__list-row">
                            <select name="role">
                                <option value="all">All Roles</option>
                                <option value="1">Admin Manager</option>
                                <option value="2">Admin</option>
                            </select>
                            <select name="show" onchange="this.form.submit()">
                                <option value="6" <?php if($show_quantity== 6) {echo "selected";};?>>6</option>
                                <option value="12" <?php if($show_quantity== 12) {echo "selected";};?>>12</option>
                                <option value="24" <?php if($show_quantity== 24) {echo "selected";};?>>24</option>
                                <option value="48" <?php if($show_quantity== 48) {echo "selected";};?>>48</option>
                                <option value="72" <?php if($show_quantity== 72) {echo "selected";};?>>72</option>
                            </select>
                        </div>
                        <div class="page-number-buttons">
                            <?php 
                            for ($i = 1; $i <= $required_button_quantity; $i++) {
                                echo "<button name='page' value=$i ";
                                if($page_number == $i) {echo "disabled";}
                                echo ">$i</button>";
                            }
                            ?>
                        </div>
                        <div class="admin-products-results">
                            <?php
                            $user_index = 0;
                            foreach($user_result as $user):
                                echo "<button name='showing' value=" . $user_index;
                                if(str_contains($user['username'], 'newuser')) echo " class='product_button--green'";
                                echo ">" . $user['username'] . "</button>";
                                $user_index++;
                            endforeach;
                            echo "<input name='previous-page' value=" . $page_number . " hidden>";
                            ?>
                            <button type="submit" formaction=<?php if($current_user_role == 1) echo "../php/admin-add-new-user.php"; else {echo "../php/admin-deny-add-new-user.php";};?> class="button--standard">+Add New User</button>
                        </div>
                    </form>
                    <form class="admin-dashboard__products__list" action="../php/admin-user-save-changes.php" method="post">
                        <?php
                        if(isset($_GET['showing'])) {
                            $displayed_user = $user_result[$_GET['showing']];
                        } else {
                            $displayed_user = false;
                        }
                        ?>
                        <div class="admin-dashboard__products__list__product-details">
                            <h3>User Details</h3>
                            <h3>User ID: <?php if($displayed_user) {echo $displayed_user['user_id'];} else {echo "No User Selected";}?></h3>
                            <input name="user-id" <?php if($displayed_user) {echo "value='" . $displayed_user['user_id'] . "'";}?> hidden>
                            <div>
                                <label for="user-first-name">First Name</label>
                                <input name="user-first-name" id="user-first-name" maxlength="100" <?php if($displayed_user) {echo "value='" . $displayed_user['firstname'] . "'";}?>>
                            </div>
                            <div>
                                <label for="user-last-name">Last Name</label>
                                <input name="user-last-name" id="user-last-name" maxlength="100" <?php if($displayed_user) {echo "value='" . $displayed_user['lastname'] . "'";}?>>
                            </div>
                            <div>
                                <label for="user-username">Username</label>
                                <input name="user-username" id="user-username" maxlength="30" <?php if($displayed_user) {echo "value='" . $displayed_user['username'] . "'";}?>>
                            </div>
                            <div>
                                <label for="user-password">Password</label>
                                <input name="user-password" id="user-password" maxlength="255" <?php if($displayed_user) {echo "value='" . $displayed_user['user_password'] . "'";}?>>
                            </div>
                            <div>
                                <label for="user-role">Role</label>
                                <select name="user-role" id="user-role">
                                    <option value="1" <?php if($displayed_user) {if($displayed_user['user_role_user_role_id'] == "1") {echo "selected";}}?>>Admin Manager</option>
                                    <option value="2" <?php if($displayed_user) {if($displayed_user['user_role_user_role_id'] == "2") {echo "selected";}}?>>Admin</option>
                                </select>
                            </div>
                            <div></div>
                            <button name="action" value="save" class="button--standard" <?php if($current_user_role != 1) {echo "formaction='../php/admin-deny-add-new-user.php'";}?> <?php if(!isset($_GET['showing'])) {echo "disabled";}?>>Save Changes</button>
                            <button name="action" value="delete" class="button--standard button--standard--red" <?php if($current_user_role != 1) {echo "formaction='../php/admin-deny-add-new-user.php'";}?> onclick="return confirm('Are you sure?')" <?php if(!isset($_GET['showing'])) {echo "disabled";}?>>Delete User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>
</html>