<?php
include '../conn.php';
$parent_product_id = $_POST['parent_product_id'];
$delete = "DELETE FROM `parent_product` WHERE `parent_product_id`='$parent_product_id'";
$delete_query = mysqli_query($conn, $delete);
if($delete_query){
    header("Location: parent-products");
}
?>