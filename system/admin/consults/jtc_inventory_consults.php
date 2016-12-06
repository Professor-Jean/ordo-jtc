<?php
/**
*Funcionalidade: Página para as consulta do estoque.
*Data de criação: 30/10/2016
*/
?>
<h1 id="title-page">Consulta de Estoque</h1>
<?php
$sql_sel_inventory = "SELECT inventories.id, inventories.products_has_sizes_id, inventories.quantity, products_has_sizes.products_id, products.model, products.code, products.sex, products.price, sizes.size, manufacturers.name AS manufacturers, products_has_sizes.sizes_id FROM inventories INNER JOIN products_has_sizes ON inventories.products_has_sizes_id = products_has_sizes.id INNER JOIN products ON products_has_sizes.products_id = products.id INNER JOIN sizes ON products_has_sizes.sizes_id = sizes.id INNER JOIN manufacturers ON products.manufacturers_id = manufacturers.id WHERE inventories.quantity<>0";
$sql_sel_inventory_prepare = $dbconnection->prepare($sql_sel_inventory);
$sql_sel_inventory_prepare->execute();
?>
<table class="table_datatable">
  <thead>
    <tr>
      <td>Código</td>
      <td>Modelo</td>
      <td>Tamanho</td>
      <td>Sexo</td>
      <td>Fabricante</td>
      <td>Quantidade</td>
      <td>Preço Unid.</td>
      <td>Preço Total</td>
    </tr>
  </thead>
  <tbody>
    <?php
      while($sql_sel_inventory_data = $sql_sel_inventory_prepare->fetch()){
        setlocale(LC_MONETARY,"pt_BR", "ptb");
    ?>
    <tr>
      <td><?php echo $sql_sel_inventory_data['code'];?></td>
      <td><?php echo $sql_sel_inventory_data['model'];?></td>
      <td><?php echo $sql_sel_inventory_data['size'];?></td>
      <td>
        <?php
          if($sql_sel_inventory_data['sex']==0){
            echo "Feminino";
          }else if($sql_sel_inventory_data['sex']==1){
            echo "Masculino";
          }else{
            echo "Unissex";
          }
        ?>
      </td>
      <td><?php echo $sql_sel_inventory_data['manufacturers'];?></td>
      <td><?php echo $sql_sel_inventory_data['quantity'];?></td>
      <td>R$<?php echo number_format( $sql_sel_inventory_data['price'],2,',','.');?></td>
      <td>R$<?php echo number_format($sql_sel_inventory_data['quantity'] * $sql_sel_inventory_data['price'],2,',','.'); ?></td>
    </tr>
    <?php
      }
    ?>
  </tbody>
</table>