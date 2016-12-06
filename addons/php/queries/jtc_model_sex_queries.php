<?php
 /**
 *Funcionalidade: retorna o modelo e o sexo do do produto
 *Data de criação: 10/11/2016
 */

  include "../../../security/authentication/jtc_permission_authentication.php";
  include "../../../security/database/jtc_connection_database.php";

  $id = $_POST["id"];

  $sql_select_products = "SELECT model, sex FROM products WHERE id='".$id."'";
  $sql_select_products_prepare = $dbconnection->prepare($sql_select_products);
  $sql_select_products_prepare->execute();
  $sql_select_products_data = $sql_select_products_prepare->fetch();
  $info = array(
    "sex" => $sql_select_products_data["sex"],
    "model" => $sql_select_products_data["model"],
  );
  echo json_encode($info);