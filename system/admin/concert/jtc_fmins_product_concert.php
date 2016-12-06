
<h1 id="title-page">Repasse de Produto para Conserto</h1>

<p>
  <?php

    $id = $_GET["id"];

    $sql_select_removals = "SELECT removals.id, removals.date, removals.hour, sellers.name FROM removals INNER JOIN sellers ON sellers.id = removals.sellers_id WHERE removals.id=".$id;
    $sql_select_removals_prepare = $dbconnection->prepare($sql_select_removals);
    $sql_select_removals_prepare->execute();
    $sql_select_removals_data = $sql_select_removals_prepare->fetch();
  ?>
  Id: <?php echo $sql_select_removals_data["id"]?> <br>
  Data: <?php echo $sql_select_removals_data["date"]?> <br>
  Horário: <?php echo $sql_select_removals_data["hour"]?> <br>
  Vendedor: <?php echo $sql_select_removals_data["name"]?> <br>
</p>
<br>
<table style="width: 100%;">
  <thead>
    <th>Código</th>
    <th>Fabricante</th>
    <th>Modelo</th>
    <th>Sexo</th>
    <th>Tamanho</th>
    <th>Quantidade</th>
    <th>Selecionar</th>
  </thead>
  <tbody>
    <?php
      $id = $_GET["id"];

      $sql_select_removals = "SELECT products_has_sizes.id, products.code, manufacturers.name, products.model, products.sex, sizes.size, removals_has_products_has_sizes.quantity FROM removals INNER JOIN removals_has_products_has_sizes ON removals_has_products_has_sizes.removals_id = removals.id INNER JOIN products_has_sizes ON products_has_sizes.id = removals_has_products_has_sizes.products_has_sizes_id INNER JOIN products ON products.id = products_has_sizes.products_id INNER JOIN sizes ON sizes.id = products_has_sizes.sizes_id INNER JOIN manufacturers ON manufacturers.id = products.manufacturers_id WHERE removals.id=".$id;
      $sql_select_removals_prepare = $dbconnection->prepare($sql_select_removals);
      $sql_select_removals_prepare->execute();
      while($sql_select_removals_data = $sql_select_removals_prepare->fetch()){
        ?>
          <tr>
            <td><?php echo $sql_select_removals_data["code"];?></td>
            <td><?php echo $sql_select_removals_data["name"];?></td>
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
            <td><button><a href="?folder=concert/&file=jtc_fmins_inventory_concert&ext=php&removals_id=<?php echo $id?>&products_has_sizes_id=<?php echo $sql_select_removals_data["id"]?>"><i class="fa fa-arrow-right" aria-hidden="true"></i></a></button></td>
          </tr>
        <?php
      }
    ?>
  </tbody>
</table>