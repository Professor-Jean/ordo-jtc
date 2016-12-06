<?php
  include "../../../security/database/jtc_connection_database.php";
  include "../../../addons/php/jtc_messageRepository_php.php";

  /**
  *Funcionalidade: este arquivo valida o código e cria o formulário de alteração de senha.
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
      $code = base64_decode($_GET["code"]);
      $code = mcrypt_decrypt(MCRYPT_BLOWFISH, $salt.date('d/m/Y'), $code, MCRYPT_MODE_ECB);
      $sql_select_users = "SELECT username FROM users WHERE id='".$code."'";
      $sql_select_users_prepare = $dbconnection->prepare($sql_select_users);
      $sql_select_users_prepare->execute();
      if($sql_select_users_prepare->rowCount()==1){
        $sql_select_users_data = $sql_select_users_prepare->fetch();
        ?>
          <h4>Alteração de Senha</h4>
          <p>Usuário: <?php echo $sql_select_users_data["username"];?></p>
          <form name="passwordupdate" method="post" action="jtc_upd_password_update.php">
            <input type="hidden" name="id" value="<?php echo $_GET["code"];?>">
            <input type="password" name="password" placeholder="Senha" maxlength="20">
            <input type="password" name="confirm_password" placeholder="Confirmação de Senha" maxlength="20">
            <button type="submit">Alterar senha</input></button>
              <?php
                  if(isset($_GET["msgid"])) {
                    ?>
                      <span><?php echo messageRepository($_GET["msgid"]) ?></span>
                    <?php
                  }
              ?>
          </form>
        <?php
      }else{
        ?>
        <span>Link inválido</span>
        <?php
      }
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