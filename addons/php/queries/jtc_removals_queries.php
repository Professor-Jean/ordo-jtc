<?php

include "../../../security/authentication/jtc_permission_authentication.php";
include "../../../security/database/jtc_connection_database.php";
include "../jtc_helpers_php.php";

    $id = $_POST["seller_id"];

    $sql_select_removals = "SELECT id, date, hour, type FROM removals WHERE sellers_id=".$id;
    $sql_select_removals_prepare = $dbconnection->prepare($sql_select_removals);
    $sql_select_removals_prepare->execute();

    while($sql_select_removals_data = $sql_select_removals_prepare->fetch()){
        ?>
            <tr>
                <td><?php echo $sql_select_removals_data["id"];?></td>
                <td><?php echo date_converter($sql_select_removals_data["date"], "-");?></td>
                <td><?php echo substr($sql_select_removals_data["hour"], 0, -3);?></td>
                <td><button type="button"><a href="?folder=concert/&file=jtc_fmins_product_concert&ext=php&id=<?php echo $sql_select_removals_data["id"];?>"><i class="fa fa-archive" aria-hidden="true"></i></a></button></td>
            </tr>
        <?php
    }