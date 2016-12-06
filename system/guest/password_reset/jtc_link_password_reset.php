<head>
  <meta charset="utf-8">
  <title>JTC</title>
  <!-- estilos css -->
  <link rel="stylesheet" href="../../../layout/css/jtc_reset_css.css">
  <link rel="stylesheet" href="../../../layout/css/jtc_main_css.css">
  <link rel="stylesheet" href="../../../layout/css/datatables.css"><!-- estilo das tabelas -->
  <!-- ícones -->
  <link rel="stylesheet" href="../../../addons/css/font-awesome-4.6.3/css/font-awesome.min.css">
  <!-- scripts -->
  <script src="../../../addons/js/jquery.js"></script>
</head>
<body>
<?php
  include "../../../security/database/jtc_connection_database.php";
  include "../../../addons/php/jtc_messageRepository_php.php";

  /**
  *Funcionalidade: este arquivo valida o e-mail e envia o link de alteração de senha.
  *Data de criação: 30/10/2016
  */

  $email = $_POST["email"];

  $sql_select_users = "SELECT id FROM users WHERE email='".$email."'";
  $sql_select_users_prepare = $dbconnection->prepare($sql_select_users);
  $sql_select_users_prepare->execute();
  if($sql_select_users_prepare->rowCount()==1){
    $sql_select_users_data = $sql_select_users_prepare->fetch();
    $code = base64_encode(mcrypt_encrypt(MCRYPT_BLOWFISH, $salt.date("d/m/Y"), $sql_select_users_data["id"], MCRYPT_MODE_ECB));
    $msgid = "26";
    $subject = "JTC | Alteração de Senha";\
    $message = "Link de acesso para a Alteração de Senha: <a href='tds.bitsons.tk/ordo-jtc/system/guest/password_update/jtc_fmupd_password_update.php?code=".$code."'>Link</a>";
    $mymail = new MyMail();
    $mymail->setTo(array($email));
    $mymail->setFrom("lucas_bublitz1@estudante.sc.senai.br");
    $mymail->setSubject($subject);
    $mymail->setMessage($message);
    if($mymail->sendMail()===true){
      echo "E-mail enviado com sucesso!";
    }else{
      echo "Problema ao enviar o e-mail.";
    }
    echo "Testando envio de e-mail...";

  }else{
    $msgid = 25;
  }

  header("Location: jtc_fm_password_reset.php?msgid=".$msgid);
?>
</body>
