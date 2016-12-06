<?php
/**
 *Funcionalidade: este arquivo realiza a entrada de produtos em estoque
 *Data de criação: 04/11/2016
 */

$seller = $_POST["seller"];
if(@$_POST["date_use"]<>""){
  $hour = date("H:i");
  $date = date("d/m/Y");
  $validate_date = false;
}else{
  $hour = $_POST["hour"];
  $date = $_POST["date"];
  $validate_date = true;
}
$code = $_POST["code"];
$size = $_POST["size"];
$quantity = $_POST["quantity"];


if((!validate_date($date))&&($validate_date)){
  $msgid = 16;
}else if(!validate_hour($hour)){
  $msgid = 31;
}else{
  $info = array(
    "sellers_id" => $seller,
    "date" => date_converter($date, "/"),
    "hour" => $hour,
    "type" => "0",
  );
  $result = adicionar("removals", $info);
  $id_removals = $dbconnection->lastInsertId();

  if ($result){
    for ($c = 0; $c < count($code); $c++) {

      $msgid = 35;
      $sql_select_products_has_sizes = "SELECT id FROM products_has_sizes WHERE products_id='" . $code[$c] . "' AND sizes_id='" . $size[$c] . "'";
      $sql_select_products_has_sizes_prepare = $dbconnection->prepare($sql_select_products_has_sizes);
      $sql_select_products_has_sizes_prepare->execute();
      $sql_select_products_has_sizes_data = $sql_select_products_has_sizes_prepare->fetch();
      $id_products_has_sizes[$c] = $sql_select_products_has_sizes_data["id"];

      $info = array(
        "removals_id" => $id_removals,
        "products_has_sizes_id" => $id_products_has_sizes[$c],
        "quantity" => $quantity[$c],
      );
      adicionar("removals_has_products_has_sizes", $info);

      $sql_select_inventories = "SELECT id, quantity FROM inventories WHERE products_has_sizes_id='" . $id_products_has_sizes[$c] . "'";
      $sql_select_inventories_prepare = $dbconnection->prepare($sql_select_inventories);
      $sql_select_inventories_prepare->execute();


      $sql_select_inventories_data = $sql_select_inventories_prepare->fetch();
      $info = array(
        "quantity" => $sql_select_inventories_data["quantity"] - $quantity[$c] . "",
      );
      alterar("inventories", $info, "id=".$sql_select_inventories_data["id"]);
    }
  }else{
    $msgid = 34;
  }
}
header("Location: ?folder=passthrough_merchandise/&file=jtc_fmins_passthrough_merchandise&ext=php&msgid=".$msgid);