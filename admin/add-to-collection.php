<?php
include '../conn.php';
$parent_product_id = $_POST['parent_product_id'];
$action = $_POST['action'];
if($action == "remove"){
    $delete = "DELETE FROM `collection` WHERE `collection_item_id`='$parent_product_id'";
    $delete_query = mysqli_query($conn, $delete);
    if($delete_query){
        header("Location: parent-products");
    }
}else {
    $insert = "INSERT INTO `collection`(`collection_item_id`) VALUES ('$parent_product_id')";
    $inject = mysqli_query($conn, $insert);
    if($inject){
        header("Location: parent-products");
    }
}
?>