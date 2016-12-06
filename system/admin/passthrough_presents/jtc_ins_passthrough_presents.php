<?php
/**
*Funcionalidade: este arquivo realiza o repasse brinde para vendedor.
 *Data de criação: 04/11/2016
 */
$seller = $_POST["seller"];
if(@$_POST["date_use"]<>""){
    $date = date("Y/m/d");
    $hour = date("H:i");
    $validate_date = false;
}else{
    $hour = trim($_POST["hour"]);
    $date = trim($_POST["date"]);
    $validate_date = true;
}
$code = $_POST["code"];
$size = $_POST["size"];
$quantity = $_POST["quantity"];
if($date==""){
    $msgid = 5;
    $data = "Data";
}else if($hour==""){
    $msgid = 5;
    $data = "Hora";
}else if((!validate_date($date))&&($validate_date)){
    $msgid = 16;
}else if(!validate_hour($hour)){
    $msgid = 31;
}
$sql_sel_inventories= "SELECT inventories.id AS inventories_id, inventories.quantity, products_has_sizes.id AS products_has_sizes_id FROM products_has_sizes INNER JOIN inventories ON inventories.products_has_sizes_id = products_has_sizes.id WHERE products_id=".$code[0]." AND sizes_id=".$size[0];
$sql_sel_inventories_prepare = $dbconnection->prepare($sql_sel_inventories);
$sql_sel_inventories_prepare->execute();
$sql_sel_inventories_data = $sql_sel_inventories_prepare->fetch();


if ($sql_sel_inventories_data['quantity'] - $quantity[0] >= 0) {
    $info= array(
        "type"=> 1,
        "date"=> $date,
        "hour"=> $hour,
        "sellers_id"=> $seller
    );
    $result= adicionar("removals", $info);
    if($result){
        $msgid = 39;
        $info= array(
            "products_has_sizes_id"=> $sql_sel_inventories_data["products_has_sizes_id"],
            "removals_id"=> $dbconnection->lastInsertId(),
            "quantity"=> $quantity[0],
        );
        adicionar("removals_has_products_has_sizes", $info);
        $info=array(
            "quantity"=> $sql_sel_inventories_data["quantity"] - $quantity[0] . ""
        );
        $result=alterar("inventories", $info, "id=".$sql_sel_inventories_data["inventories_id"]);
    }
    }else{
        $msgid = 33;
    }

header("Location: ?folder=passthrough_presents/&file=jtc_fmins_passthrough_presents&ext=php&msgid=".$msgid."&data=".$data);
?>

