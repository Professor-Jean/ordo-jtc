<h1 id="title-page">Repasse de Produto para Conserto</h1>
<?php

?>
<div class="big_form">
  <?php
  if(isset($_GET["msgid"])){
    ?>
    <span><?php echo messageRepository($_GET["msgid"], $_GET["data"]);?></span>
    <?php
  }
  ?>
  <form name="" action="?folder=concert/&file=jtc_ins_inventory_concert&ext=php" method="POST" onsubmit="return validate_form()">
    <input type="hidden" name="removals_id" value="<?php echo $_GET["removals_id"];?>">
    <input type="hidden" name="products_has_sizes_id" value="<?php echo $_GET["products_has_sizes_id"];?>">
    <?php
      $sql_select_removals = "SELECT removals.id, removals.date, removals.hour, sellers.name FROM removals INNER JOIN sellers ON sellers.id = removals.sellers_id WHERE removals.id=".$_GET["removals_id"];
      $sql_select_removals_prepare = $dbconnection->prepare($sql_select_removals);
      $sql_select_removals_prepare->execute();
      $sql_select_removals_data = $sql_select_removals_prepare->fetch();
    ?>
    <br>
    Id: <?php echo $sql_select_removals_data["id"]?> <br>
    Data: <?php echo date_converter($sql_select_removals_data["date"], "-")?> <br>
    Horário: <?php echo substr($sql_select_removals_data["hour"], 0, -3)?> <br>
    Vendedor: <?php echo $sql_select_removals_data["name"]?> <br>
    <br>
    <div class="date">
      <input id="checkbox_date" type="checkbox" name="date_use" id="checkbox_date" ><label for="checkbox_date">Usar Data e Hora atuais</label>
      </br>
      <input id="input_date" type="text" class="datepicker" name="date" maxlength="10" placeholder="Data">
      <input id="input_hour" type="text" name="hour" maxlength="5" placeholder="Hora">
    </div>
    <input type="text" name="quantity" maxlength="4" placeholder="Quantidade">
    <h3>Produto</h3>
    <table id="table_products">
      <thead>
      <tr>
        <th>Fabricante</th>
        <th>Código</th>
        <th>Modelo</th>
        <th>Tamanho</th>
        <th>Sexo</th>
        <th>Quantidade</th>
      </tr>
      </thead>
      <tbody>
      <tr>
        <?php
          $sql_select_removals = "SELECT products.id, products.code, manufacturers.name, products.model, products.sex, sizes.size, removals_has_products_has_sizes.quantity FROM removals INNER JOIN removals_has_products_has_sizes ON removals_has_products_has_sizes.removals_id = removals.id INNER JOIN products_has_sizes ON products_has_sizes.id = removals_has_products_has_sizes.products_has_sizes_id INNER JOIN products ON products.id = products_has_sizes.products_id INNER JOIN sizes ON sizes.id = products_has_sizes.sizes_id INNER JOIN manufacturers ON manufacturers.id = products.manufacturers_id WHERE removals.id=".$_GET["removals_id"]." AND products_has_sizes.id=".$_GET["products_has_sizes_id"];
          $sql_select_removals_prepare = $dbconnection->prepare($sql_select_removals);
          $sql_select_removals_prepare->execute();
          $sql_select_removals_data = $sql_select_removals_prepare->fetch()
        ?>
        <td><?php echo $sql_select_removals_data["name"];?></td>
        <td><?php echo $sql_select_removals_data["code"];?></td>
        <td><?php echo $sql_select_removals_data["model"];?></td>
        <td>
          <?php
          if($sql_select_removals_data['sex']==0){
            echo "Feminino";
          }else if($sql_select_removals_data['sex']==1){
            echo "Masculino";
          }else{
            echo "Unissex";
          }
          ?>
        </td>
        <td><?php echo $sql_select_removals_data["size"];?></td>
        <td><?php echo $sql_select_removals_data["quantity"];?></td>
      </tr>
      </tbody>
    </table>
    <div class="buttons">
      <button type="reset"><i class="fa fa-refresh" aria-hidden="true"></i></button>
      <button type="submit">Cadastrar</button>
    </div>
  </form>
</div>