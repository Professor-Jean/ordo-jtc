<?php
/**
 *Funcionalidade: este arquivo realiza a entrada de produtos em estoque
 *Data de criação: 04/11/2016
 */
$type = $_POST["type"];
if($type == 0){
    $seller = 0;
}else{
    $seller = $_POST["seller"];
}
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
        "type" => $type,
    );
    $result = adicionar("entries", $info);
    $id_entries = $dbconnection->lastInsertId();

    if ($result){
        for ($c = 0; $c < count($code); $c++) {
            $msgid = 30;
            $sql_select_products_has_sizes = "SELECT id FROM products_has_sizes WHERE products_id='" . $code[$c] . "' AND sizes_id='" . $size[$c] . "'";
            $sql_select_products_has_sizes_prepare = $dbconnection->prepare($sql_select_products_has_sizes);
            $sql_select_products_has_sizes_prepare->execute();
            $sql_select_products_has_sizes_data = $sql_select_products_has_sizes_prepare->fetch();
            $id_products_has_sizes[$c] = $sql_select_products_has_sizes_data["id"];

            if ($sql_select_products_has_sizes_prepare->rowCount() == 0) {
                $info = array(
                    "products_id" => $code[$c],
                    "sizes_id" => $size[$c],
                );
                adicionar("products_has_sizes", $info);
                $id_products_has_sizes[$c] = $dbconnection->lastInsertId();
            }

            $info = array(
                "entries_id" => $id_entries,
                "products_has_sizes_id" => $id_products_has_sizes[$c],
                "quantity" => $quantity[$c],
            );
            adicionar("entries_has_products_has_sizes", $info);

            $sql_select_inventories = "SELECT id, quantity FROM inventories WHERE products_has_sizes_id='" . $id_products_has_sizes[$c] . "'";
            $sql_select_inventories_prepare = $dbconnection->prepare($sql_select_inventories);
            $sql_select_inventories_prepare->execute();
            if ($sql_select_inventories_prepare->rowCount() == 0) {
                $info = array(
                    "products_has_sizes_id" => $id_products_has_sizes[$c],
                    "quantity" => $quantity[$c],
                );
                adicionar("inventories", $info);
            } else {
                $sql_select_inventories_data = $sql_select_inventories_prepare->fetch();
                $info = array(
                    "quantity" => $sql_select_inventories_data["quantity"] + $quantity[$c],
                );
                alterar("inventories", $info, "id=" . $sql_select_inventories_data["id"]);
            }
        }
    }else{
        $msgid = 32;
    }
}
header("Location: ?folder=entry_inventory/&file=jtc_fmins_entry_inventory&ext=php&msgid=".$msgid);

?>