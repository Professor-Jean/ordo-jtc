<?php
  /**
  *Funcionalidade: este arquivo faz a verificação de autenticação.
  *Data de criação: 17/10/2016
  */

  session_start();

  if(!isset($_SESSION['session_id'])){
    header("location: ../../security/authentication/jtc_logout_authentication.php");
    exit;
  }else if($_SESSION['session_id']!=session_id()){
    header("location: ../../security/authentication/jtc_logout_authentication.php");
    exit;
  }
