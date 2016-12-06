<?php
/**
*Funcionalidade: Página para verificar o histórico de brindes.
*Data de criação: 30/10/2016
*/
?>
<h1 id="title-page">Histórico de Brindes</h1>
<?php
  $sql_sel_present = "SELECT products.sex, removals_has_products_has_sizes.quantity, removals.date, removals.hour, products.code, products.model, sellers.name, sizes.size FROM removals_has_products_has_sizes RIGHT JOIN removals ON removals_has_products_has_sizes.removals_id = removals.id INNER JOIN products_has_sizes ON removals_has_products_has_sizes.products_has_sizes_id = products_has_sizes.id INNER JOIN products ON products_has_sizes.products_id = products.id INNER JOIN sellers ON removals.sellers_id = sellers.id INNER JOIN sizes ON sizes.id = products_has_sizes.sizes_id WHERE removals.type = '1'";
  $sql_sel_present_prepare = $dbconnection->prepare($sql_sel_present);
  $sql_sel_present_prepare->execute();
?>
<table class="table_datatable">
  <thead>
    <tr>
      <th>Data</th>
      <th>Horário</th>
      <th>Código</th>
      <th>Modelo</th>
      <th>Size</th>
      <th>Sexo</th>
      <th>Quantidade</th>
      <th>Vendedor</th>
    </tr>
  </thead>
  <tbody>
    <?php
      while($sql_sel_present_data = $sql_sel_present_prepare->fetch()){
    ?>
    <tr>
      <td><?php echo date_converter($sql_sel_present_data["date"], "-");?></td>
      <td><?php echo substr($sql_sel_present_data["hour"], 0, -3);?></td>
      <td><?php echo $sql_sel_present_data["code"];?></td>
      <td><?php echo $sql_sel_present_data["model"];?></td>
      <td><?php echo $sql_sel_present_data["size"];?></td>
      <td><?php
        $sex = array(
          0 => "Feminino",
          1 => "Masculino",
          2 => "Unissex"
        );
        echo $sex[$sql_sel_present_data["sex"]];

        ?></td>
      <td><?php echo $sql_sel_present_data["quantity"];?></td>
      <td><?php echo $sql_sel_present_data["name"];?></td>
    </tr>
    <?php
      }
    ?>
  </tbody>
</table>
