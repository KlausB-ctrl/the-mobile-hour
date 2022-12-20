<?php
include "../model/connect.php";
$cart_id = $_POST['cart-id'];

$sql = "DELETE FROM cart_item WHERE cart_item_id = $cart_id";
$statement = $conn->prepare($sql);
$statement->execute();

header("Location: ../pages/cart.php");
?>