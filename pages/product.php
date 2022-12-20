<?php include '../model/connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <?php
    $product = $_GET['product'];

    $sql = "SELECT * FROM product WHERE product_id = $product";
    $statement = $conn->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll();
    $statement->closeCursor();

    $productDetails = $result[0];
    $imagePath = "../images/products/";

    echo "<title>" . $productDetails['product_name'] . " | Products | The Mobile Hour</title>";
    ?>
    <script src="https://kit.fontawesome.com/a3443240ca.js" crossorigin="anonymous"></script>
</head>
<body>
    <script src="../js/components/header.js"></script>
    <?php include '../php/searchbar.php'; ?>
    <div class="breadcrumbs">
        <p><a href="../index.php">Home</a> > <a href="./products.php">Products</a> > <a><strong><?php echo $productDetails['product_name']; ?></strong></a>
</div>
    <main class="product-page">
        <div class="product-page__left">
            <div class="product-page__left__images">
                <img src=<?php echo $imagePath . $productDetails['product_main_image']?> class="product__main-image" alt='A picture of the described product.'>
                <div class="product-page__left__images__grid">
                    <?php
                    $images_sql = "SELECT image_path FROM product_image WHERE product_product_id = $product";
                    $images_statement = $conn->prepare($images_sql);
                    $images_statement->execute();
                    $images_result = $images_statement->fetchAll();
                    $images_statement->closeCursor();

                    foreach($images_result as $image):
                        echo "<img src=" . $imagePath . $image['image_path'] . " alt='A picture of the described product.'>";
                    endforeach;
                    ?>
                </div>
            </div>
        </div>
        <section class="product-page__right">
            <h1><?php echo $productDetails['product_name'] ?></h1>
            <p class="product-sku">SKU: <?php echo $productDetails['product_model'] ?>
            <p class="product-price">$<?php echo $productDetails['price'] ?></p>
            <p class="product-stock"><?php echo $productDetails['stock_on_hand']; ?> in stock.</p>
            <form class="product-page__buttons" action="../php/add-to-cart.php?product=<?php echo $productDetails['product_id']; ?>" method="post">
                <button id="reduce-addtocart" class="change-purchase-amount" type="button" disabled>-</button>
                <input name="addtocart-amount" id="addtocart-amount" type="number" min="1" max=<?php echo $productDetails['stock_on_hand']?> step="1" value="1" readonly>
                <button id="increase-addtocart" class="change-purchase-amount" type="button">+</button>
                <button id="addtocart" class="button--standard" type="submit" value="Submit">ADD TO CART</button>
                <button id="toggle-wishlist">♡</button>
            </form>
            <?php 
            if(isset($_GET['over-quantity'])) {
                if($_GET['over-quantity'] == 'true') {
                    echo "<p class='cart-over-quantity'>Cart total would exceed product stock of " . $productDetails['stock_on_hand'] . ".</p>";
                } else {
                    echo "<p class='added-to-cart'>Product added to cart.</p>";

                }
            }; 
            ?>
            <h3>Description</h3>
            <?php echo $productDetails['product_description'] ?>
            <h3 class="product-features">Features</h3>
            <?php 
            $feature_id = $productDetails['feature_feature_id'];
            $feature_sql = "SELECT * FROM feature WHERE feature_id = $feature_id";
            $feature_statement = $conn->prepare($feature_sql);
            $feature_statement->execute();
            $feature_result = $feature_statement->fetchAll();
            $feature_statement->closeCursor();

            $features = $feature_result[0];

            echo 
            "
            <table>
                <tr>
                    <td><strong>Weight</strong></td>
                    <td>" . $features['weight'] . "</td>
                </tr>
                <tr>
                    <td><strong>Dimensions</strong></td>
                    <td>" . $features['dimensions'] . "</td>
                </tr>
                <tr>
                    <td><strong>OS</strong></td>
                    <td>" . $features['OS'] . "</td>
                </tr>
                <tr>
                    <td><strong>Screen Size</strong></td>
                    <td>" . $features['screensize'] . "</td>
                </tr>
                <tr>
                    <td><strong>Resolution</strong></td>
                    <td>" . $features['resolution'] . " pixels</td>
                </tr>
                <tr>
                    <td><strong>CPU</strong></td>
                    <td>" . $features['CPU'] . "</td>
                </tr>
                <tr>
                    <td><strong>RAM</strong></td>
                    <td>" . $features['RAM'] . "</td>
                </tr>
                <tr>
                    <td><strong>Storage</strong></td>
                    <td>" . $features['storage'] . "</td>
                </tr>
                <tr>
                    <td><strong>Battery</strong></td>
                    <td>" . $features['battery'] . "</td>
                </tr>
                <tr>
                    <td><strong>Rear Camera</strong></td>
                    <td>" . $features['rear_camera'] . "</td>
                </tr>
                <tr>
                    <td><strong>Front Camera</strong></td>
                    <td>" . $features['front_camera'] . "</td>
                </tr>
            </table>
            "
            ?>
        </section>
    </main>
    <script src="../js/components/footer.js"></script>
    <script src="../js/button-scripts/change-cart-quantity.js"></script>
</body>
</html>