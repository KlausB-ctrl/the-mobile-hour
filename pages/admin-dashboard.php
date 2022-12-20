<?php 
include "../model/connect.php"; 

session_start();

if(!isset($_SESSION['id'])) {
    header("Location: ./admin-login.php");
}

$manufacturer_sql = "SELECT * FROM manufacturer";
$manufacturer_statement = $conn->prepare($manufacturer_sql);
$manufacturer_statement->execute();
$manufacturer_result = $manufacturer_statement->fetchAll();
$manufacturer_statement->closeCursor();

if(isset($_GET['product-name'])) {
    $product_searched = $_GET['product-name'];
} else {
    $product_searched = "all";
}

if(isset($_GET['brand'])) {
    $brand_searched = $_GET['brand'];
} else {
    $brand_searched = "all";
}

if(isset($_GET['show'])) {
    $show_quantity = intval($_GET['show']);
} else {
    $show_quantity = 6;
}

if($product_searched == "all") {
    if($brand_searched == "all") {
        $product_length_sql = "SELECT product_id FROM product";
    } else {
        $product_length_sql = "SELECT product_id FROM product WHERE manufacturer_manufacturer_id = $brand_searched";
    }
} else {
    if($brand_searched == "all") {
        $product_length_sql = "SELECT product_id FROM product WHERE product_name LIKE '%$product_searched%'";
    } else {
        $product_length_sql = "SELECT product_id FROM product WHERE product_name LIKE '%$product_searched%' AND manufacturer_manufacturer_id = $brand_searched";
    }
}

$product_length_statement = $conn->prepare($product_length_sql);
$product_length_statement->execute();
$product_length_result = $product_length_statement->fetchAll();
$product_length_statement->closeCursor();

$products_result_quantity = sizeof($product_length_result);
$required_button_quantity = ceil($products_result_quantity / $show_quantity);

if(isset($_GET['page'])) {
    $page_number = intval($_GET['page']);
} else {
    if(isset($_GET['showing'])) {
        $page_number = $_GET['previous-page'];
    } else {
        $page_number = 1;
    }
}

$limit_start = ($page_number - 1) * $show_quantity;

if($product_searched == "all") {
    if($brand_searched == "all") {
        $product_sql = "SELECT * FROM product ORDER BY product_id DESC LIMIT $limit_start, $show_quantity";
    } else {
        $product_sql = "SELECT * FROM product WHERE manufacturer_manufacturer_id = $brand_searched ORDER BY product_id DESC LIMIT $limit_start, $show_quantity";
    }
} else {
    if($brand_searched == "all") {
        $product_sql = "SELECT * FROM product WHERE product_name LIKE '%$product_searched%' ORDER BY product_id DESC LIMIT $limit_start, $show_quantity";
    } else {
        $product_sql = "SELECT * FROM product WHERE product_name LIKE '%$product_searched%' AND manufacturer_manufacturer_id = $brand_searched ORDER BY product_id DESC LIMIT $limit_start, $show_quantity";
    }
}

$product_statement = $conn->prepare($product_sql);
$product_statement->execute();
$product_result = $product_statement->fetchAll();
$product_statement->closeCursor();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Admin Dashboard | The Mobile Hour</title>
</head>
<body>
    <main class="admin-dashboard">
        <div class="admin-dashboard__left">
            <div class="admin-dashboard__left__title">
                <h1>Products | Admin Dashboard | The Mobile Hour</h1>
            </div>
            <h2>Panels</h2>
            <button class="button--standard panel-active" onclick="location.href='./admin-dashboard.php'">Products</button>
            <button class="button--standard" onclick="location.href='./admin-dashboard-users.php'">Users</button>
            <button class="button--standard" onclick="location.href='./admin-dashboard-changelogs.php'">Changelogs</button>
        </div>
        <div class="admin-dashboard__right">
            <div class="admin-dashboard__right__header">
            </div>
            <div class="admin-dashboard__right__content">
                <div class="admin-dashboard__products">
                    <form class="admin-dashboard__products__list">
                        <h3>Products</h3>
                        <div class="products__list-row">
                            <input maxlength="255" name="product-name" <?php if($product_searched != "all") {echo "value=$product_searched";};?>>
                            <button type="submit" class="button--standard">Search</button>
                        </div>
                        <div class="products__list-row">
                            <select name="brand">
                                <option value="all">All Brands</option>
                                <?php 
                                    foreach($manufacturer_result as $brand):
                                        $brand_id = $brand['manufacturer_id'];
                                        $brand_name = $brand['name'];
                                        echo "<option value=$brand_id ";
                                        if($brand_searched == $brand_id) {echo "selected";};
                                        echo ">$brand_name</option>";
                                    endforeach;
                                ?>
                            </select>
                            <select name="show" onchange="this.form.submit()">
                                <option value="6" <?php if($show_quantity== 6) {echo "selected";};?>>6</option>
                                <option value="12" <?php if($show_quantity== 12) {echo "selected";};?>>12</option>
                                <option value="24" <?php if($show_quantity== 24) {echo "selected";};?>>24</option>
                                <option value="48" <?php if($show_quantity== 48) {echo "selected";};?>>48</option>
                                <option value="72" <?php if($show_quantity== 72) {echo "selected";};?>>72</option>
                            </select>
                        </div>
                        <div class="page-number-buttons">
                            <?php 
                            for ($i = 1; $i <= $required_button_quantity; $i++) {
                                echo "<button name='page' value=$i ";
                                if($page_number == $i) {echo "disabled";}
                                echo ">$i</button>";
                            }
                            ?>
                        </div>
                        <div class="admin-products-results">
                            <?php
                            $product_index = 0;
                            foreach($product_result as $product):
                                echo "<button name='showing' value=" . $product_index;
                                if($product['product_name'] == "New Product (click to edit details)") echo " class='product_button--green'";
                                echo ">" . $product['product_name'] . "</button>";
                                $product_index++;
                            endforeach;
                            echo "<input name='previous-page' value=" . $page_number . " hidden>";
                            ?>
                            <button type="submit" formaction="../php/admin-add-new-product.php" class="button--standard">+Add New Product</button>
                        </div>
                    </form>
                    <form class="admin-dashboard__products__list" action="../php/admin-product-save-changes.php" method="post">
                        <?php
                        if(isset($_GET['showing'])) {
                            $displayed_product = $product_result[$_GET['showing']];
                            $feature_id = $displayed_product['feature_feature_id'];
                            $feature_sql = "SELECT * FROM feature WHERE feature_id = $feature_id";
                            $feature_statement = $conn->prepare($feature_sql);
                            $feature_statement->execute();
                            $feature_result = $feature_statement->fetchAll();
                            $feature_statement->closeCursor();
                            $product_features = $feature_result[0];
                        } else {
                            $displayed_product = false;
                            $product_features = false;
                        }
                        ?>
                        <div class="admin-dashboard__products__list__product-details">
                            <h3>Product Details</h3>
                            <h3>Product ID: <?php if($displayed_product) {echo $displayed_product['product_id'];} else {echo "No Product Selected";}?></h3>
                            <input name="product-id" <?php if($displayed_product) {echo "value='" . $displayed_product['product_id'] . "'";}?> hidden>
                            <div>
                                <label for="product-name">Name</label>
                                <input name="product-name" id="product-name" maxlength="255" <?php if($displayed_product) {echo "value='" . $displayed_product['product_name'] . "'";}?>>
                            </div>
                            <div>
                                <label for="product-model">Model</label>
                                <input name="product-model" id="product-model" maxlength="255" <?php if($displayed_product) {echo "value='" . $displayed_product['product_model'] . "'";}?>>
                            </div>
                            <div>
                                <label for="product-brand">Brand</label>
                                <select name="product-brand" id="product-brand">
                                <?php
                                if($displayed_product) {
                                    foreach($manufacturer_result as $brand):
                                        $brand_id = $brand['manufacturer_id'];
                                        $brand_name = $brand['name'];
                                        echo "<option value=$brand_id ";
                                        if($displayed_product['manufacturer_manufacturer_id'] == $brand_id) {echo "selected";};
                                        echo ">$brand_name</option>";
                                    endforeach;
                                }
                                ?>
                                </select>
                            </div>
                            <div>
                                <label for="product-price">Price</label>
                                <input name="product-price" id="product-price" type="number" <?php if($displayed_product) {echo "value='" . $displayed_product['price'] . "'";}?>>
                            </div>
                            <div>
                                <label for="product-stock">Stock</label>
                                <input name="product-stock" id="product-stock" type="number" maxlength="10" pattern="[0-9]" <?php if($displayed_product) {echo "value='" . $displayed_product['stock_on_hand'] . "'";}?>>
                            </div>
                            <div>
                                <label for="product-sold">Sold</label>
                                <input name="product-sold" id="product-sold" type="number" <?php if($displayed_product) {echo "value='" . $displayed_product['quantity_sold'] . "'";}?>>
                            </div>
                            <div class="grid--fullrow">
                                <label for="product-image">Main Image Path (brand/model/colour/filename.extension)</label>
                                <input name="product-image" id="product-image" maxlength="255" <?php if($displayed_product) {echo "value='" . $displayed_product['product_main_image'] . "'";}?>>
                            </div>
                            <div class="grid--fullrow">
                                <label for="product-description">Description (HTML)</label>
                                <textarea name="product-description" id="product-description"></textarea>
                                <button id="product-description-store" hidden><?php if($displayed_product) {echo $displayed_product['product_description'];}; ?></button>
                            </div>
                        </div>
                        <div class="admin-dashboard__products__list__feature-details">
                            <h3 class="grid--fullrow">Features</h3>
                            <div>
                                <label for="feature-id">Feature ID</label>
                                <input name="feature-id" id="feature-id" type="number" <?php if($product_features) {echo "value='" . $product_features['feature_id'] . "'";}?> disabled>
                                <input name="feature-id" type="number" <?php if($product_features) {echo "value='" . $product_features['feature_id'] . "'";}?> hidden>
                            </div>
                            <div>
                                <label for="feature-weight">Weight (XXXg)</label>
                                <input name="feature-weight" id="feature-weight" maxlength="10"<?php if($product_features) {echo "value='" . $product_features['weight'] . "'";}?>>
                            </div>
                            <div>
                                <label for="feature-dimensions">Dimensions (XXX x XXX x XXX mm)</label>
                                <input name="feature-dimensions" id="feature-dimensions" maxlength="100" <?php if($product_features) {echo "value='" . $product_features['dimensions'] . "'";}?>>
                            </div>
                            <div>
                                <label for="feature-os">OS</label>
                                <input name="feature-os" id="feature-os" maxlength="100" <?php if($product_features) {echo "value='" . $product_features['OS'] . "'";}?>>
                            </div>
                            <div>
                                <label for="feature-screensize">Screensize (X.X inches)</label>
                                <input name="feature-screensize" id="feature-screensize" maxlength="100" <?php if($product_features) {echo "value='" . $product_features['screensize'] . "'";}?>>
                            </div>
                            <div>
                                <label for="feature-resolution">Resolution (XXXXxXXXX)</label>
                                <input name="feature-resolution" id="feature-resolution" maxlength="10" <?php if($product_features) {echo "value='" . $product_features['resolution'] . "'";}?>>
                            </div>
                            <div>
                                <label for="feature-cpu">CPU</label>
                                <input name="feature-cpu" id="feature-cpu" maxlength="100" <?php if($product_features) {echo "value='" . $product_features['CPU'] . "'";}?>>
                            </div>
                            <div>
                                <label for="feature-ram">RAM (XXGB)</label>
                                <input name="feature-ram" id="feature-ram" maxlength="100" <?php if($product_features) {echo "value='" . $product_features['RAM'] . "'";}?>>
                            </div>
                            <div>
                                <label for="feature-storage">Storage (XXGB)</label>
                                <input name="feature-storage" id="feature-storage" maxlength="100" <?php if($product_features) {echo "value='" . $product_features['storage'] . "'";}?>>
                            </div>
                            <div>
                                <label for="feature-battery">Battery (XXXX mAh)</label>
                                <input name="feature-battery" id="feature-battery" maxlength="100" <?php if($product_features) {echo "value='" . $product_features['battery'] . "'";}?>>
                            </div>
                            <div>
                                <label for="feature-rearcamera">Rear Camera (X.XMP)</label>
                                <input name="feature-rearcamera" id="feature-rearcamera" maxlength="255" <?php if($product_features) {echo "value='" . $product_features['rear_camera'] . "'";}?>>
                            </div>
                            <div>
                                <label for="feature-frontcamera">Front Camera (X.XMP)</label>
                                <input name="feature-frontcamera" id="feature-frontcamera" maxlength="255" <?php if($product_features) {echo "value='" . $product_features['front_camera'] . "'";}?>>
                            </div>
                            <button name="action" value="save" class="button--standard" <?php if(!isset($_GET['showing'])) {echo "disabled";}?>>Save Changes</button>
                            <div></div>
                            <button name="action" value="delete" class="button--standard button--standard--red" <?php if(!isset($_GET['showing'])) {echo "disabled";}?> onclick="return confirm('Are you sure?')">Delete Item</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <script src="../js/misc/add-description-text.js"></script>
</body>
</html>