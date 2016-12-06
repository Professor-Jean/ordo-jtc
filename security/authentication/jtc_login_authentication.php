<?php
  /**
  *Funcionalidade: este arquivo é utilizado para realizar a autenticação.
  *Data de criação: 17/10/2016
  */
  include "../database/jtc_connection_database.php";
  include "../../addons/php/jtc_operationsdb_php.php";

  echo $user = $_POST["user"];
  echo $password = $_POST["password"];

  $sql_select_users = "SELECT id, username, password FROM users WHERE username='".$user."' and password='".md5($salt.$password)."'";
  $sql_select_users_prepare = $dbconnection->prepare($sql_select_users);
  $sql_select_users_prepare->execute();

  if($sql_select_users_prepare->rowCount()==0){
    header("location: ../../index.php?msgid=3");
  }else if($sql_select_users_prepare->rowCount()==1){
    $sql_select_users_data = $sql_select_users_prepare->fetch();
    session_start();
    $_SESSION["id"] = $sql_select_users_data['id'];
    $_SESSION["username"] = $sql_select_users_data["username"];
    $_SESSION["session_id"] = session_id();
    header("location: ../../system/admin/jtc_main_admin.php");
  }
