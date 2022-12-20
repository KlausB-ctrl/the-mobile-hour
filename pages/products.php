<?php include '../model/connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Products | The Mobile Hour</title>
    <script src="https://kit.fontawesome.com/a3443240ca.js" crossorigin="anonymous"></script>
</head>
<body>
    <script src="../js/components/header.js"></script>
    <?php include '../php/searchbar.php'; ?>
    <section class="banner--regular">
        <div class="banner__container--regular">
            <h1>iPhone 14 Pro Max</h1>
            <p>
                A magical new way to interact with iPhone. A vital new safety feature designed 
                to save lives. An innovative 48MP camera for mind-blowing detail. All powered 
                by the ultimate smartphone chip.
            </p>
            <h2>$1,899.99</h2>
            <button class="button--standard" onclick="location.href='./products-search.php?brand=5&product=iPhone+14+Pro+Max'">SHOP NOW</button>
        </div>
    </section>
    <section class="small-banners__container">
        <div class="banner--small">
            <div class="banner--small__information">
                <h3>All New 5G</h3>
                <p>Shop 5G phones and enjoy ultra-fast broadband connections with the first next-gen phones!</p>
                <button class="button--standard" onclick="location.href='./products-search.php?brand=all&product=5g'">SHOP NOW</button>
            </div>
            <img src="../images/banners/5g.png" alt="An image of a Samsuing Galaxy A73 5G.">
        </div>
        <div class="banner--small">
        <div class="banner--small__information">
                <h3>Pixel 6 Pro</h3>
                <p>Capture brilliant colour and vivid detail with Pixel's best-in-class computational photography and new pro-level lenses.</p>
                <button class="button--standard" onclick="location.href='./products-search.php?brand=2&product=Pixel+6+Pro'">SHOP NOW</button>
            </div>
            <img src="../images/banners/pixel6.png" alt="An image of a Google Pixel 6.">
        </div>
    </section>
    <div class="product-banner">
        <h3>Best Sellers</h3>
        <div class="product-banner__container">
            <?php
            // Prepared statement
            $sql = "SELECT product_id, product_name, price, product_main_image FROM product ORDER BY quantity_sold DESC LIMIT 5";
            $statement = $conn->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll();
            $statement->closeCursor();

            // Display Results
            $product_path = "../images/products/";
            foreach($result as $product):
                $product_id = $product['product_id'];
                $url = "./product.php?product=$product_id";
                echo "<div class='product' onclick='window.location.href=\"$url\"'>";
                echo "<div class='product__image'>";
                echo "<img src='" . $product_path . $product['product_main_image'] . "' alt='A picture of the described product.'>";
                echo "</div>";
                echo "<h5>" . $product['product_name'] . "</h5>";
                echo "<p>$" . $product['price'] . "</p>";
                echo "</div>";
            endforeach;
            ?>
    </div>
  </div>
  <div class="product-banner">
    <h3>New Products</h3>
    <div class="product-banner__container">
      <?php
        // Prepared statement
        $sql = "SELECT product_id, product_name, price, product_main_image FROM product ORDER BY product_id DESC LIMIT 5";
        $statement = $conn->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();

        // Display Results
        foreach($result as $product):
            $product_id = $product['product_id'];
            $url = "./product.php?product=$product_id";
            echo "<div class='product' onclick='window.location.href=\"$url\"'>";
            echo "<div class='product__image'>";
            echo "<img src='" . $product_path . $product['product_main_image'] . "' alt='A picture of the described product.'>";
            echo "</div>";
            echo "<h5>" . $product['product_name'] . "</h5>";
            echo "<p>$" . $product['price'] . "</p>";
            echo "</div>";
        endforeach;
      ?>
    </div>
  </div>
<script src="../js/components/footer.js"></script>
</body>
</html>