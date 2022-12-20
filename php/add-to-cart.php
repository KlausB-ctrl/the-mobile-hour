<?php
include '../model/connect.php';
$quantity = $_POST['addtocart-amount'];
$customer = '1';
$product = filter_var($_GET['product'], FILTER_SANITIZE_NUMBER_INT);

$sql = "SELECT * FROM cart_item WHERE (customer_customer_id = $customer AND product_product_id = $product)";
$statement = $conn->prepare($sql);
$statement->execute();
$result = $statement->fetchAll();
$statement->closeCursor();

header("Location: ../pages/product.php?product=$product&over-quantity=false");

if (isset($result[0])) {
    $product_sql = "SELECT stock_on_hand FROM product WHERE product_id = $product";
    $product_statement = $conn->prepare($product_sql);
    $product_statement->execute();
    $product_result = $product_statement->fetchAll();
    $product_statement->closeCursor();

    if ($result[0]['quantity'] + $quantity <= $product_result[0]['stock_on_hand']) {
        $cartEntryID = $result[0]['cart_item_id'];
        $cartEntryQuantity = $result[0]['quantity'] + $quantity;
    
        $cart_sql = "UPDATE cart_item SET quantity = $cartEntryQuantity WHERE cart_item_id = $cartEntryID";
        $conn->exec($cart_sql);
    } else {
        header("Location: ../pages/product.php?product=$product&over-quantity=true");
    }
} else {
    $cart_sql = "INSERT INTO cart_item (quantity, customer_customer_id, product_product_id) VALUES ($quantity, $customer, $product)";
    $conn->exec($cart_sql);}
?>