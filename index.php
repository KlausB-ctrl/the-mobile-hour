<?php include "model/connect.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/styles.css">
  <title>The Mobile Hour</title>
  <script src="https://kit.fontawesome.com/a3443240ca.js" crossorigin="anonymous"></script>
</head>
<body>
  <script src="./js/components/header.js"></script>
  <div class="banner--large">
    <div class="banner__container--large">
      <h1>Galaxy A53 5G</h1>
      <p>
          The new Galaxy A series represents the most popular Galaxy smartphone category, 
          leading the democratization of the latest Galaxy innovations.
      </p>
      <button class="button--standard">SHOP NOW</button>
    </div>
</div>
  <div class="benefit-banner">
    <div class="benefit">
        <img src="./images/benefits/express.png" alt="A depiction of a truck moving very quickly.">
        <p>Free Express Shipping</p>
    </div>
    <div class="benefit">
        <img src="./images/benefits/positive-reviews.png" alt="A depiction of a hand with it's thumb up and three stars above.">
        <p>100+ Positive Customer Reviews</p>
    </div>
    <div class="benefit">
        <img src="./images/benefits/ssl.png" alt="A shield with the letters 'SSL' inside.">
        <p>Safe Shopping</p>
    </div>
    <div class="benefit">
        <img src="./images/benefits/warranty.png" alt="A badge with a tick inside.">
        <p>Comprehensive Warranty</p>
    </div>
</div>
  <section class="product-banner background--gray">
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
        $product_path = "./images/products/";
        foreach($result as $product):
            $product_id = $product['product_id'];
            $url = "./pages/product.php?product=$product_id";
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
  </section>
  <section class="product-banner">
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
            $url = "./pages/product.php?product=$product_id";
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
  </section>
  <script src="./js/components/footer.js"></script>
</body>
</html>