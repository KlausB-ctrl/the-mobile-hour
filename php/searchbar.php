<?php
if(isset($_GET['order'])) {
    $sortby_order = $_GET['order'];
} else {
    $sortby_order = "DESC";
};

echo 
"
<div class='searchbar'>
    <form class='searchbar__container' action='../pages/products-search.php' method='get'>
        <select name='brand'>
            <option value='all'>ALL BRANDS</option>
";

$manufacturer_sql = "SELECT * FROM manufacturer";
$manufacturer_statement = $conn->prepare($manufacturer_sql);
$manufacturer_statement->execute();
$manufacturer_result = $manufacturer_statement->fetchAll();
$manufacturer_statement->closeCursor();

foreach($manufacturer_result as $brand):
    $brand_id = $brand['manufacturer_id'];
    $brand_name = $brand['name'];
    echo "<option value=$brand_id>$brand_name</option>";
endforeach;

echo 
"
        </select>
        <input name='product' placeholder='Search for an item...'>
        <button class='button--standard' type='submit'>SEARCH</button>
        <input type='hidden' name='order' value=$sortby_order>
    </form>
</div>
";

?>
