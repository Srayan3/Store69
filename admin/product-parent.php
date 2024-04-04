<?php 
include '../conn.php';
$category_name = $_GET['category_name'];
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
        <p>Category > <?php echo $category_name ?></p>
            <table>
                <thead>
                    <th class="number">#</th>
                    <th>Category Name</th>
                    <th class="action_th">Action</th>
                </thead>
                <tbody>
                    <?php
                    $id = $_GET['category_id'];
                    $select_category = "SELECT * FROM `parent_product` WHERE `parent_product_category`='$id' ORDER BY `parent_product_id` ASC";
                    $select_category_query = mysqli_query($conn, $select_category);
                    $category_row = mysqli_num_rows($select_category_query);
                    $i = 1;
                    while($fetch_category = mysqli_fetch_array($select_category_query)){
                    $a = $i++;
                    ?>
                    <tr>
                        <td style="width: 20%" class="number"><?php echo $a ?></td>
                        <td style="width: 40%"><?php echo $fetch_category['parent_product_name'] ?></td>
                        <td style="width: 40%" class="order_proceed action_button_divs"><form action="products" method="get"><input type="hidden" name="parent_product_id" value="<?php echo $fetch_category['parent_product_id'] ?>"><input type="hidden" name="parent_product_name" value="<?php echo $fetch_category['parent_product_name'] ?>"><input type="hidden" name="category_name" value="<?php echo $category_name ?>"><button class="see_more_button">See More</button></form></td>
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