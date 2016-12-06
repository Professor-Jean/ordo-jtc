<h2 id="title-page">Seja bem-vindo ao Gerenciador de Estoque JTC</h2>
<?php
$sql_sel_sellers= "SELECT COUNT(*) AS count_sellers FROM sellers";
$sql_sel_sellers_prepare = $dbconnection->prepare($sql_sel_sellers);
$sql_sel_sellers_prepare->execute();
$sql_sel_sellers_data = $sql_sel_sellers_prepare->fetch();

$sql_sel_inventories= "SELECT SUM(quantity) AS sum_products FROM inventories";
$sql_sel_inventories_prepare = $dbconnection->prepare($sql_sel_inventories);
$sql_sel_inventories_prepare->execute();
$sql_sel_inventories_data = $sql_sel_inventories_prepare->fetch();

$sql_sel_manufacturers= "SELECT COUNT(*) AS count_manufacturers FROM manufacturers";
$sql_sel_manufacturers_prepare = $dbconnection->prepare($sql_sel_manufacturers);
$sql_sel_manufacturers_prepare->execute();
$sql_sel_manufacturers_data = $sql_sel_manufacturers_prepare->fetch();


?>
<table style="width: 100%;">
  <tbody>
  <?php
  $sql_sel_value= "SELECT inventories.quantity, products.price FROM inventories INNER JOIN products_has_sizes ON inventories.products_has_sizes_id = products_has_sizes.id INNER JOIN products ON products_has_sizes.products_id = products.id";
  $sql_sel_value_prepare = $dbconnection->prepare($sql_sel_value);
  $sql_sel_value_prepare->execute();

  $price_inventory = 0;
  while($sql_sel_value_data = $sql_sel_value_prepare->fetch()){
    $price_inventory = $price_inventory + $sql_sel_value_data["quantity"] * $sql_sel_value_data["price"];
  }

  ?>
  <tr>
    <th>Valor em estoque</th>
    <td>R$<?php echo number_format ($price_inventory,2,',','.')  ?></td>
  </tr>
  <tr>
    <th>Produtos em estoque</th>
    <td><?php echo $sql_sel_inventories_data['sum_products']?></td>
  </tr>
  <tr>
    <th>Vendedores cadastrados</th>
    <td><?php echo $sql_sel_sellers_data['count_sellers']?></td>
  </tr>
  <tr>
    <th>Fabricantes cadastrados</th>
    <td><?php echo $sql_sel_manufacturers_data['count_manufacturers']?></td>
  </tr>
  </tbody>
</table>
