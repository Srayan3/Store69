<?php
include '../conn.php';
$category_order = $_POST['categoryOrder'];
$category_id = $_POST['category_id'];
$category_order_update = "UPDATE `categories` SET `category_order`='$category_order' WHERE `category_id`='$category_id'";
$category_order_update_push = mysqli_query($conn, $category_order_update);
if($category_order_update_push){
    header("Location: ./categories");
}
?>