<?php
  /**
   *Funcionalidade: este arquivo faz a pesquisa da requisição ajax, ajax_city();
   *Data de criação: 30/10/2016
   */

include "../../../security/authentication/jtc_permission_authentication.php";
include "../../../security/database/jtc_connection_database.php";


$state_id = $_POST["state_id"];
  $sql_select_cities = "SELECT id, name FROM cities WHERE states_id='".$state_id."'";
  $sql_select_cities_prepare = $dbconnection->prepare($sql_select_cities);
  $sql_select_cities_prepare->execute();
  if($sql_select_cities_prepare->rowCount()>0){
    while($sql_select_cities_data = $sql_select_cities_prepare->fetch()){
      echo "<option value='".$sql_select_cities_data["id"]."'>".$sql_select_cities_data["name"]."</option>";
    }
  }else{
    echo 0;//corresponde a uma pesquisa sem linhas para retornar
  }