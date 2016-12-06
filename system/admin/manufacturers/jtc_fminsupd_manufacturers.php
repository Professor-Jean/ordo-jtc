<?php
/**
*Funcionalidade: Registro de Fabricante.
*Data de criação: 18/10/2016
*Obs.: .....
*/
?>
<h1 id="title-page">Registro de Fabricante</h1>
<div class="small_form">
  <?php
  if(isset($_GET['updid'])){
    ?>
      <h3>Alteração de Fabricante</h3>
    <?php
  }else{
    ?>
  <h3>Cadastro de Fabricante</h3>
  <?php
}
  if(isset($_GET['msgid'])){

    ?>
    <span><?php echo messageRepository($_GET['msgid'], $_GET['data'])?></span>
    <?php
    }
    if(isset($_GET["updid"])){
      $sql_select_manufacturers = "SELECT id, name, phone, email, cnpj FROM manufacturers WHERE id='".$_GET["updid"]."'";
      $sql_select_manufacturers_prepare = $dbconnection->prepare($sql_select_manufacturers);
      $sql_select_manufacturers_prepare->execute();
      $sql_select_manufacturers_data = $sql_select_manufacturers_prepare->fetch();
      ?>


  <form name="alt_manufacturers"  method="post" action="?folder=manufacturers/&file=jtc_upd_manufacturers&ext=php">
    <input type="hidden" name="id" value="<?php echo $sql_select_manufacturers_data["id"];?>">
    <input type="text" name="nome" placeholder="Nome" value="<?php echo $sql_select_manufacturers_data["name"];?>">
    <input type="text" name="telefone" placeholder="Telefone" value="<?php echo $sql_select_manufacturers_data["phone"];?>">
    <input type="text" name="email" placeholder="E-mail" value="<?php echo $sql_select_manufacturers_data["email"];?>">
    <input type="text" name="cnpj" placeholder="CNPJ" value="<?php echo $sql_select_manufacturers_data["cnpj"];?>">
    <div class="buttons">
      <button type="button"><a href="?folder=manufacturers/&file=jtc_fminsupd_manufacturers&ext=php">Cancelar</a></button>
    <button type="reset"><i class="fa fa-refresh" aria-hidden="true"></i></button>
    <button type="submit">Alterar</button>
    </div>
  </form>
  <?php
}else{
  ?>
  <form name="cad_manufacturers"  method="post" action="?folder=manufacturers/&file=jtc_ins_manufacturers&ext=php">
    <input type="text" name="nome" placeholder="Nome">
    <input type="text" name="telefone" placeholder="Telefone">
    <input type="text" name="email" placeholder="E-mail">
    <input type="text" name="cnpj" placeholder="CNPJ">
    <div class="buttons">
      <button type="button"><a href="?folder=manufacturers/&file=jtc_fminsupd_manufacturers&ext=php">Cancelar</a></button>
    <button type="reset"><i class="fa fa-refresh" aria-hidden="true"></i></button>
    <button type="submit">Cadastrar</button>
    </div>
  </form>
  <?php
}
    $sql_sel_manufacturers = "SELECT * FROM manufacturers";
    $sql_sel_manufacturers_prepare = $dbconnection->prepare($sql_sel_manufacturers);
    $sql_sel_manufacturers_prepare->execute();

  ?>
</div>
<table class="table_datatable">
  <thead>
    <tr>
        <th>Nome</th>
        <th>Telefone</th>
        <th>E-mail</th>
        <th>CNPJ</th>
        <th>Editar</th>
        <th>Excluir</th>
    </tr>
  </thead>
  <tbody>
    <?php
      while($sql_sel_manufacturers_data = $sql_sel_manufacturers_prepare->fetch()){
    ?>
      <tr>
          <td><?php echo $sql_sel_manufacturers_data['name'] ?></td>
          <td><?php echo $sql_sel_manufacturers_data['phone'] ?></td>
          <td><?php echo $sql_sel_manufacturers_data['email'] ?></td>
          <td><?php echo substr($sql_sel_manufacturers_data['cnpj'], 4, 14) ?></td>
          <td><button><a href="?folder=manufacturers/&file=jtc_fminsupd_manufacturers&ext=php&updid=<?php echo $sql_sel_manufacturers_data["id"];?>"><i class="fa fa-pencil-square" aria-hidden="true"></i></button></a></td>
          <td><button onclick="confirm_delete('?folder=manufacturers/&file=jtc_del_manufacturers&ext=php&delid=<?php echo $sql_sel_manufacturers_data["id"];?>', 'Fabricante', '<?php echo $sql_sel_manufacturers_data["name"];?>')"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
      </tr>
      <?php
    }
   ?>
  </tbody>
</table>
