<?php 
include '../conn.php';
$category_name = $_GET['category_name'];
$product_parent_name = $_GET['parent_product_name'];
$id = $_GET['parent_product_id'];
$url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/orders.css">
    <link rel="stylesheet" href="./css/sidepanel.css">
    <title>Products</title>
</head>
<body>
    <div class="sidepanel">
    <?php include './sidepanel.php' ?>
    </div>
    <div class="container">
        <div class="top">
            <h2>Products</h2>
        </div>
        <section style="padding: 15px">
        <p>Category > <?php echo $category_name.' > '.$product_parent_name ?></p>
            <table style="margin-top: 15px">
                <thead>
                    <form action="product-add" method="get" id="form"><input type="hidden" name="parent_product_id" value="<?php echo $id ?>"><input type="hidden" name="url" value="<?php echo $url ?>"></form>
                    <th onclick="document.getElementById('form').submit()" colspan="4" class="add_new_product_button">Add New Product</th>
                </thead>
                <thead>
                    <th class="number">#</th>
                    <th>Category Name</th>
                    <th class="action_th">Action</th>
                    <th class="action_th">Action</th>
                </thead>
                <tbody>
                    <?php
                    $product_parent_name = $_GET['parent_product_name'];
                    $select_products = "SELECT * FROM `products` WHERE `product_parent_id`='$id' ORDER BY `product_id` DESC";
                    $select_products_query = mysqli_query($conn, $select_products);
                    $products_row = mysqli_num_rows($select_products_query);
                    $i = 1;
                    while($fetch_product = mysqli_fetch_array($select_products_query)){
                    $a = $i++;
                    ?>
                    <tr>
                        <td style="width: 25%" class="number"><?php echo $a ?></td>
                        <td style="width: 25%"><?php echo $fetch_product['product_name'] ?></td>
                        <?php
                        if($fetch_product['product_status']=="In Stock"){ ?>
                        <td style="width: 25%" class="order_proceed action_button_divs"><form action="products" method="get"><input type="hidden" name="parent_product_name" value="<?php echo $fetch_product['product_id'] ?>"><button class="see_more_button">See More</button></form></td>
                        <?php
                        }elseif($fetch_product['product_status']=="Out Of Stock"){ ?>
                        <td style="width: 25%" class="order_proceed action_button_divs"><form action="products" method="get"><input type="hidden" name="parent_product_name" value="<?php echo $fetch_product['product_id'] ?>"><button class="see_more_button">See More</button></form></td>
                        <?php
                        }
                        ?>
                        <td style="width: 25%" class="delete_button order_proceed action_button_divs"><form action="product-delete" method="get"><input type="hidden" name="product_id" value="<?php echo $fetch_product['product_id'] ?>"><input type="hidden" name="url" value="<?php echo $url ?>"><button class="see_more_button">Delete</button></form></td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </section>
        <div class="tablegrandparent">
            <div id="tableparent" class="tableparent">
            </div>
        </div>
    </div>
    <script src="./scripts/script.js"></script>
</body>
</html> 