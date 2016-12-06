<?php
/**
 *Funcionalidade: este arquivo é destinado à Histórico de Repasses de Produtos Defeituosos.
 *Data de criação: 17/11/2016
 */
?>
<h1 id="title-page">Histórico de Repasse de Produtos Defeituosos</h1>
<?php
$sql_sel_product = "SELECT repairs.entries_id, repairs.date, repairs.hour, sizes.size, products.model, sellers.name AS seller_name, products.code, manufacturers.name AS manufacturer_name, removals_has_products_has_sizes.quantity FROM repairs INNER JOIN removals_has_products_has_sizes ON repairs.removals_has_products_has_sizes_id = removals_has_products_has_sizes.id INNER JOIN removals ON removals_has_products_has_sizes.removals_id = removals.id INNER JOIN sellers ON removals.sellers_id = sellers.id INNER JOIN products_has_sizes ON removals_has_products_has_sizes.products_has_sizes_id = products_has_sizes.id INNER JOIN products ON products_has_sizes.products_id = products.id INNER JOIN manufacturers ON products.manufacturers_id = manufacturers.id INNER JOIN sizes ON sizes.id = products_has_sizes.sizes_id";
$sql_sel_product_prepare = $dbconnection->prepare($sql_sel_product);
$sql_sel_product_prepare->execute();
?>
<table class="table_datatable">
    <thead>
    <tr>
        <th>Data</th>
        <th>Horário</th>
        <th>Código</th>
        <th>Modelo</th>
        <th>Tamanho</th>
        <th>Fabricante</th>
        <th>Quantidade</th>
        <th>Vendedor</th>
        <th>Entrada</th>
    </tr>
    </thead>
    <tbody>
    <?php
    while($sql_sel_product_data = $sql_sel_product_prepare->fetch()){
        ?>
        <tr>
            <td><?php echo date_converter($sql_sel_product_data['date'], "-");?></td>
            <td><?php echo substr($sql_sel_product_data['hour'], 0, -3);?></td>
            <td><?php echo $sql_sel_product_data['code'];?></td>
            <td><?php echo $sql_sel_product_data['model'];?></td>
            <td><?php echo $sql_sel_product_data['size'];?></td>
            <td><?php echo $sql_sel_product_data['manufacturer_name'];?></td>
            <td><?php echo $sql_sel_product_data['quantity'];?></td>
            <td><?php echo $sql_sel_product_data['seller_name'];?></td>
            <td><?php
                if($sql_sel_product_data['entries_id']==""){
                    echo "---";
                }else{
                    echo $sql_sel_product_data['entries_id'];
                }
                ;?>
            </td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>
