<?php
  include "../../../security/authentication/jtc_permission_authentication.php";
  include "../../../security/database/jtc_connection_database.php";
  /**
 *Funcionalidade: este arquivo retorna os códigos dos produtos
 *Data de criação: 01/11/2016
 */

  $id = $_POST["id"];

  $sql_select_products = "SELECT id, code FROM products WHERE manufacturers_id='".$id."'";
  $sql_select_products_prepare =  $dbconnection->prepare($sql_select_products);
  $sql_select_products_prepare->execute();
  if($sql_select_products_prepare->rowCount()>0){
    while($sql_select_products_data = $sql_select_products_prepare->fetch()){
      ?>
        <option value="<?php echo $sql_select_products_data["id"];?>"><?php echo $sql_select_products_data["code"];?></option>
      <?php
    }
  }else{
    echo "0";
  }

