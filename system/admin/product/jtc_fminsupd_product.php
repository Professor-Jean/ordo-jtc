<?php
  /**
  *Funcionalidade: Página para os registros e alterações dos produtos.
  *Data de criação: 17/10/2016
  *Obs.: .....
  */
?>
<h1 id="title-page">Registro de Produto</h1>
<div class="small_form">
  <?php
    if(isset($_GET['updid'])){
      ?>
        <h3>Alteração de Produto</h3>
      <?php
    }else{
      ?>
        <h3>Cadastro de Produto</h3>
      <?php
    }
  ?>
  <?php
    if(isset($_GET['msgid'])){
  ?>
      <span><?php echo messageRepository($_GET['msgid'], $_GET['data'])?></span>
    <?php
    }
    if(isset($_GET['updid'])){
      $sql_sel_product = "SELECT * FROM products WHERE id = '".$_GET["updid"]."'";
      $sql_sel_product_prepare = $dbconnection->prepare($sql_sel_product);
      $sql_sel_product_prepare->execute();
      $sql_sel_product_data = $sql_sel_product_prepare->fetch();
   ?>
   <form name="upd_product" method="post" action="?folder=product/&file=jtc_upd_product&ext=php">
     <input type="hidden" name="id"  value="<?php echo $sql_sel_product_data["id"];?>">
     <input type="text" name="codigo"  value="<?php echo $sql_sel_product_data["code"];?>">
     <input type="text" name="modelo" value="<?php echo $sql_sel_product_data["model"];?>">
     <select name="categoria">
       <option value="" hidden></option>
       <?php
        $sql_sel_categories = "SELECT * FROM categories";
        $sql_sel_categories_prepare = $dbconnection->prepare($sql_sel_categories);
        $sql_sel_categories_prepare->execute();
        while($sql_sel_categories_data = $sql_sel_categories_prepare->fetch()){
          if($sql_sel_categories_data["id"] == $sql_sel_product_data["categories_id"]){
        ?>
          <option selected=""  value="<?php echo $sql_sel_categories_data["id"]?>"><?php echo $sql_sel_categories_data["category"]?></option>
        <?php
          }else{
        ?>
          <option value="<?php echo $sql_sel_categories_data["id"]?>"><?php echo $sql_sel_categories_data["category"]?></option>
        <?php
          }
        }
        ?>
     </select>
     <select name="sexo">
      <?php
        $sex = array(
          0 => "Feminino",
          1 => "Masculino",
          2 => "Unissex"
        );
        for ($c=0; $c < 3; $c++) { //Contadora recebe zero, ela irá se repetir enquanto for menor que 3.
          if($c == $sql_sel_product_data["sex"]){
          ?>
            <option selected="" value="<?php echo $c;?>"><?php echo $sex[$c];?></option>
          <?php
        }else{
          ?>
            <option value="<?php echo $c;?>"><?php echo $sex[$c];?></option>
          <?php
        }
      }
      ?>
     </select>
     <select name="fabricante">
       <option value="" hidden></option>
       <?php
         $sql_sel_manufacturers = "SELECT * FROM manufacturers ";
         $sql_sel_manufacturers_prepare = $dbconnection->prepare($sql_sel_manufacturers);
         $sql_sel_manufacturers_prepare->execute();
         while ($sql_sel_manufacturers_data = $sql_sel_manufacturers_prepare->fetch()){
           if($sql_sel_manufacturers_data["id"] == $sql_sel_product_data["manufacturers_id"]){
         ?>
           <option selected=""  value="<?php echo $sql_sel_manufacturers_data["id"]?>"><?php echo $sql_sel_manufacturers_data["name"]?></option>
         <?php
           }else{
         ?>
           <option value="<?php echo $sql_sel_manufacturers_data["id"]?>"><?php echo $sql_sel_manufacturers_data["name"]?></option>
         <?php
           }
         }
         ?>
     </select>
     <div class="label_input">
       <label><p>R$</p></label>
      <input type="text" name="preco" value="<?php echo number_format($sql_sel_product_data["price"],2,',','.');?>">
     </div>
     <div class="buttons">
       <button type="button"><a href="?folder=product/&file=jtc_fminsupd_product&ext=php">Cancelar</a></button>
       <button type="reset"><i class="fa fa-refresh" aria-hidden="true"></i></button>
       <button type="submit">Alterar</button>
     </div>
   </form>
  <?php
    }else{
  ?>
  <form name="cad_prod" onsubmit="#" method="post" action="?folder=product/&file=jtc_ins_product&ext=php">
    <input type="text" name="codigo" placeholder="Código">
    <input type="text" name="modelo" placeholder="Modelo">
    <select name="categoria">
      <option value="" hidden>Categoria</option>
      <?php
        $sql_sel_categories = "SELECT * FROM categories ";
        $sql_sel_categories_prepare = $dbconnection->prepare($sql_sel_categories);
        $sql_sel_categories_prepare->execute();
        while ($sql_sel_categories_data = $sql_sel_categories_prepare->fetch()){
      ?>
      <option value="<?php echo $sql_sel_categories_data["id"] ?>"><?php echo $sql_sel_categories_data["category"]?></option>
      <?php
        }
      ?>
    </select>
    <select name="sexo">
      <option value="" hidden>Sexo</option>
      <option value="0">Feminino</option>
      <option value="1">Masculino</option>
      <option value="2">Unisex</option>
    </select>
    <select name="fabricante">
      <option value="" hidden>Fabricante</option>
      <?php
        $sql_sel_manufacturers = "SELECT * FROM manufacturers ";
        $sql_sel_manufacturers_prepare = $dbconnection->prepare($sql_sel_manufacturers);
        $sql_sel_manufacturers_prepare->execute();
        while ($sql_sel_manufacturers_data = $sql_sel_manufacturers_prepare->fetch()){
      ?>
      <option value="<?php echo $sql_sel_manufacturers_data["id"]?>"><?php echo $sql_sel_manufacturers_data["name"]?></option>
      <?php
        }
      ?>
    </select>
    <div class="label_input">
      <label><p>R$</p></label>
      <input type="text" name="preco" placeholder="Preço">
    </div>
    <div class="buttons">
    <button type="reset"><i class="fa fa-refresh" aria-hidden="true"></i></button>
      <button type="submit">Cadastrar</button>
    </div>
  </form>
  <?php
    }
  ?>
</div>
<?php
  $sql_sel_product = "SELECT products.code, products.id, products.categories_id, products.manufacturers_id, products.model, products.sex, products.price, manufacturers.name AS manufacturers, categories.category AS category FROM products INNER JOIN categories ON products.categories_id = categories.id INNER JOIN manufacturers ON products.manufacturers_id = manufacturers.id";
  $sql_sel_product_prepare = $dbconnection->prepare($sql_sel_product);
  $sql_sel_product_prepare->execute();
?>

<table class="table_datatable">
  <thead>
    <tr>
      <td>Código</td>
      <td>Modelo</td>
      <td>Categoria</td>
      <td>Sexo</td>
      <td>Fabricante</td>
      <td>Preço</td>
      <td>Editar</td>
      <td>Excluir</td>
    </tr>
  </thead>
  <tbody>
    <?php
      if($sql_sel_product_prepare->rowCount()>0){
        while($sql_sel_product_data = $sql_sel_product_prepare->fetch()){
    ?>
    <tr>
      <td><?php echo $sql_sel_product_data['code']?></td>
      <td><?php echo $sql_sel_product_data['model']?></td>
      <td><?php echo $sql_sel_product_data['category']?></td>
      <td>
        <?php
        if($sql_sel_product_data['sex']==0){
          echo "Feminino";
        }else if($sql_sel_product_data['sex']==1){
          echo "Masculino";
        }else{
          echo "Unisex";
        }
        ?>
      </td>
      <td><?php echo $sql_sel_product_data['manufacturers']?></td>
      <td>R$ <?php echo number_format($sql_sel_product_data['price'],2,',','.');?></td>
      <td><button><a href="?folder=product/&file=jtc_fminsupd_product&ext=php&updid=<?php echo $sql_sel_product_data["id"];?>"><i class="fa fa-pencil-square" aria-hidden="true"></i></a></button></td>
      <td><button onclick="confirm_delete('?folder=product/&file=jtc_del_product&ext=php&delid=<?php echo $sql_sel_product_data["id"];?>',' Produto','<?php echo $sql_sel_product_data["model"];?>')"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
    </tr>
    <?php
      }
        }
    ?>
  </tbody>
</table>
