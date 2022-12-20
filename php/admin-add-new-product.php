<?php 
include "../model/connect.php";

session_start();

if(!isset($_SESSION['id'])) {
    header("Location: ./admin-login.php");
}

$feature_id_sql = "SELECT feature_id FROM feature ORDER BY feature_id DESC LIMIT 1";
$feature_id_statement = $conn->prepare($feature_id_sql);
$feature_id_statement->execute();
$feature_id_result = $feature_id_statement->fetchAll();
$feature_id_statement->closeCursor();

$feature_id = intval($feature_id_result[0]['feature_id']) + 1;

$feature_sql = "INSERT INTO feature (feature_id, weight, dimensions, OS, screensize, resolution, CPU, RAM, storage, battery, rear_camera, front_camera)
VALUES ($feature_id, 'XXXg', 'XXX x XXXa x XXX mm', 'Placeholder', 'X.X inches', 'XXXXxXXXX', 'Placeholder', 'XXGB', 'XXGB', 'XXXX mAh', 'X.X MP', 'X.X MP')";

$feature_statement = $conn->prepare($feature_sql);
$feature_statement->execute();

$product_id_sql = "SELECT product_id FROM product ORDER BY product_id DESC LIMIT 1";
$product_id_statement = $conn->prepare($product_id_sql);
$product_id_statement->execute();
$product_id_result = $product_id_statement->fetchAll();
$product_id_statement->closeCursor();

$product_id = intval($product_id_result[0]['product_id']) + 1;

$product_sql = "INSERT INTO product (product_id, product_name, product_model, manufacturer_manufacturer_id, price, stock_on_hand, quantity_sold, product_description, product_main_image, feature_feature_id)
VALUES ($product_id, 'New Product (click to edit details)', 'Placeholder', 1, 0, 0, 0, 'Placeholder',  'Placeholder', $feature_id)";

$product_statement = $conn->prepare($product_sql);
$product_statement->execute();

$current_date = date('Y-m-d');
$user_id = $_SESSION['id'];
$changelog_sql = "INSERT INTO changelog (date_created, date_last_modified, product_product_id, user_user_id)
VALUES ('$current_date', '$current_date', $product_id, $user_id)";
$changelog_statement = $conn->prepare($changelog_sql);
$changelog_statement->execute();

header("Location: ../pages/admin-dashboard.php");
?>