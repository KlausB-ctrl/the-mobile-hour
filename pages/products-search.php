<?php include '../model/connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Search Results | Products | The Mobile Hour</title>
    <script src="https://kit.fontawesome.com/a3443240ca.js" crossorigin="anonymous"></script>
</head>
<body>
    <script src="../js/components/header.js"></script>
    <?php include '../php/searchbar.php'; ?>
    <?php 
    // Get the search term and store it as a variable
    $product_searched = $_GET['product'];

    // Get the selected brand and store it's ID as a variable
    $brand_searched = $_GET['brand'];

    // Check if the display order has been set
    if(isset($_GET['order'])) {
        // If it has, save it as a variable
        $order = $_GET['order'];
    } else {
        // If it has not been set, default to descending order
        $order = "DESC";
    }

    // Check if the sorting method has been set
    if(isset($_GET['sortby'])) {
        // If it has been set, store the column name as a variable
        $sortby = $_GET['sortby'];
    } else {
        // If it has not been set, default to sorting by best selling
        $sortby = "quantity_sold";
    }

    // Handle the brand select field value
    if($brand_searched == 'all') {
        // If the brand select field is set to 'ALL BRANDS', the SQL query will NOT sort by manufacturer
        $sql = "SELECT * FROM product WHERE product_name LIKE '%$product_searched%' ORDER BY $sortby $order";
        $brand_name = 'All Brands';

    } else {
        // If a specific brand is selected, only select rows with the specified brand
        $sql = "SELECT * FROM product WHERE product_name LIKE '%$product_searched%' AND manufacturer_manufacturer_id = '$brand_searched' ORDER BY $sortby $order";
        $brand_sql = "SELECT name FROM manufacturer WHERE manufacturer_id = $brand_searched";
        $brand_statement = $conn->prepare($brand_sql);
        $brand_statement->execute();
        $brand_result = $brand_statement->fetchAll();
        $brand_statement->closeCursor();
        $brand_name = $brand_result[0]['name'];
    }
    
    // Finish preparing and executing the SQL query
    $statement = $conn->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll();
    $statement->closeCursor();

    ?>
    <div class="breadcrumbs">
        <p><a href="../index.php">Home</a> > <a href="./products.php">Products</a> > <a href=<?php echo "../pages/products-search.php?brand=$brand_searched&product="; ?>><strong><?php echo $brand_name; ?></strong></a><a></a></p>
</div>
    <div class="product-banner">
        <h3><?php if($product_searched == "") {echo "Showing results for $brand_name.";} else {echo "Search results for '$product_searched'.";}?></h3>
        <form id="sort-and-show" class="sort-and-show" action="./products-search.php" method="get">
            <input type="hidden" name="brand" value=<?php echo $brand_searched; ?>>
            <input type="hidden" name="product" value=<?php echo $product_searched; ?>>
            <div class="sort-by">
                <p>Sort By</p>
                <select name="sortby" id="sortby" onchange="this.form.submit()">
                    <option value="stock_on_hand" <?php if($sortby == "stock_on_hand") {echo "selected";} ?>>Best Selling</option>
                    <option value="price" <?php if($sortby == "price") {echo "selected";} ?>>Price</option>
                    <option value="product_id" <?php if($sortby == "product_id") {echo "selected";} ?>>Date Added</option>
                </select>
                <button id="sort-by-order" type="button"><?php if($order == "DESC") {echo "🠋";} else {echo "🠉";}; ?></button>
                <input id="sort-by-order-input" type="hidden" name="order" value=<?php if($order == "DESC") {echo "DESC";} else {echo "ASC";}; ?>>
            </div>
        </form>
        <div class="product-banner__container grid--gridnogrow">
            <?php
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
    <script src="../js/components/footer.js"></script>
    <script src="../js/button-scripts/change-sortby-order.js"></script>
</body>
</html>