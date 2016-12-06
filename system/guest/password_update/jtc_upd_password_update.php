<?php
  include "../../../security/database/jtc_connection_database.php";
  include "../../../addons/php/jtc_messageRepository_php.php";
  include "../../../addons/php/jtc_validations_php.php";

  /**
  *Funcionalidade: este arquivo altera a senha do usuário
  *Data de criação: 30/10/2016
  */
?>
  <!DOCTYPE html>
  <html>
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
  <main id="content">
    <nav id="nav">
<?php
  $id = $_POST["id"];
  $password = $_POST["password"];
  $confirm_password = $_POST["confirm_password"];

  $data = "";

  $id = base64_decode($id);
  $id = mcrypt_decrypt(MCRYPT_BLOWFISH, $salt.date('d/m/Y'), $id, MCRYPT_MODE_ECB);
  $sql_select_users = "SELECT username FROM users WHERE id='".$id."'";
  $sql_select_users_prepare = $dbconnection->prepare($sql_select_users);
  $sql_select_users_prepare->execute()==1;
  if($sql_select_users_prepare->rowCount()==0){
    $msgid = 27;
  }else if(!validate_username($password)){
    $msgid = 4;
  }else if($password==$confirm_password){
    $data = "Senha";
    $msgid = 6;
  }else{
    echo "123123";
    $info = array(
      "password" => $password,
    );
    $result = alterar("users", $info, "id=".$id);
    if($result){
      echo "<h4>Alteração de Senha</h4>";
      echo "<p>Senha altserada com sucesso!</p>";
    }else{
      $msgid = 28;
    }
  }
//  if(isset($msgid)){
//    header("Location: jtc_fmupd_password_update.php?code=".$id."&msgid=".$msgid."&data=".$data);
//  }
?>
    </nav>
    <article id="article">
      <hgroup class="center-absolute" id="title-index">
        <h1>JTC</h1>
        <h2>João Tomaz Correia</h2>
      </hgroup>
    </article>
  </main>
  </body>
</html>
