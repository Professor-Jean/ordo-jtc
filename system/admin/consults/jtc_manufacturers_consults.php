<?php
/**
 *Funcionalidade: este arquivo é destinado à consulta dos fabricantes.
 *Data de criação: 01/11/2016
 */
?>
<h1 id="title-page">Consulta de Fabricantes</h1>
<?php
    $sql_sel_manufacturers = "SELECT * FROM manufacturers";
    $sql_sel_manufacturers_prepare = $dbconnection->prepare($sql_sel_manufacturers);
    $sql_sel_manufacturers_prepare->execute();
?>
<table class="table_datatable">
    <thead>
        <tr>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Telefone</th>
            <th>CNPJ</th>
        </tr>
    </thead>
    <tbody>
    <?php
        while($sql_sel_manufacturers_data = $sql_sel_manufacturers_prepare->fetch()){
        ?>
            <tr>
                <td><?php echo $sql_sel_manufacturers_data["name"];?></td>
                <td><?php echo $sql_sel_manufacturers_data["email"];?></td>
                <td><?php echo $sql_sel_manufacturers_data["phone"];?></td>
                <td><?php echo $sql_sel_manufacturers_data["cnpj"];?></td>
            </tr>
        <?php
        }
    ?>
    </tbody>
</table>

