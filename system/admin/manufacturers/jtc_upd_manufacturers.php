<?php
/**
*Funcionalidade: Alteração de Fabricante.
*Data de criação: 18/10/2016
*Obs.: .....
*/
$id = $_POST["id"];
$name = $_POST["nome"];
$phone = $_POST["telefone"];
$email = $_POST["email"];
$cnpj = $_POST["cnpj"];

if($name==""){
  $msgid = 4;
  $data= "nome";
}else if(!validate_name($name)){
  $msgid = 4;
  $data= "nome";
}else if($phone==""){
  $msgid = 4;
  $data= "telefone";
}else if(!validate_number($phone)){
  $msgid = 4;
  $data= "telefone";
}else if($email==""){
  $msgid = 4;
  $data= "email";
}else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
  $msgid = 4;
  $data= "email";
}else if($cnpj==""){
  $msgid = 4;
  $data= "cnpj";
}else if(!validate_number($cnpj)){
  $msgid = 4;
  $data= "cnpj";
}else{
  $sql_sel_manufacturers = "SELECT * FROM manufacturers WHERE email = '".$email."' AND id<>='".$id."'";
  $sql_sel_manufacturers_prepare = $dbconnection->prepare($sql_sel_manufacturers);
  $sql_sel_manufacturers_prepare->execute();
if($sql_sel_manufacturers_prepare->rowCount()==0){
    $data= array(
      'name'=> $name,
      'phone'=> $phone,
      'email'=> $email ,
      'cnpj'=> $cnpj
    );
    $result = alterar("manufacturers", $data, "id=".$id);
    if($result){
      $msgid = 14;
      $data= "Fabricante";
      header("Location: ?folder=manufacturers/&file=jtc_fminsupd_manufacturers&ext=php&msgid=".$msgid."&data=".$data);
      die();
    }else{
      $msgid = 13;
      $data = "Fabricante";
    }
  }
}
header("Location: ?folder=manufacturers/&file=jtc_fminsupd_manufacturers&ext=php&updid=".$id."&msgid=".$msgid."&data=".$data);
?>
