<?php
/**
*Funcionalidade: Inserção de Cheque.
*Data de criação: 19/10/2016
*Obs.: .....
*/
$seller = $_POST["seller_id"];
$number = $_POST["number"];
$value = $_POST["value"];
$date_receipt = $_POST["date_receipt"];
$date_good_for= $_POST["date_good_for"];

//if($seller==""){
//  $msgid = 4;
//  $data= "vendedor";
//}else if(!validate_name($seller)){
//  $msgid = 4;
//  $data= "vendedor";
if($number==""){
  $msgid = 4;
  $data= "número";
}else if(!validate_number($number)){
  $msgid = 4;
  $data= "número";
}else if($value==""){
  $msgid = 4;
  $data= "valor";
}else if(!validate_number($value)){
  $msgid = 4;
  $data= "valor";
}else if($date_good_for==""){
  $msgid = 4;
  $data= "Data a ser descontado";
}else if($date_receipt==""){
  $msgid = 4;
  $data= "Data de recebimento";

}else{
    $sql_sel_checks = "SELECT * FROM checks WHERE checks.status = 0 AND checks.number=".$number;
    $sql_sel_checks_prepare = $dbconnection->prepare($sql_sel_checks);
    $sql_sel_checks_prepare->execute();


if($sql_sel_checks_prepare->rowCount()=="0"){
    $data= array(
      'sellers_id'=> $seller,
      'number'=> $number,
      'value'=> $value,
        'status'=> '0',
      'date_receipt'=> date_converter($date_receipt, "/"),
      'date_good_for'=> date_converter($date_good_for, "/")
    );
    $result = adicionar ("checks" , $data);
    if($result){
      $msgid = 1;
      $data= "cheque";
    }else{
      $msgid = 2;
      $data= "cheque";
    }
  }else{
    $msgid = 7;
    $data = "Cheque";
  }
}
header("Location: ?folder=check/&file=jtc_fminsupd_check&ext=php&msgid=".$msgid."&data=".$data."");
?>

