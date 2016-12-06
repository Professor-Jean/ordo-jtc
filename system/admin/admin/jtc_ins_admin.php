<?php
  /**
  *Funcionalidade: este arquivo cadastra o admin no BD
  *Data de criação: 19/10/2016
  */

  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm_password'];

  $data = NULL;//pois tem mensagem que não utilizam comlemento

  if($username==""){
    $msgid = 5;
    $data = "Usuário";
  }else if($email==""){
    $msgid = 5;
    $data = "E-mail";
  }else if($password==""){
    $msgid = 5;
    $data = "Senha";
  }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $msgid = 4;
    $data = "E-mail";
  }else if(!validate_username($username)){
    $msgid = 4;
    $data = "Usuário";
  }else if(!validate_username($password)){
    $msgid = 4;
    $data = "Senha";
  }else if($password!=$confirm_password){
    $msgid = 6;
  }else{
    $sql_select_users = "SELECT * FROM users WHERE username='".$username."'";
    $sql_select_users_prepare = $dbconnection->prepare($sql_select_users);
    $sql_select_users_prepare->execute();
    if($sql_select_users_prepare->rowCount()==0){
      $data = array(
        'username' => $username,
        'email' => $email,
        'password' => md5($salt.$password),
      );
      $result = adicionar("users", $data);
      if($result){
        $msgid =  1;
        $data = "administrador";
      }else{
        $msgid = 2;
        $data = "administrador";
      }
    }else{
      $msgid = 7;
      $data = "Usuário";
    }
  }

  header("Location: ?folder=admin/&file=jtc_fminsupd_admin&ext=php&msgid=".$msgid."&data=".$data);
?>
