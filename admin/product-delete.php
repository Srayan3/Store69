<?php
include '../conn.php';
$id = $_GET['product_id'];
$url = $_GET['url'];
$delete = "DELETE FROM `products` WHERE `product_id`='$id'";
$delete_query = mysqli_query($conn, $delete);
if($delete_query){
    header("Location:".$url);
}
?>