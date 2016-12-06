<?php

if(@$_POST["date_use"]<>""){
  $hour = date("H:i");
  $date = date("d/m/Y");
  $validate_date = false;
}else{
  $hour = $_POST["hour"];
  $date = $_POST["date"];
  $validate_date = true;
}
$removals_id = $_POST["removals_id"];
$products_has_sizes_id = $_POST["products_has_sizes_id"];
$quantity = $_POST["quantity"];

if(($validate_date) && (!validate_date($date))){
  $msgid = 16;
}else if(!validate_hour($hour)) {
  $msgid = 31;
}else if(!validate_number($quantity)){
  $msgid = 4;
  $data = "Quantidade";
}else{

  $sql_select_products_has_sizes = "SELECT id, quantity FROM removals_has_products_has_sizes WHERE products_has_sizes_id=".$products_has_sizes_id." AND removals_id=".$removals_id;
  $sql_select_products_has_sizes_prepare = $dbconnection->prepare($sql_select_products_has_sizes);
  $sql_select_products_has_sizes_prepare->execute();
  $sql_select_products_has_data = $sql_select_products_has_sizes_prepare->fetch();
  $sql_select_products_has_data["id"];
  if($sql_select_products_has_data["quantity"]>=$quantity){
    $info = array(
      "removals_has_products_has_sizes_id" => $sql_select_products_has_data["id"],
      "date" => date_converter($date, "/"),
      "hour" => $hour,
      "quantity" => $quantity,
    );
    adicionar("repairs", $info);
    $msgid = 37;
    header("Location: ?folder=concert/&file=jtc_fmins_product_for_concert&ext=php&msgid=".$msgid);
    die();
  }else{
    $msgid = 36;
  }

}

header("Location: ?folder=concert/&file=jtc_fmins_inventory_concert&ext=php&msgid=".$msgid."&data=".$data."&removals_id=".$removals_id."&products_has_sizes_id=".$products_has_sizes_id);