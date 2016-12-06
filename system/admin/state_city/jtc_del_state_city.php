<?php
 /**
 *Funcionalidade: este arquivo realiza a exclusão de estado e cidade
 *Data de criação: 28/10/2016
 */

 if(isset($_GET["delid_state"])){
   $form_msg = "state";
   $id = $_GET["delid_state"];

   $sql_select_cities = "SELECT * FROM cities WHERE states_id='".$id."'";
   $sql_select_cities_prepare = $dbconnection->prepare($sql_select_cities);
   $sql_select_cities_prepare->execute();
   if($sql_select_cities_prepare->rowCount()==0){
     $result = deletar("states", "id=".$id);
     if($result){
       $msgid = 11;
       $data = "Estado";
     }else{
      $msgid = 10;
       $data = "Estado";
     }
   }else{
     $msgid = 23;
   }
 }else if($_GET["delid_city"]){
   $form_msg = "city";
   $id = $_GET["delid_city"];

   $sql_select_sellers = "SELECT * FROM sellers WHERE cities_id='".$id."'";
   $sql_select_sellers_prepare = $dbconnection->prepare($sql_select_sellers);
   $sql_select_sellers_prepare->execute();
   if($sql_select_sellers_prepare->rowCount()==0){
     $result = deletar("cities", "id=".$id);
     if($result){
       $msgid = 11;
       $data = "Cidade";
     }else{
       $msgid = 10;
       $data = "Cidade";
     }
   }else{
    $msgid = 24;
   }
 }

  header("Location: ?folder=state_city/&file=jtc_fminsupd_state_city&ext=php&msgid_".$form_msg."=".$msgid."&data=".$data);