<?php
/**
 *Funcionalidade: este arquivo realiza o cadastro de cidade e estado
 *Data de criação: 28/10/2016
 */

$data = NULL;//pois nem todo comentário utiliza complemento
 if(isset($_POST["cad_city"])){
  $form_msg = "city";
  $name = $_POST["name"];
  $state_id = $_POST["state"];
  if($name==""){
    $msgid = 5;
    $data = "Cidade";
  }else if(!validate_name($name)){
    $msgid = 4;
    $data = "Cidade";
  }else if($state_id==""){
    $msgid = 5;
    $data = "Estado";
  }else{
    $sql_select_cities = "SELECT * FROM cities WHERE name='".$name."' AND states_id='".$state_id."'";
    $sql_select_cities_prepare = $dbconnection->prepare($sql_select_cities);
    $sql_select_cities_prepare->execute();
    if($sql_select_cities_prepare->rowCount()==0){
      $info = array(
        "name" => $name,
        "states_id" => $state_id,
      );
      $result = adicionar("cities", $info);
      if($result){
        $msgid = 1;
        $data = "Cidade";
      }else{
        $msgid = 2;
        $data = "Cidade";
      }
    }else{
      $msgid = 20;
    }
  }
 }else if(isset($_POST["cad_state"])){
   $form_msg = "state";
   $name = $_POST["name"];
   $initials = $_POST["initials"];
   if($name==""){
     $msgid = 5;
     $data = "Estado";
   }else if(!validate_name($name)){
     $msgid = 4;
     $data = "Estado";
   }else if($initials==""){
     $msgid = 5;
     $data = "Sigla";
   }else if(!validate_initials($initials)){
     $msgid = 4;
     $data = "Silga";
   }else{
     $sql_select_states = "SELECT * FROM states WHERE name='".$name."'";
     $sql_select_states_prepare = $dbconnection->prepare($sql_select_states);
     $sql_select_states_prepare->execute();
     if($sql_select_states_prepare->rowCount()==0){
       $sql_select_states = "SELECT * FROM states WHERE initials='".$initials."'";
       $sql_select_states_prepare = $dbconnection->prepare($sql_select_states);
       $sql_select_states_prepare->execute();
       if($sql_select_states_prepare->rowCount()==0){
         $info = array(
           "name" => $name,
           "initials" => mb_strtoupper($initials),
         );
         $result = adicionar("states", $info);
         if($result){
           $msgid = 1;
           $data = "Estado";
         }else{
           $msgid = 2;
           $data = "Estado";
         }
       }else{
        $msgid = 22;
       }
     }else{
      $msgid = 21;
     }
   }
 }

  header("Location: ?folder=state_city/&file=jtc_fminsupd_state_city&ext=php&msgid_".$form_msg."=".$msgid."&data=".$data);
?>