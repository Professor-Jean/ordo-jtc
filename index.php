<?php
  include "security/database/jtc_connection_database.php";
  include "addons/php/jtc_messageRepository_php.php";
?>
<noscript>
  <div class="center-absolute">
    Para utilizar este site, ative o Javascript!
  </div>
</noscript>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>JTC</title>
    <!-- estilos = css -->
    <link rel="stylesheet" href="layout/css/jtc_reset_css.css">
    <link rel="stylesheet" href="layout/css/jtc_main_css.css">
    <link rel="stylesheet" href="layout/css/datatables.css"><!-- estilo das tabelas -->
    <!-- ícones -->
    <link rel="stylesheet" href="addons/css/font-awesome-4.6.3/css/font-awesome.min.css">
    <!-- scripts -->
    <script src="addons/js/jquery.js"></script>
  </head>
  <noscript id="noscript">
    <h1>O JavaScript é necessário para a utilização deste Software!</h1>
    <a href="http://enable-javascript.com/pt/">Como ativar o JavaScript</a>
  </noscript>
  <body>
    <main id="content">
      <nav id="nav">
        <h4>Autenticação</h4>
        <form name="login" method="post" action="security\authentication\jtc_login_authentication.php">
          <?php
          if(isset($_GET["msgid"])){
            ?>
            <span><?php echo messageRepository($_GET["msgid"])?></span>
            <?php
          }
          ?>
          <input type="text" name="user" placeholder="Usuário" maxlength="20">
          <input type="password" name="password" placeholder="Senha" maxlength="20">
          <button type="submit">Entrar <i class="fa fa-sign-in" aria-hidden="true"></i></button>
        </form>
        <a class="simple-link" href="system/guest/password_reset/jtc_fm_password_reset.php">Esqueceu a senha?</a>
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
