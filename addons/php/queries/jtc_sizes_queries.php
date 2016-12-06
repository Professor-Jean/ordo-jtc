<?php

include "../../../security/authentication/jtc_permission_authentication.php";
include "../../../security/database/jtc_connection_database.php";

$id = $_POST["id"];

$sql_select_sizes = "SELECT sizes.id, sizes.size FROM sizes INNER JOIN products_has_sizes ON products_has_sizes.sizes_id=sizes.id WHERE products_has_sizes.products_id=".$id;
$sql_select_sizes_prepare = $dbconnection->prepare($sql_select_sizes);
$sql_select_sizes_prepare->execute();

while($sql_select_sizes_data = $sql_select_sizes_prepare->fetch()){
    ?>
        <option value="<?php echo $sql_select_sizes_data["id"];?>"><?php echo $sql_select_sizes_data["size"]?></option>
    <?php
}