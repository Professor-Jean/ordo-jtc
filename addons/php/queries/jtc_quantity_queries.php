<?php

include "../../../security/authentication/jtc_permission_authentication.php";
include "../../../security/database/jtc_connection_database.php";

$code = $_POST["code"];
$size = $_POST["size"];
$quantity = $_POST["quantity"];

$sql_select_inventories = "SELECT inventories.quantity FROM inventories INNER JOIN products_has_sizes ON products_has_sizes.id=inventories.products_has_sizes_id WHERE products_has_sizes.products_id=".$code." AND products_has_sizes.sizes_id=".$size;
$sql_select_inventories_prepare = $dbconnection->prepare($sql_select_inventories);
$sql_select_inventories_prepare->execute();
$sql_select_inventories_data = $sql_select_inventories_prepare->fetch();

if($sql_select_inventories_data["quantity"]>=$quantity){
    echo 1;
}else{
    echo 0;
}