<?php 
include "../model/connect.php"; 
$cart_id = $_POST['cart_item'];
$action = $_POST['action'];

$cart_item_sql = "SELECT * FROM cart_item WHERE cart_item_id = $cart_id";
$cart_item_statement = $conn->prepare($cart_item_sql);
$cart_item_statement->execute();
$cart_item_result = $cart_item_statement->fetchAll();
$cart_item_statement->closeCursor();

$product_id = $cart_item_result[0]['product_product_id'];

$product_sql = "SELECT stock_on_hand FROM product WHERE product_id = $product_id";
$product_statement = $conn->prepare($product_sql);
$product_statement->execute();
$product_result = $product_statement->fetchAll();
$product_statement->closeCursor();

$cart_quantity = $cart_item_result[0]['quantity'];

if($action == 'reduce') {
    $cart_quantity--;
} else {
    $cart_quantity++;
}

$product_stock = $product_result[0]['stock_on_hand'];
if($cart_quantity > $product_stock) {
    $update_cart_sql = "UPDATE cart_item SET quantity = $product_stock WHERE cart_item_id = $cart_id";
} else {
    $update_cart_sql = "UPDATE cart_item SET quantity = $cart_quantity WHERE cart_item_id = $cart_id";
}

$update_cart_statement = $conn->prepare($update_cart_sql);
$update_cart_statement->execute();

header("Location: ../pages/cart.php");
?>

