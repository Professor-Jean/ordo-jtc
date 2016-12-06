<?php
 /**
 *Funcionalidade: este arquivo cadastra um vendedor novo
 *Data de criação: 29/10/2016
 */

  $name = $_POST["name"];
  $date = $_POST["date"];
  $email = $_POST["email"];
  $phone = $_POST["phone"];
  $city = $_POST["city"];

  $data = NULL;//Pois nem toda as mensagens possuem complemento
  if($name==""){
    $msgid = 5;
    $data = "Nome";
  }else if(!validate_name($name)){
    $msgid = 4;
    $data = "Nome";
  }else if($date==""){
    $msgid = 5;
    $data = "Data";
  }else if(!validate_date($date)){
    $msgid = 16;
  }else if($email==""){
    $msgid = 5;
    $data = "Email";
  }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $msgid = 4;
    $data = "E-mail";
  }else if($phone==""){
    $msgid = 5;
    $data = "Telefone";
  }else if(!validate_number($phone)){
    $msgid = 4;
    $data = "Telefone";
  }else if($city==""){
    $msgid = 5;
    $data = "Cidade";
  }else{
    $sql_select_sellers = "SELECT * FROM sellers WHERE email='".$email."'";
    $sql_select_sellers_prepare = $dbconnection->prepare($sql_select_sellers);
    $sql_select_sellers_prepare->execute();
    if($sql_select_sellers_prepare->rowCount()==0){
      $sql_select_sellers = "SELECT * FROM sellers WHERE phone='".$phone."'";
      $sql_select_sellers_prepare = $dbconnection->prepare($sql_select_sellers);
      $sql_select_sellers_prepare->execute();
      if($sql_select_sellers_prepare->rowCount()==0){
        $info = array(
          "name" => $name,
          "birth_date" => date_converter($date, "/"),
          "email" => $email,
          "phone" => $phone,
          "cities_id" => $city,
        );
        $result = adicionar("sellers", $info);
        if($result){
          $msgid = 1;
          $data = "Vendedor";
        }else{
          $msgid = 2;
          $data = "Vendedor";
        }
      }else{
        $msgid = 18;
      }
    }else{
      $msgid = 17;
    }
  }
  header("Location: ?folder=seller/&file=jtc_fminsupd_seller&ext=php&msgid=".$msgid."&data=".$data);