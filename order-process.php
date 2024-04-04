<?php
include './conn.php';
$id = $_POST['id'];
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
$select_product = "SELECT * FROM `products` WHERE `product_id`='$id'";
$select_procut_query = mysqli_query($conn, $select_product);
$product_rows = mysqli_num_rows($select_procut_query);
$fetch = mysqli_fetch_array($select_procut_query);
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
                <div class="payment_grandparent">
                    <div class="payment_parent">
                        <div class="payment_child">
                            <div class="payment_options">
                                <div onclick="bkash()" id="paymentOption1" class="payment_option">
                                    <img src="./img/bkash.png" alt="">
                                </div>
                                <div onclick="nagad()" id="paymentOption2" class="payment_option">
                                    <img src="./img/nagad.png" alt="">
                                </div>
                            </div>
                            <div class="payment_details">
                                <h2 style="color: white; font-size: 28px; font-weight: bolder; text-align: center; margin-top: 50px" id="payment_select_text">Please select a payment method</h2>
                                <p id="bkashPart" style="margin-top: 30px" class="bkash-details payment_feilds">
                                    Bkash Details<br>
                                    1. Open up the bKash app & Choose “Send Money”<br>
                                    2. Enter the bKash Account Number, which is given down below<br>
                                    3. Enter the <b>exact amount</b> and Confirm the Transaction<br>
                                    4. After sending money, you’ll receive a bKash Transaction ID (TRX ID). If you Sending the Money from AGENT NUMBER just type "AGENT" in the Transaction ID field<br>
                                    <span style="color: #16A34A; font-size: 20px; display: block; margin-top: 10px">You need to send us: <b style="font-weight: bolder"><?php echo $fetch['product_price'] ?> BDT</b></span>
                                    <span style="display: block; font-size: 18px; margin-top: 15px">Account Type: Personal</span>
                                    <span style="display: block; font-size: 18px; margin-top: 15px; position: relative">Account Number: 01624447830<svg style="width: 30px; position: absolute; top: 3px" aria-hidden="true" class="inline-flex size-6 cursor-pointer text-slate-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M7 9a2 2 0 012-2h6a2 2 0 012 2v6a2 2 0 01-2 2H9a2 2 0 01-2-2V9z"></path><path d="M5 3a2 2 0 00-2 2v6a2 2 0 002 2V5h8a2 2 0 00-2-2H5z"></path></svg></span>
                                </p>
                                <form id="bkashPart2" class="payment_form payment_feilds" action="order-received" method="post">
                                    <input type="hidden" name="payment_method" value="BKash">
                                    <input type="hidden" name="product_id" value="<?php echo $id ?>">
                                    <label class="input_labet">Your BKash Account Number</label>
                                    <input class="input_field" name="number" type="number" placeholder="01XXXXXXXXX">
                                    <label class="input_labet">Your Transaction ID</label>
                                    <input class="input_field" name="txn" type="text" placeholder="Txn ID">
                                    <button class="payment_submit_button">Place Order</button>
                                </form>

                                <p id="nagadPart" style="margin-top: 30px" class="bkash-details payment_feilds">
                                    Nagad Details<br>
                                    1. Open up the Nagad app & Choose “Send Money”<br>
                                    2. Enter the Nagad Account Number, which is given down below<br>
                                    3. Enter the <b>exact amount</b> and Confirm the Transaction<br>
                                    4. After sending money, you’ll receive a Nagad Transaction ID (TRX ID). If you Sending the Money from AGENT NUMBER just type "AGENT" in the Transaction ID field<br>
                                    <span style="color: #16A34A; font-size: 20px; display: block; margin-top: 10px">You need to send us: <b style="font-weight: bolder"><?php echo $fetch['product_price'] ?> BDT</b></span>
                                    <span style="display: block; font-size: 18px; margin-top: 15px">Account Type: Personal</span>
                                    <span style="display: block; font-size: 18px; margin-top: 15px; position: relative">Account Number: 01624447830<svg style="width: 30px; position: absolute; top: 3px" aria-hidden="true" class="inline-flex size-6 cursor-pointer text-slate-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M7 9a2 2 0 012-2h6a2 2 0 012 2v6a2 2 0 01-2 2H9a2 2 0 01-2-2V9z"></path><path d="M5 3a2 2 0 00-2 2v6a2 2 0 002 2V5h8a2 2 0 00-2-2H5z"></path></svg></span>
                                </p>
                                <form id="nagadPart2" class="payment_form payment_feilds" action="order-received" method="post">
                                    <input type="hidden" name="payment_method" value="Nagad">
                                    <input type="hidden" name="product_id" value="<?php echo $id ?>">
                                    <label class="input_labet">Your Nagad Account Number</label>
                                    <input class="input_field" name="number" type="number" placeholder="01XXXXXXXXX">
                                    <label class="input_labet">Your Transaction ID</label>
                                    <input class="input_field" name="txn" type="text" placeholder="Txn ID">
                                    <button class="payment_submit_button">Place Order</button>
                                </form>
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