<?php 
include "../model/connect.php"; 

session_start();

if(!isset($_SESSION['id'])) {
    header("Location: ./admin-login.php");
}

$user_sql = "SELECT user_id, username FROM user ORDER BY username ASC";
$user_statement = $conn->prepare($user_sql);
$user_statement->execute();
$user_result = $user_statement->fetchAll();
$user_statement->closeCursor();

if(isset($_GET['changelog-product-name'])) {
    $changelog_product_searched = $_GET['changelog-product-name'];
    if(!$changelog_product_searched) {
        $changelog_product_searched = "all";
    }
} else {
    $changelog_product_searched = "all";
}

if($changelog_product_searched != "all") {
    $product_sql = "SELECT product_id FROM product WHERE product_name LIKE '%$changelog_product_searched%'";
    $product_statement = $conn->prepare($product_sql);
    $product_statement->execute();
    $product_result = $product_statement->fetchAll();
    $product_statement->closeCursor();
    $product_id_string = "";
    foreach($product_result as $product):
        $product_id_string .= $product['product_id'] . ", ";
    endforeach;
    $product_id_string = substr($product_id_string, 0, -2);
}

if(isset($_GET['user'])) {
    $user_searched = $_GET['user'];
} else {
    $user_searched = "all";
}

if(isset($_GET['show'])) {
    $show_quantity = intval($_GET['show']);
} else {
    $show_quantity = 6;
}

if(isset($_GET['start-date'])) {
    $start_date_searched = $_GET['start-date'];
    if(!$start_date_searched) {
        $start_date_searched = "2022-11-03";
    }
} else {
    $start_date_searched = "2022-11-03";
}

if(isset($_GET['end-date'])) {
    $end_date_searched = $_GET['end-date'];
    if(!$end_date_searched) {
        $end_date_searched = date('Y-m-d');
    }
} else {
    $end_date_searched = date('Y-m-d');
}

if($changelog_product_searched == "all") {
    if($user_searched == "all") {
        $changelog_length_sql = "SELECT changelog_id FROM changelog WHERE date_last_modified BETWEEN '$start_date_searched' AND '$end_date_searched'";
    } else {
        $changelog_length_sql = "SELECT changelog_id FROM changelog WHERE user_user_id = $user_searched AND date_last_modified BETWEEN '$start_date_searched' AND '$end_date_searched'";
    }
} else {
    if($user_searched == "all") {
        $changelog_length_sql = "SELECT changelog_id FROM changelog WHERE product_product_id IN ('$product_id_string') AND date_last_modified BETWEEN '$start_date_searched' AND '$end_date_searched'";
    } else {
        $changelog_length_sql = "SELECT changelog_id FROM changelog WHERE product_product_id IN ('$product_id_string') AND user_user_id = $user_searched AND date_last_modified BETWEEN '$start_date_searched' AND '$end_date_searched'";
    }
}

$changelog_length_statement = $conn->prepare($changelog_length_sql);
$changelog_length_statement->execute();
$changelog_length_result = $changelog_length_statement->fetchAll();
$changelog_length_statement->closeCursor();

$changelog_result_quantity = sizeof($changelog_length_result);
$required_button_quantity = ceil($changelog_result_quantity / $show_quantity);

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
 
if($changelog_product_searched == "all") {
    if($user_searched == "all") {
        $changelog_sql = "SELECT changelog.*, product.product_name, user.username FROM ((changelog INNER JOIN product ON changelog.product_product_id = product.product_id) INNER JOIN user ON changelog.user_user_id = user.user_id) WHERE date_last_modified BETWEEN '$start_date_searched' AND '$end_date_searched' ORDER BY changelog_id DESC LIMIT $limit_start, $show_quantity";
    } else {
        $changelog_sql = "SELECT changelog.*, product.product_name, user.username FROM ((changelog INNER JOIN product ON changelog.product_product_id = product.product_id) INNER JOIN user ON changelog.user_user_id = user.user_id) WHERE user_user_id = $user_searched AND date_last_modified BETWEEN '$start_date_searched' AND '$end_date_searched' ORDER BY changelog_id DESC LIMIT $limit_start, $show_quantity";
    }
} else {
    if($user_searched == "all") {
        $changelog_sql = "SELECT changelog.*, product.product_name, user.username FROM ((changelog INNER JOIN product ON changelog.product_product_id = product.product_id) INNER JOIN user ON changelog.user_user_id = user.user_id) WHERE product_product_id IN ($product_id_string) AND date_last_modified BETWEEN '$start_date_searched' AND '$end_date_searched' ORDER BY changelog_id DESC LIMIT $limit_start, $show_quantity";
    } else {
        $changelog_sql = "SELECT changelog.*, product.product_name, user.username FROM ((changelog INNER JOIN product ON changelog.product_product_id = product.product_id) INNER JOIN user ON changelog.user_user_id = user.user_id) WHERE product_product_id IN ($product_id_string) AND user_user_id = $user_searched AND date_last_modified BETWEEN '$start_date_searched' AND '$end_date_searched' ORDER BY changelog_id DESC LIMIT $limit_start, $show_quantity";
    }
}

$changelog_statement = $conn->prepare($changelog_sql);
$changelog_statement->execute();
$changelog_result = $changelog_statement->fetchAll();
$changelog_statement->closeCursor();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Changelogs | Admin Dashboard | The Mobile Hour</title>
</head>
<body>
    <main class="admin-dashboard">
        <div class="admin-dashboard__left">
            <div class="admin-dashboard__left__title">
                <h1>Changelogs | Admin Dashboard | The Mobile Hour</h1>
            </div>
            <h2>Panels</h2>
            <button class="button--standard" onclick="location.href='./admin-dashboard.php'">Products</button>
            <button class="button--standard" onclick="location.href='./admin-dashboard-users.php'">Users</button>
            <button class="button--standard panel-active" onclick="location.href='./admin-dashboard-changelogs.php'">Changelogs</button>
        </div>
        <div class="admin-dashboard__right">
            <div class="admin-dashboard__right__header">
            </div>
            <div class="admin-dashboard__right__content">
                <div class="admin-dashboard__products">
                    <form class="admin-dashboard__products__list">
                        <h3>Changelogs</h3>
                        <div class="products__list-row">
                            <input name="changelog-product-name" <?php if($changelog_product_searched != "all") {echo "value=$changelog_product_searched";};?>>
                            <button type="submit" class="button--standard">Search</button>
                        </div>
                        <div class="products__list-row">
                            <select name="user">
                                <option value="all">All Users</option>
                                <?php 
                                    foreach($user_result as $user):
                                        $user_id = $user['user_id'];
                                        $user_name = $user['username'];
                                        echo "<option value=$user_id ";
                                        if($user_searched == $user_id) {echo "selected";};
                                        echo ">$user_name</option>";
                                    endforeach;
                                ?>
                            </select>
                            <select name="show" onchange="this.form.submit()">
                                <option value="6" <?php if($show_quantity== 6) {echo "selected";};?>>6</option>
                                <option value="12" <?php if($show_quantity== 12) {echo "selected";};?>>12</option>
                                <option value="24" <?php if($show_quantity== 24) {echo "selected";};?>>24</option>
                                <option value="48" <?php if($show_quantity== 48) {echo "selected";};?>>48</option>
                                <option value="72" <?php if($show_quantity== 72) {echo "selected";};?>>72</option>
                            </select>
                        </div>
                        <div class="products__list-row">
                            <div>
                                <label for="start-date">Start Date</label>
                                <input name="start-date" id="start-date" type="date">   
                            </div>
                            <div>
                                <label for="end-date">End Date</label>
                                <input name="end-date" id="end-date" type="date">    
                            </div>                    
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
                            $changelog_index = 0;
                            foreach($changelog_result as $changelog):
                                echo "<button name='showing' value=" . $changelog_index . ">" . $changelog['changelog_id'] . " | " . $changelog['product_name'] . " | " . $changelog['username'] ."</button>";
                                $changelog_index++;
                            endforeach;
                            echo "<input name='previous-page' value=" . $page_number . " hidden>";
                            ?>
                        </div>
                    </form>
                    <form class="admin-dashboard__products__list">
                        <?php
                        if(isset($_GET['showing'])) {
                            $displayed_changelog = $changelog_result[$_GET['showing']];
                        } else {
                            $displayed_changelog = false;
                        }
                        ?>
                        <div class="admin-dashboard__products__list__product-details">
                            <h3>Changelog Details</h3>
                            <h3>Changelog ID: <?php if($displayed_changelog) {echo $displayed_changelog['changelog_id'];} else {echo "No User Selected";}?></h3>
                            <div>
                                <label for="changelog-user">User</label>
                                <input name="changelog-user" id="changelog-user" <?php if($displayed_changelog) {echo "value='" . $displayed_changelog['username'] . "'";}?> disabled>
                            </div>
                            <div>
                                <label for="changelog-product">Product</label>
                                <input name="changelog-product" id="changelog-product" <?php if($displayed_changelog) {echo "value='" . $displayed_changelog['product_name'] . "'";}?> disabled>
                            </div>
                            <div>
                                <label for="changelog-datecreated">Date Created</label>
                                <input name="changelog-datecreated" id="changelog-datecreated" <?php if($displayed_changelog) {echo "value='" . $displayed_changelog['date_created'] . "'";}?> disabled>
                            </div>
                            <div>
                                <label for="changelog-datemodified">Date Last Modified</label>
                                <input name="changelog-datemodified" id="changelog-datemodified" <?php if($displayed_changelog) {echo "value='" . $displayed_changelog['date_last_modified'] . "'";}?> disabled>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>
</html>