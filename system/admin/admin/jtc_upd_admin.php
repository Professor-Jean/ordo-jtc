<?php
  /**
  *Funcionalidade: Altera os dados do Administrador.
  *Data de criação: 24/10/2016
  */

  $id = $_POST["id"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  $confirm_password = $_POST["confirm_password"];

  $data = NULL;//pois tem mensagem que não utilizam complemento

  if($email==""){
    $msgid = 5;
    $data = "E-mail";
  }else if($password==""){
    $msgid = 5;
    $data = "Senha";
  }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $msgid = 4;
    $data = "E-mail";
  }else if(!validate_username($password)){
    $msgid = 4;
    $data = "Senha";
  }else if($password!=$confirm_password){
    $msgid = 6;
  }else{
    $sql_select_users = "SELECT * FROM users WHERE email='".$email."' AND id<>='".$id."'";
    $sql_select_users_prepare = $dbconnection->prepare($sql_select_users);
    $sql_select_users_prepare->execute();
    if($sql_select_users_prepare->rowCount()==0){
      $data = array(
        'email' => $email,
        'password' => md5($salt.$password),
      );
      $result = alterar("users", $data, "id=".$id);
      if($result){
        $msgid =  14;
        $data = "Administrador";
        header("Location: ?folder=admin/&file=jtc_fminsupd_admin&ext=php&msgid=".$msgid."&data=".$data);
        die();
      }else{
        $msgid = 13;
        $data = "Administrador";
      }
    }else{
      $msgid = 12;
      $data = "Usuário";
    }
  }
  header("Location: ?folder=admin/&file=jtc_fminsupd_admin&ext=php&updid=".$id."&msgid=".$msgid."&data=".$data);
