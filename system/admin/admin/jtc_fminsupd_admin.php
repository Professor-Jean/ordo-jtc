<?php
  /**
  *Funcionalidade: este arquivo cria o furmulário de cadastro e alteração de administrador.
  *Data de criação: 19/10/2016
  */
?>
<h1 id="title-page">Registro de Administrador</h1>
<div class="small_form">
  <?php
    if(isset($_GET['updid'])){
      ?>
        <h3>Alteração de Administrador</h3>
      <?php
    }else{
      ?>
        <h3>Cadastro de Administrador</h3>
      <?php
    }
  ?>
  <?php
    if(isset($_GET['msgid'])){
      ?>
      <span><?php echo messageRepository($_GET['msgid'], $_GET['data']);?></span>
      <?php
    }
    if(isset($_GET["updid"])){
      $sql_select_users = "SELECT id, username, email FROM users WHERE id='".$_GET["updid"]."'";
      $sql_select_users_prepare = $dbconnection->prepare($sql_select_users);
      $sql_select_users_prepare->execute();
      $sql_select_users_data = $sql_select_users_prepare->fetch();
      ?>
          <form name="upd_admin" method="post" action="?folder=admin/&file=jtc_upd_admin&ext=php">
            <input type="hidden" name="id" value="<?php echo $sql_select_users_data["id"];?>">
            <input type="text" name="username" readonly="" value="<?php echo $sql_select_users_data["username"];?>">
            <input type="text" name="email" maxlength="100" placeholder="E-mail" value="<?php echo $sql_select_users_data["email"];?>">
            <input type="password" name="password" maxlength="20" placeholder="Senha">
            <input type="password" name="confirm_password" maxlength="20" placeholder="Confirmação de Senha">
            <div class="buttons">
              <button type="button"><a href="?folder=admin/&file=jtc_fminsupd_admin&ext=php">Cancelar</a></button>
              <button type="reset"><i class="fa fa-refresh" aria-hidden="true"></i></button>
              <button type="submit">Alterar</button>
            </div>
          </form>
      <?php

    }else{
      ?>
        <form name="cad_admin" method="post" action="?folder=admin/&file=jtc_ins_admin&ext=php">
          <input type="text" name="username" maxlength="20" placeholder="Usuário">
          <input type="text" name="email" maxlength="100" placeholder="E-mail">
          <input type="password" name="password" maxlength="20" placeholder="Senha">
          <input type="password" name="confirm_password" maxlength="20" placeholder="Confirmação de Senha">
          <div class="buttons">
            <button type="reset"><i class="fa fa-refresh" aria-hidden="true"></i></button>
            <button type="submit">Cadastrar</button>
          </div>
        </form>
      <?php
    }
  ?>
</div>
<table class="table_datatable">
  <thead>
    <tr>
      <th>ID</th>
      <th>Usuário</th>
      <th>E-mail</th>
      <th>Editar</th>
      <th>Excluir</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $sql_select_users = "SELECT id, username, email FROM users";
      $sql_select_users_prepare = $dbconnection->prepare($sql_select_users);
      $sql_select_users_prepare->execute();

      while($sql_select_users_data = $sql_select_users_prepare->fetch()){
        ?>
        <tr>
          <td><?php echo $sql_select_users_data["id"];?></td>
          <td><?php echo $sql_select_users_data["username"];?></td>
          <td><?php echo $sql_select_users_data["email"];?></td>
          <td><button><a href="?folder=admin/&file=jtc_fminsupd_admin&ext=php&updid=<?php echo $sql_select_users_data["id"];?>"><i class="fa fa-pencil-square" aria-hidden="true"></i></button></a></td>
          <td><button onclick="confirm_delete('?folder=admin/&file=jtc_del_admin&ext=php&delid=<?php echo $sql_select_users_data["id"];?>', 'Administrador', '<?php echo $sql_select_users_data["username"];?>')"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
        </tr>
        <?php
      }
    ?>
  </tbody>
</table>
<!-- Modal -->
