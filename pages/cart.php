<?php include '../model/connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Cart | The Mobile Hour</title>
    <script src="https://kit.fontawesome.com/a3443240ca.js" crossorigin="anonymous"></script>
</head>
<body>
    <script src="../js/components/header.js"></script>
    <main class="content-container cart">
        <div class="cart__container">
            <div>
                <h1 class="page-header">Cart</h1>
                <?php
                $cart_items_sql = "SELECT * FROM cart_item WHERE customer_customer_id = 1 ORDER BY product_product_id ASC";
                $cart_items_statement = $conn->prepare($cart_items_sql);
                $cart_items_statement->execute();
                $cart_items_result = $cart_items_statement->fetchAll();
                $cart_items_statement->closeCursor();
                if(empty($cart_items_result)) {
                    echo "<p>There are no items in the cart.</p>";
                } else {
                    echo "<table>";
                    echo "<tr>";
                    echo "<th>Items</th>";
                    echo "<th>Price</th>";
                    echo "<th>Quantity</th>";
                    echo "<th>Subtotal</th>";
                    echo "</tr>";

                    $products_list = [];
                    foreach($cart_items_result as $cart_item):
                        array_push($products_list, $cart_item['product_product_id']);
                    endforeach;

                    $products_list_string = implode(', ', $products_list);

                    $products_sql = "SELECT * FROM product WHERE product_id IN ($products_list_string)";
                    $products_statement = $conn->prepare($products_sql);
                    $products_statement->execute();
                    $products_result = $products_statement->fetchAll();
                    $products_statement->closeCursor();

                    $cart_index = 0;
                    $cart_subtotal = 0;
                    foreach($products_result as $product):
                        $cart_item_id = $cart_items_result[$cart_index]['cart_item_id'];
                        $item_quantity = $cart_items_result[$cart_index]['quantity'];
                        $item_subtotal = $product['price'] * $item_quantity;
                        echo "<tr>";
                        echo "<td>";
                        echo "<div class='cart-item'>";
                        echo  "<form class='remove-cart-item backup' action='../php/remove-from-cart.php' method='post'>";
                        echo "<button name='cart-id' value=" . $cart_item_id .">✖</button>";
                        echo "</form>";
                        echo "<img src=../images/products/" . $product['product_main_image'] . " alt='A picture of the described product.'>";
                        echo "<a href='../pages/product.php?product=" . $product['product_id'] . "'>" . $product['product_name'] . "</a>";
                        echo "</div>";
                        echo "</td>";
                        echo "<td>";
                        echo "<p>$" . $product['price'] . "</p>";
                        echo "</td>";
                        echo "<td>";
                        echo "<form action='../php/change-cart-quantity.php' method='post'>";
                        echo "<button name='action' value='reduce' class='change-purchase-amount' type='submit' ";
                        if($item_quantity == '1') {echo "disabled";}
                        echo ">-</button>";
                        echo "<input name='addtocart-amount' class='addtocart-amount' type='number' min='1' max=" . $product['stock_on_hand'] . " step='1' value=" . $item_quantity . " readonly>";
                        echo "<button name='action' value='increase' class='change-purchase-amount' type='submit' ";
                        if($item_quantity == $product['stock_on_hand']) {echo "disabled";} 
                        echo ">+</button>";
                        echo "<input name='cart_item' value=" . $cart_item_id ." hidden>";
                        echo "</form>";
                        echo "</td>";
                        echo "<td>";
                        echo "<p>$" . $item_subtotal;
                        echo  "<form class='remove-cart-item' action='../php/remove-from-cart.php' method='post'>";
                        echo "<button name='cart-id' value=" . $cart_item_id .">✖</button>";
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                        $cart_index++;
                        $cart_subtotal += $item_subtotal;
                    endforeach;
                echo 
                "
                </table>
                </div>
                <aside>
                    <div class='cart-total'>
                        <p>Total</p>
                        <div>
                            <p>$" . $cart_subtotal . "</p>
                            <p>Inc. GST</p>
                        </div>
                    </div>
                    <button id='checkout-button' class='button--standard'>CHECKOUT</button>
                </aside>
                ";
                }
                ?> 
        </div>
    </main>
    <script src="../js/components/footer.js"></script>
</body>
</html>