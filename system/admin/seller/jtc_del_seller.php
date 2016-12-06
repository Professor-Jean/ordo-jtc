<?php
  /**
  *Funcionalidade: este arquivo deleta um vendedor
  *Data de criação: 29/10/2016
  */

  $id = $_GET["delid"];

  $sql_select_entries = "SELECT * FROM entries WHERE sellers_id='".$id."'";
  $sql_select_entries_prepare = $dbconnection->prepare($sql_select_entries);
  $sql_select_entries_prepare->execute();
  if($sql_select_entries_prepare->rowCount()==0){
    $sql_select_removals = "SELECT * FROM removals WHERE sellers_id='".$id."'";
    $sql_select_removals_prepare = $dbconnection->prepare($sql_select_removals);
    $sql_select_removals_prepare->execute();
    if($sql_select_removals_prepare->rowCount()==0){
      $sql_select_checks = "SELECT * FROM removals WHERE sellers_id='".$id."'";
      $sql_select_checks_prepare = $dbconnection->prepare($sql_select_checks);
      $sql_select_checks_prepare->execute();
      if($sql_select_checks_prepare->rowCount()==0){
        $result = deletar("sellers", "id=".$id);
        if($result){
          $msgid = 11;
          $data = "Vendedor";
        }else{
          $msgid = 10;
          $data = "Vendedor";
        }
      }else{
        $msgid = 19;
        $data = "Cheque";
      }
    }else{
      $msgid = 19;
      $data = "Saída de Estoque";
    }
  }else{
    $msgid = 19;
    $data = "Entrada de Estoque";
  }
  header("Location: ?folder=seller/&file=jtc_fminsupd_seller&ext=php&msgid=".$msgid."&data=".$data);