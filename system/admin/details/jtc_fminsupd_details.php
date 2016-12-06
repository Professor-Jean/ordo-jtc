<?php
/**
 *Funcionalidade: Página para os registros e alterações de categorias e tamanhos.
 *Data de criação: 28/10/2016
 */
?>
<h1 id="title-page">Registro de Detalhes de Produtos</h1>
<div class="small_form">
  <?php
    if(isset($_GET['updid_tamanho'])){
      ?>
        <h3>Alteração de Tamanho</h3>
      <?php
    }else{
      ?>
        <h3>Cadastro de Tamanho</h3>
      <?php
    }
  ?>
    <?php
    if(isset($_GET['msgid_size'])){
    ?>
      <span><?php echo messageRepository($_GET['msgid_size'], $_GET['data'])?></span>
    <?php
    }
    if(isset($_GET['updid_tamanho'])){
      $sql_sel_size = "SELECT * FROM sizes WHERE id = '".$_GET["updid_tamanho"]."'";
      $sql_sel_size_prepare = $dbconnection->prepare($sql_sel_size);
      $sql_sel_size_prepare->execute();
      $sql_sel_size_data = $sql_sel_size_prepare->fetch();
   ?>

   <form name="upd_size" method="post" action="?folder=details/&file=jtc_upd_details&ext=php">
     <input type="hidden" name="id"  value="<?php echo $sql_sel_size_data["id"];?>">
     <input type="text" name="tamanho"  value="<?php echo $sql_sel_size_data["size"];?>">
     <div class="buttons">
       <button type="button"><a href="?folder=details/&file=jtc_fminsupd_details&ext=php">Cancelar</a></button>
       <button type="reset"><i class="fa fa-refresh" aria-hidden="true"></i></button>
       <button type="submit" name="alt_tamanho">Alterar</button>
     </div>
   </form>
   <?php
    }else{
   ?>
    <form name="cad_detail" onsubmit="#" method="post" action="?folder=details/&file=jtc_ins_details&ext=php">
        <input type="text" name="tamanho" placeholder="Tamanho">
        <div class="buttons">
            <button type="reset"><i class="fa fa-refresh" aria-hidden="true"></i></button>
            <button type="submit" name="form_tamanho">Cadastrar</button>
        </div>
    </form>
    <?php
      }
    ?>
</div>
<div class="small_form">
  <?php
    if(isset($_GET['updid_categoria'])){
      ?>
        <h3>Alteração de Categoria</h3>
      <?php
    }else{
      ?>
        <h3>Cadastro de Categoria</h3>
      <?php
    }
  ?>
    <?php
    if(isset($_GET['msgid_category'])){
    ?>
        <span><?php echo messageRepository($_GET['msgid_category'], $_GET['data'])?></span>
    <?php
    }
    if(isset($_GET['updid_categoria'])){
      $sql_sel_category = "SELECT * FROM categories WHERE id = '".$_GET["updid_categoria"]."'";
      $sql_sel_category_prepare = $dbconnection->prepare($sql_sel_category);
      $sql_sel_category_prepare->execute();
      $sql_sel_category_data = $sql_sel_category_prepare->fetch();
   ?>
   <form name="upd_category" method="post" action="?folder=details/&file=jtc_upd_details&ext=php">
     <input type="hidden" name="id"  value="<?php echo $sql_sel_category_data["id"];?>">
     <input type="text" name="categoria"  value="<?php echo $sql_sel_category_data["category"];?>">
     <div class="buttons">
       <button type="button"><a href="?folder=details/&file=jtc_fminsupd_details&ext=php">Cancelar</a></button>
       <button type="reset"><i class="fa fa-refresh" aria-hidden="true"></i></button>
       <button type="submit" name="alt_categoria">Alterar</button>
     </div>
   </form>
     <?php
     }else{
     ?>
    <form name="cad_detail" onsubmit="#" method="post" action="?folder=details/&file=jtc_ins_details&ext=php">
        <input type="text" name="categoria" placeholder="Categoria">
        <div class="buttons">
            <button type="reset"><i class="fa fa-refresh" aria-hidden="true"></i></button>
            <button type="submit" name="form_categoria">Cadastrar</button>
        </div>
    </form>
    <?php
      }
    ?>
</div>
<?php
  $sql_sel_size = "SELECT * FROM sizes";
  $sql_sel_size_prepare = $dbconnection->prepare($sql_sel_size);
  $sql_sel_size_prepare->execute();
?>
<div id="table_tabs">
  <ul>
    <li><a href="#tabs-1">Tamanhos</a></li>
    <li><a href="#tabs-2">Categorias</a></li>
  </ul>
  <div id="tabs-1">
    <table class="table_datatable">
        <thead>
            <tr>
                <th>Tamanho</th>
                <th>Editar</th>
                <th>Excluir</th>
            </tr>
        </thead>
        <tbody>
          <?php
            if($sql_sel_size_prepare->rowCount()>0){
              while($sql_sel_size_data = $sql_sel_size_prepare->fetch()){
          ?>
            <tr>
                <td><?php echo $sql_sel_size_data['size']?></td>
                <td><button><a href="?folder=details/&file=jtc_fminsupd_details&ext=php&updid_tamanho=<?php echo $sql_sel_size_data["id"];?>"><i class="fa fa-pencil-square" aria-hidden="true"></i></a></button></td>
                <td><button name="del_tamanho" onclick="confirm_delete('?folder=details/&file=jtc_del_details&ext=php&delid_size=<?php echo $sql_sel_size_data["id"];?>',' Tamanho','<?php echo $sql_sel_size_data["size"];?>')"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
            </tr>
            <?php
              }
                }
            ?>
        </tbody>
    <?php
      $sql_sel_category = "SELECT * FROM categories";
      $sql_sel_category_prepare = $dbconnection->prepare($sql_sel_category);
      $sql_sel_category_prepare->execute();
    ?>
    </table>
  </div>
  <div id="tabs-2">
    <table class="table_datatable">
        <thead>
            <tr>
                <th>Categoria</th>
                <th>Editar</th>
                <th>Excluir</th>
            </tr>
        </thead>
        <tbody>
          <?php
            if($sql_sel_category_prepare->rowCount()>0){
              while($sql_sel_category_data = $sql_sel_category_prepare->fetch()){
          ?>
            <tr>
                <td><?php echo $sql_sel_category_data['category']?></td>
                <td><button><a href="?folder=details/&file=jtc_fminsupd_details&ext=php&updid_categoria=<?php echo $sql_sel_category_data["id"];?>"><i class="fa fa-pencil-square" aria-hidden="true"></i></a></button></td>
                <td><button name="del_categoria" onclick="confirm_delete('?folder=details/&file=jtc_del_details&ext=php&delid_category=<?php echo $sql_sel_category_data["id"];?>',' Categoria','<?php echo $sql_sel_category_data["category"];?>')"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
            </tr>
          <?php
              }
            }
           ?>
        </tbody>
    </table>
  </div>
</div>
