<?php
include "../model/connect.php";

session_start();

if(!isset($_SESSION['id'])) {
    header("Location: ./admin-login.php");
}

$product_id = addslashes($_POST['product-id']);
$feature_id = addslashes($_POST['feature-id']);

if($_POST['action'] == "save") {
    $product_name = addslashes($_POST['product-name']);
    $product_model = addslashes($_POST['product-model']);
    $product_brand = addslashes($_POST['product-brand']);
    $product_price = addslashes($_POST['product-price']);
    $product_stock = addslashes($_POST['product-stock']);
    $product_sold = addslashes($_POST['product-sold']);
    $product_image = addslashes($_POST['product-image']);
    $product_description = addslashes($_POST['product-description']);
    
    $feature_weight = addslashes($_POST['feature-weight']);
    $feature_dimensions = addslashes($_POST['feature-dimensions']);
    $feature_os = addslashes($_POST['feature-os']);
    $feature_screensize = addslashes($_POST['feature-screensize']);
    $feature_resolution = addslashes($_POST['feature-resolution']);
    $feature_cpu = addslashes($_POST['feature-cpu']);
    $feature_ram = addslashes($_POST['feature-ram']);
    $feature_storage = addslashes($_POST['feature-storage']);
    $feature_battery = addslashes($_POST['feature-battery']);
    $feature_rearcamera = addslashes($_POST['feature-rearcamera']);
    $feature_frontcamera = addslashes($_POST['feature-frontcamera']);
    
    $sql = "UPDATE product 
        SET product_name = '$product_name', 
        product_model = '$product_model', 
        manufacturer_manufacturer_id = '$product_brand',
        price = $product_price,
        stock_on_hand = $product_stock,
        quantity_sold = $product_sold,
        product_description = '$product_description',
        product_main_image = '$product_image',
        feature_feature_id = $feature_id
    WHERE product_id = $product_id";
    $statement = $conn->prepare($sql);
    $statement->execute();
    
    $feature_sql = "UPDATE feature
        SET weight = '$feature_weight',
        dimensions = '$feature_dimensions',
        OS = '$feature_os',
        screensize = '$feature_screensize',
        resolution = '$feature_resolution',
        CPU = '$feature_cpu',
        RAM = '$feature_ram',
        storage = '$feature_storage',
        battery = '$feature_battery',
        rear_camera = '$feature_rearcamera',
        front_camera = '$feature_frontcamera'
    WHERE feature_id = $feature_id";
    $feature_statement = $conn->prepare($feature_sql);
    $feature_statement->execute();

    $current_date = date('Y-m-d');
    $user_id = $_SESSION['id'];
    $changelog_sql = "UPDATE changelog SET date_last_modified = '$current_date', user_user_id = $user_id WHERE product_product_id = $product_id";
    $changelog_statement = $conn->prepare($changelog_sql);
    $changelog_statement->execute();
} else if ($_POST['action'] == "delete") {
   $changelog_sql = "DELETE FROM changelog WHERE product_product_id = $product_id";
   $changelog_statement = $conn->prepare($changelog_sql);
   $changelog_statement->execute();
   
   $sql = "DELETE FROM product WHERE product_id = $product_id";
   $statement = $conn->prepare($sql);
   $statement->execute();

   $feature_sql = "DELETE FROM feature WHERE feature_id = $feature_id";
   $feature_statement = $conn->prepare($feature_sql);
   $feature_statement->execute();
}


header("Location: ../pages/admin-dashboard.php");
?>