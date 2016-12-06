<?php
    $repairs_id = $_POST["repairs_id"];
    if(@$_POST["date_use"]<>""){
        $hour = date("H:i");
        $date = date("d/m/Y");
        $validate_date = false;
    }else{
        $hour = $_POST["hour"];
        $date = $_POST["date"];
        $validate_date = true;
    }

    if((!validate_date($date))&&($validate_date)){
        $msgid = 16;
    }else if(!validate_hour($hour)){
        $msgid = 31;
    }else{
        $msgid = 38;
        $info = array(
            "date" => date_converter($date, "/"),
            "hour" => $hour,
            "type" => 2,
        );
        adicionar("entries", $info);
        $entries_id = $dbconnection->lastInsertId();
        $info = array(
            "entries_id" => $entries_id,
        );
        alterar("repairs", $info, "id=".$repairs_id);

        $sql_select_inventories = "SELECT inventories.id AS inventories_id, inventories.quantity AS inventories_quantity, repairs.quantity AS repairs_quantity, products_has_sizes.id AS products_has_sizes_id FROM inventories INNER JOIN products_has_sizes ON products_has_sizes.id = inventories.products_has_sizes_id INNER JOIN removals_has_products_has_sizes ON removals_has_products_has_sizes.products_has_sizes_id = products_has_sizes.id INNER JOIN repairs ON repairs.removals_has_products_has_sizes_id = removals_has_products_has_sizes.id WHERE repairs.id=".$repairs_id;
        $sql_select_inventories_prepare = $dbconnection->prepare($sql_select_inventories);
        $sql_select_inventories_prepare->execute();
        $sql_select_inventories_data = $sql_select_inventories_prepare->fetch();

        $info = array(
            "quantity" => $sql_select_inventories_data["inventories_quantity"] + $sql_select_inventories_data["repairs_quantity"],
        );
        alterar("inventories", $info, "id=".$sql_select_inventories_data["inventories_id"]);

        $info = array(
            "products_has_sizes_id" => $sql_select_inventories_data["products_has_sizes_id"],
            "entries_id" => $entries_id,
            "quantity" => $sql_select_inventories_data["repairs_quantity"],
        );
        adicionar("entries_has_products_has_sizes", $info);
    }
header("Location: ?folder=consults/&file=jtc_repair_consults&ext=php&msgid=".$msgid);