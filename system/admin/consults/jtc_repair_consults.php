<?php
/**
 *Funcionalidade: este arquivo é destinado à consulta dos produtos.
 *Data de criação: 01/11/2016
 */
?>
<h1 id="title-page">Consulta de Repasse de Conserto</h1>

<?php
  if(isset($_GET['msgid'])){
    ?>
    <span><?php echo messageRepository($_GET['msgid']);?></span>
    <?php
  }


  $sql_sel_quantity = "SELECT SUM(quantity) AS total_conserto FROM removals_has_products_has_sizes INNER JOIN removals ON removals_has_products_has_sizes.outs_id = removals.id WHERE type = '2'";
  $sql_sel_quantity_prepare = $dbconnection->prepare($sql_sel_quantity);
  $sql_sel_quantity_prepare->execute();
  while($sql_sel_quantity_data = $sql_sel_quantity_prepare->fetch()) {
    ?>
    <h3>Total de Produtos em Conserto: <?php echo $sql_sel_quantity_data["total_conserto"]; ?> </h3>
    <?php
  }
?>
<div id="table_tabs">
  <ul>
    <li><a href="#tabs-1">Consertos Recebidos</a></li>
    <li><a href="#tabs-2">Consertos Pendentes</a></li>
  </ul>
  <div>
  <div id="tabs-1">
    <table class="table_datatable">
      <thead>
        <tr>
          <th>Data</th>
          <th>Horário</th>
          <th>Código</th>
          <th>Fabricante</th>
          <th>Quantidade</th>
        </tr>
      </thead>
      <tbody>
      <?php
        $sql_sel_repair_entries = "SELECT repairs.id, repairs.date, repairs.hour, products.code, manufacturers.name, removals_has_products_has_sizes.quantity FROM repairs INNER JOIN removals_has_products_has_sizes ON repairs.removals_has_products_has_sizes_id = removals_has_products_has_sizes.id INNER JOIN products_has_sizes ON removals_has_products_has_sizes.products_has_sizes_id = products_has_sizes.id INNER JOIN products ON products_has_sizes.products_id = products.id INNER JOIN manufacturers ON products.manufacturers_id = manufacturers.id WHERE repairs.entries_id IS NOT NULL";
        $sql_sel_repair_entries_prepare = $dbconnection->prepare($sql_sel_repair_entries);
        $sql_sel_repair_entries_prepare->execute();
        while($sql_sel_repair_entries_data = $sql_sel_repair_entries_prepare->fetch()){
      ?>
        <tr>
          <td><?php echo date_converter($sql_sel_repair_entries_data['date'], "-"); ?></td>
          <td><?php echo $sql_sel_repair_entries_data["hour"]; ?></td>
          <td><?php echo $sql_sel_repair_entries_data["code"]; ?></td>
          <td><?php echo $sql_sel_repair_entries_data["name"]; ?></td>
          <td><?php echo $sql_sel_repair_entries_data["quantity"]; ?></td>
        </tr>
      <?php
         }
      ?>
      </tbody>
    </table>
    </div>
    <div id="tabs-2">
      <table class="table_datatable">
        <thead>
          <tr>
            <th>Data</th>
            <th>Horário</th>
            <th>Código</th>
            <th>Fabricante</th>
            <th>Quantidade</th>
            <th>Reposição de Produtos Defeituosos</th>
          </tr>
        </thead>
        <tbody>
        <?php
        $sql_sel_repair = "SELECT repairs.id, repairs.date, repairs.hour, products.code, manufacturers.name, removals_has_products_has_sizes.quantity FROM repairs  INNER JOIN removals_has_products_has_sizes ON repairs.removals_has_products_has_sizes_id = removals_has_products_has_sizes.id INNER JOIN products_has_sizes ON removals_has_products_has_sizes.products_has_sizes_id = products_has_sizes.id INNER JOIN products ON products_has_sizes.products_id = products.id INNER JOIN manufacturers ON products.manufacturers_id = manufacturers.id  WHERE repairs.entries_id IS NULL  ";
        $sql_sel_repair_prepare = $dbconnection->prepare($sql_sel_repair);
        $sql_sel_repair_prepare->execute();
        while($sql_sel_repair_data = $sql_sel_repair_prepare->fetch()){
        ?>
          <td><?php echo date_converter($sql_sel_repair_data['date'], "-"); ?></td>
          <td><?php echo $sql_sel_repair_data["hour"]; ?></td>
          <td><?php echo $sql_sel_repair_data["code"]; ?></td>
          <td><?php echo $sql_sel_repair_data["name"]; ?></td>
          <td><?php echo $sql_sel_repair_data["quantity"]; ?></td>
          <td><button><a href="?folder=defective/&file=jtc_fmins_defective_product&ext=php&id=<?php echo $sql_sel_repair_data['id'];?>"><i class="fa fa-sign-out" aria-hidden="true"></i></a></button></td>
        </tbody>
        <?php
          }
        ?>
      </table>
    </div>
  </div>
</div>