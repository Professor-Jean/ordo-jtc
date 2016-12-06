<?php
  include "../../../security/database/jtc_connection_database.php";
  include "../../../addons/php/jtc_messageRepository_php.php";
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
        <h4>Redefinição de senha</h4>
        <p>Digite o e-mail vinculado à sua conta, para o envio do link de modificação de senha. O link apenas é ativo durante seu dia de criação.</p>
        <form name="passwordreset" method="post" action="jtc_link_password_reset.php">
          <input type="text" name="email" placeholder="E-mail" maxlength="100">
          <button type="submit">Solicitar alteração de senha</i></button>
          <?php
            if(isset($_GET["msgid"])){
              ?>
              <span><?php echo messageRepository($_GET["msgid"])?></span>
              <?php
            }
          ?>
        </form>
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