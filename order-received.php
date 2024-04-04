<?php
include './conn.php';
$payment_method = $_POST['payment_method'];
$product_id = $_POST['product_id'];
$number = $_POST['number'];
$txn = $_POST['txn'];
if(isset($_COOKIE['email'])){
    $user_status = "found";
    $email = $_COOKIE['email'];
    $select_user = "SELECT * FROM `users` WHERE `email`='$email'";
    $select_user_query = mysqli_query($conn, $select_user);
    $user_row = mysqli_num_rows($select_user_query);
    $fetch = mysqli_fetch_array($select_user_query);
}else {
    $user_status = "not_found";
    header("Location: ./login");
}
$select_product = "SELECT * FROM `products` WHERE `product_id`='$product_id'";
$select_procut_query = mysqli_query($conn, $select_product);
$product_rows = mysqli_num_rows($select_procut_query);
$fetch_products = mysqli_fetch_array($select_procut_query);
$product_name = $fetch_products['product_name'];
$product_price = $fetch_products['product_price'];
$user_id = $fetch['id'];
$month = date("n");
$monthNum  = $month;
$monthName = date('F', mktime(0, 0, 0, $monthNum, 10));
$date = $monthName.' '.date("d").", ".date("Y");
$insert = "INSERT INTO `orders`(`product`, `user_id`, `payment_method`, `payment`, `payment_number`, `tnx`, `date`, `order_status`, `note`) VALUES ('$product_name','$user_id','$payment_method','$product_price','$number','$txn','$date', 'In-Progress', 'In-Progress')";
$inject = mysqli_query($conn, $insert);
if($inject){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/catagory.css">
    <title>Order Confirmed</title>
</head>
<body>
    <?php include 'sidenav.php' ?>
    <div class="container_parent">
        <div class="container">
            <?php include 'topnav.php' ?>
            <section class="products_page">
                <div class="payment_grandparent">
                    <div class="payment_parent">
                        <div class="payment_child">
                            <h1 style="text-align: center; color: white; font-size: 35px; font-weight: bold; margin-top: 20px">Order Confirmed</h1>
                            <div class="check_part">
                                <img style="width: 50%" src="./img/check.svg" alt="">
                            </div>
                            <h2 style="color: white; text-align: center; margin-top: 40px">Thanks for shopping with us</h2>
                            <div class="option_divs">
                                <button onclick="window.location.href='./'" class="post_order_button">Go to Home</button>
                                <button class="post_order_button">Track your Order</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php include './footer.php' ?>
            <script>
        function scrolll(){
            var left = document.querySelector(".products");
            left.scrollBy(150, 0);
        }
        function scrollr(){
            var left = document.querySelector(".products");
            left.scrollBy(-150, 0);
        }
        function bkash(){
            document.getElementById('paymentOption1').style.background = "#1E94FF"
            document.getElementById('paymentOption1').style.border = "2px solid white"
            document.getElementById('paymentOption2').style.background = "transparent"
            document.getElementById('paymentOption2').style.border = "2px solid grey"
            document.getElementById('bkashPart').style.display = "block";
            document.getElementById('bkashPart2').style.display = "block";
            document.getElementById('nagadPart').style.display = "none";
            document.getElementById('nagadPart2').style.display = "none";
            document.getElementById('payment_select_text').style.display = "none";
        }
        function nagad(){
            document.getElementById('paymentOption1').style.background = "transparent"
            document.getElementById('paymentOption1').style.border = "2px solid grey"
            document.getElementById('paymentOption2').style.background = "#1E94FF"
            document.getElementById('paymentOption2').style.border = "2px solid white"
            document.getElementById('bkashPart').style.display = "none";
            document.getElementById('bkashPart2').style.display = "none";
            document.getElementById('nagadPart').style.display = "block";
            document.getElementById('nagadPart2').style.display = "block";
            document.getElementById('payment_select_text').style.display = "none";
        }
    </script>
    <script src="./js/script.js"></script>
</body>
</html>
<?php
}else{
    echo 'err';
}
?>