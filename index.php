<?php
include './conn.php';
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
    <link rel="stylesheet" href="css/home.css">
    <title>Store 69</title>
</head>
<body>
    <?php include './sidenav.php' ?>
    <div class="container_parent">
        <div class="container">
            <?php include './topnav.php' ?>
            <section class="banner_parent">
                <img class="banner" src="./img/banner-min.png" alt="">
            </section>
            <section class="products_page">
                <?php
                $select_category = "SELECT * FROM `categories` ORDER BY `category_order`";
                $select_category_query = mysqli_query($conn, $select_category);
                $select_category_row = mysqli_num_rows($select_category_query);
                while($fetch_category = mysqli_fetch_array($select_category_query)){
                ?>
                <div class="catagory">
                    <div class="catagory_header">
                        <h1 class="catagory_title"><?php echo $fetch_category['category_name'] ?></h1>
                        <div class="navigator">
                            <svg onclick="scrollr()" class="navigator-buttons nav-btn-one" style="color: white;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-7 cursor-pointer"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5"></path></svg>
                            <a href="<?php echo './category?category='.$fetch_category['category_id'] ?>"><button class="navigator_all_button">All</button></a>
                            <svg onclick="scrolll()" class="navigator-buttons" style="color: white;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-7 cursor-pointer"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"></path></svg>
                        </div>
                    </div>
                    <div id="products" class="products">
                    <?php
                    $parent_product_category = $fetch_category['category_id'];
                    $select_parent_products = "SELECT * FROM `parent_product` WHERE `parent_product_category`='$parent_product_category'";
                    $select_parent_product_query = mysqli_query($conn, $select_parent_products);
                    $select_parent_product_row = mysqli_num_rows($select_parent_product_query);
                    while($fetch_parent_product = mysqli_fetch_array($select_parent_product_query)){
                    ?>
                        <?php
                        $redirect = 'product?id='.$fetch_parent_product['parent_product_id'].'&thumbnail='.$fetch_parent_product['parent_product_image'].'&name='.$fetch_parent_product['parent_product_name'];
                        ?>
                        <div onclick="window.location.href='<?php echo $redirect ?>'" class="product">
                            <div class="product_image">
                                <img src="<?php echo $fetch_parent_product['parent_product_image'] ?>" alt="">
                            </div>
                            <div class="product_price">
                                <button>
                                    <?php
                                    $parent_product = $fetch_parent_product['parent_product_id'];
                                    $select_lowest_price = "SELECT * FROM `products` WHERE `product_parent_id`='$parent_product' ORDER BY `product_id` ASC";
                                    $select_lowest_price_query = mysqli_query($conn, $select_lowest_price);
                                    $lowest_price_row = mysqli_num_rows($select_lowest_price_query);
                                    $fetch_lowest_price = mysqli_fetch_array($select_lowest_price_query);

                                    $select_highest_price = "SELECT * FROM `products` WHERE `product_parent_id`='$parent_product' ORDER BY `product_id` DESC";
                                    $select_highest_price_query = mysqli_query($conn, $select_highest_price);
                                    $highest_price_row = mysqli_num_rows($select_highest_price_query);
                                    $fetch_highest_price = mysqli_fetch_array($select_highest_price_query)
                                    ?>
                                    <?php if($lowest_price_row > 0){echo $fetch_lowest_price['product_price'];}else{ echo '0';} ?> - <?php if($highest_price_row > 0){echo $fetch_highest_price['product_price'];}else{ echo '0';} ?>
                                </button>
                            </div>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <?php
                }
                ?>
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
        function scrollls(){
            var left = document.querySelector(".productss");
            left.scrollBy(150, 0);
        }
        function scrollrs(){
            var left = document.querySelector(".productss");
            left.scrollBy(-150, 0);
        }
        function scrolllss(){
            var left = document.querySelector(".productsss");
            left.scrollBy(150, 0);
        }
        function scrollrss(){
            var left = document.querySelector(".productsss");
            left.scrollBy(-150, 0);
        }
    </script>
    <script src="./js/script.js"></script>
</body>
</html>