<?php
/**
 *Funcionalidade: este arquivo é destinado ao formuário de reposição de produtos defeituosos
 *Data de criação: 16/11/2016
 */
?>
<h1 id="title-page">Reposição de Produtos Defeituosos</h1>
<div class="big_form">
    <?php
    if(isset($_GET["msgid"])){
        ?>
            <span><?php echo messageRepository($_GET["msgid"]);?></span>
        <?php
    }
    ?>
    <form name="defective_product" action="?folder=defective/&file=jtc_ins_defective_product&ext=php" method="POST" onsubmit="return validate_form()">
        <input type="hidden" name="repairs_id" value="<?php echo $_GET["id"];?>">
        <div class="date">
            <input id="checkbox_date" type="checkbox" name="date_use" id="checkbox_date" ><label for="checkbox_date">Usar Data e Hora atuais</label>
            </br>
            <input id="input_date" type="text" class="datepicker" name="date" maxlength="10" placeholder="Data">
            <input id="input_hour" type="text" name="hour" maxlength="5" placeholder="Hora">
        </div>
        <h3>Produtos</h3>
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
                <?php
                    $id = $_GET["id"];

                    $sql_select_repairs = "SELECT manufacturers.name, products.code, products.model, sizes.size, products.sex, repairs.quantity FROM repairs INNER JOIN removals_has_products_has_sizes ON removals_has_products_has_sizes.id = repairs.removals_has_products_has_sizes_id INNER JOIN products_has_sizes ON products_has_sizes.id = removals_has_products_has_sizes.products_has_sizes_id INNER JOIN products ON products.id = products_has_sizes.products_id INNER JOIN manufacturers ON manufacturers.id = products.manufacturers_id INNER JOIN sizes ON sizes.id = products_has_sizes.sizes_id WHERE repairs.id=".$id;
                    $sql_select_repairs_prepare = $dbconnection->prepare($sql_select_repairs);
                    $sql_select_repairs_prepare->execute();
                    $sql_select_repairs_data = $sql_select_repairs_prepare->fetch();
                ?>
                <tr>
                    <td><?php echo $sql_select_repairs_data["name"];?></td>
                    <td><?php echo $sql_select_repairs_data["code"];?></td>
                    <td><?php echo $sql_select_repairs_data["model"];?></td>
                    <td><?php echo $sql_select_repairs_data["size"];?></td>
                    <td>
                        <?php
                        if($sql_select_repairs_data['sex']==0){
                            echo "Feminino";
                        }else if($sql_select_repairs_data['sex']==1){
                            echo "Masculino";
                        }else{
                            echo "Unisex";
                        }
                        ?>
                    </td>
                    <td><?php echo $sql_select_repairs_data["quantity"];?></td>
                </tr>
            </tbody>
        </table>
        <div class="buttons">
            <button type="reset"  onclick="reset_form()"><i class="fa fa-refresh" aria-hidden="true"></i></button>
            <button type="submit">Cadastrar</button>
        </div>
    </form>
</div>
</div>
