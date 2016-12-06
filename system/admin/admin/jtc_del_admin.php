<?php
  /**
  *Funcionalidade: este arquivo deleta um administrador
  *Data de criação: 24/10/2016
  */

  $id = $_GET["delid"];

  $sql_select_users = "SELECT * FROM users";
  $sql_select_users_prepare = $dbconnection->prepare($sql_select_users);
  $sql_select_users_prepare->execute();


  if($sql_select_users_prepare->rowCount()==1){
    $msgid = 9;
  }else{
    $result = deletar("users", "id=".$id);
    if($result){
      if($id == $_SESSION["id"]){
        header("Location: ../../security/authentication/jtc_logout_authentication.php");
      }else{
        $msgid = 11;
        $data = "Administrador";
      }
    }else{
      $msgid = 10;
      $data = "Administrador";
    }
  }

  header("Location: ?folder=admin/&file=jtc_fminsupd_admin&ext=php&msgid=".$msgid."&data=".$data);
