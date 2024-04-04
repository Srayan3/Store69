<?php
include './conn.php';
$id = $_GET['id'];
$thumbnail = $_GET['thumbnail'];
$name = $_GET['name'];
if(isset($_COOKIE['email'])){
    $user_status = "found";
    $email = $_COOKIE['email'];
    $select_user = "SELECT * FROM `users` WHERE `email`='$email'";
    $select_user_query = mysqli_query($conn, $select_user);
    $user_row = mysqli_num_rows($select_user_query);
    $fetch = mysqli_fetch_array($select_user_query);
}else {
    $user_status = "not_found";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/catagory.css">
    <title>Document</title>
</head>
<body>
    <?php include 'sidenav.php' ?>
    <div class="container_parent">
        <div class="container">
            <?php include 'topnav.php' ?>
            <section class="products_page">
                <div class="product_page_child">
                    <div class="product_thumbnail">
                        <img src="<?php echo $thumbnail ?>" alt="">
                        <div class="name_box"><?php echo $name ?></div>
                    </div>
                    <div class="order_part">
                        <h1><button type="button" class="proc_number">1</button>Select an option</h1>
                        <div class="options_parent">
                            <?php
                            $select_products = "SELECT * FROM `products` WHERE `product_parent_id`='$id' ORDER BY `product_id` ASC LIMIT 20";
                            $select_products_query = mysqli_query($conn, $select_products);
                            $product_rows = mysqli_num_rows($select_products_query);
                            $x = 1;
                            while($fetch_products = mysqli_fetch_array($select_products_query)){
                            $z = $x++;
                            ?>
                            <div onclick="<?php echo 'option'.$z.'()' ?>" id="<?php echo 'option'.$z ?>" class="options option1"><?php echo $fetch_products['product_name'] ?></div>
                            <?php
                            }
                            ?>
                            <!-- price section -->
                            <div class="price_part" id="option1_price">
                                <?php
                                $select_products2 = "SELECT * FROM `products` WHERE `product_parent_id`='$id' ORDER BY `product_id` ASC LIMIT 20";
                                $select_products_query2 = mysqli_query($conn, $select_products2);
                                $product_rows2 = mysqli_num_rows($select_products_query2);
                                $y = 1;
                                while($fetch_products2 = mysqli_fetch_array($select_products_query2)){
                                $w = $y++;
                                ?>
                                <div id="price_div<?php echo $w ?>" class="price_div">
                                    <h1 style="font-size: 20px; font-weight: bold;">Product: <span><?php echo $fetch_products2['product_name'] ?></span></h1>
                                    <h1 style="font-weight: bold; margin-top: 5px">Price: <span style="font-weight: bolder; color: #29A843;"><?php echo $fetch_products2['product_price'].' BDT' ?></span></h1>
                                    <form action="order-process" method="post">
                                        <input type="hidden" name="id" value="<?php echo $fetch_products2['product_id'] ?>">
                                        <button class="buy_now_button">Buy Now</button>
                                    </form>
                                </div>
                                <?php
                                }
                                ?>
                            </div>
                            <script>
                                <?php
                                $select_products3 = "SELECT * FROM `products` WHERE `product_parent_id`='$id' ORDER BY `product_id` ASC LIMIT 20";
                                $select_products_query3 = mysqli_query($conn, $select_products3);
                                $product_rows3 = mysqli_num_rows($select_products_query3);
                                $a = 1;
                                while($fetch_products3 = mysqli_fetch_array($select_products_query3)){
                                $b = $a++;
                                ?>
                                function <?php echo 'option'.$b.'()' ?> {
                                    <?php
                                    $select_products4 = "SELECT * FROM `products` WHERE `product_parent_id`='$id' ORDER BY `product_id` ASC LIMIT 20";
                                    $select_products_query4 = mysqli_query($conn, $select_products3);
                                    $product_rows4 = mysqli_num_rows($select_products_query4);
                                    $o = 1;
                                    while($fetch_products4 = mysqli_fetch_array($select_products_query4)){
                                    $p = $o++;
                                    ?>
                                    document.getElementById('<?php echo 'price_div'.$p ?>').style.display = "none"
                                    <?php
                                    }
                                    ?>
                                    document.getElementById('<?php echo 'price_div'.$b ?>').style.display = "block"
                                }
                                <?php
                                }
                                ?>
                            </script>
                        </div>
                    </div>
                </div>
            </section>
            <?php include './footer.php' ?>
        </div>
    </div>
    <script>
        function scrolll(){
            var left = document.querySelector(".products");
            left.scrollBy(150, 0);
        }
        function scrollr(){
            var left = document.querySelector(".products");
            left.scrollBy(-150, 0);
        }
    </script>
    <script src="./js/script.js"></script>
</body>
</html>