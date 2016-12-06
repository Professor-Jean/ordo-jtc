<?php
/**
 *Funcionalidade: este arquivo é destinado à consulta dos produtos.
 *Data de criação: 01/11/2016
 */
?>
<h1 id="title-page">Consulta de Produtos</h1>
<?php
  $sql_sel_product = "SELECT products.code, products.id, products.categories_id, products.manufacturers_id, products.model, products.sex, products.price, manufacturers.name AS manufacturers, categories.category AS category FROM products INNER JOIN categories ON products.categories_id = categories.id INNER JOIN manufacturers ON products.manufacturers_id = manufacturers.id";
  $sql_sel_product_prepare = $dbconnection->prepare($sql_sel_product);
  $sql_sel_product_prepare->execute();
 ?>
<table class="table_datatable">
  <thead>
    <tr>
      <th>Código</th>
      <th>Modelo</th>
      <th>Categoria</th>
      <th>Sexo</th>
      <th>Marca</th>
      <th>Preço</th>
    </tr>
  </thead>
  <tbody>
    <?php
      while($sql_sel_product_data = $sql_sel_product_prepare->fetch()){
    ?>
    <tr>
      <td><?php echo $sql_sel_product_data['code'];?></td>
      <td><?php echo $sql_sel_product_data['model'];?></td>
      <td><?php echo $sql_sel_product_data['category'];?></td>
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
      <td><?php echo $sql_sel_product_data['manufacturers'];?></td>
      <td>R$ <?php echo number_format($sql_sel_product_data['price'],2,',','.');?></td>
    </tr>
  <?php
    }
  ?>
  </tbody>
</table>
