<?php
/**
 *Funcionalidade: este arquivo é destinado à consulta dos cheques.
 *Data de criação: 01/11/2016
 */
?>
<h1 id="title-page">Consulta de Cheques</h1>
<?php
$sql_sel_checks = "SELECT check.id, checks.sellers_id, checks.number, checks.value, checks.date_good_for, sellers.name  FROM checks INNER JOIN sellers ON checks.sellers_id = sellers.id";
$sql_sel_checks_prepare = $dbconnection->prepare($sql_sel_checks);
$sql_sel_checks_prepare->execute();

?>
<div id="table_tabs">
    <ul>
        <li><a href="#tabs-1">Pendente</a></li>
        <li><a href="#tabs-2">Confirmado</a></li>
        <li><a href="#tabs-3">Falhos</a></li>
    </ul>
    <div>
    <div id="tabs-1">
        <table class="table_datatable">
            <thead>
                <tr>
                    <th>Vendedor</th>
                    <th>Número do cheque</th>
                    <th>Valor</th>
                    <th>Data a ser descontado</th>
                    <th>Confirmar</th>
                    <th>Falhar</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $sql_sel_checks = "SELECT checks.id, checks.number, checks.value, checks.date_good_for, sellers.name  FROM checks INNER JOIN sellers ON checks.sellers_id = sellers.id WHERE checks.status = 0";
            $sql_sel_checks_prepare = $dbconnection->prepare($sql_sel_checks);
            $sql_sel_checks_prepare->execute();

            while($sql_sel_checks_data = $sql_sel_checks_prepare->fetch()){
                ?>
                <tr>
                    <td><?php echo $sql_sel_checks_data["name"]; ?></td>
                    <td><?php echo $sql_sel_checks_data["number"]; ?></td>
                    <td>R$<?php echo number_format($sql_sel_checks_data["value"],2,',','.'); ?></td>
                    <td><?php echo date_converter($sql_sel_checks_data["date_good_for"], "-"); ?></td>
                    <td><button><a href="?folder=check/&file=jtc_confirm_check&ext=php&id=<?php echo $sql_sel_checks_data['id'];?>"><i class="fa fa-check-circle" aria-hidden="true"></i></a></button></td>
                    <td><button><a href="?folder=check/&file=jtc_decline_check&ext=php&id=<?php echo $sql_sel_checks_data['id'];?>"> <i class="fa fa-times-circle" aria-hidden="true"></i> </a></button></td>
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
                <th>Vendedor</th>
                <th>Número do cheque</th>
                <th>Valor</th>
                <th>Data a ser descontado</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $sql_sel_checks = "SELECT  checks.id, checks.number, checks.value, checks.date_good_for, sellers.name  FROM checks INNER JOIN sellers ON checks.sellers_id = sellers.id WHERE checks.status = 1";
            $sql_sel_checks_prepare = $dbconnection->prepare($sql_sel_checks);
            $sql_sel_checks_prepare->execute();

            while($sql_sel_checks_data = $sql_sel_checks_prepare->fetch()){
                ?>
                <tr>
                    <td><?php echo $sql_sel_checks_data["name"]; ?></td>
                    <td><?php echo $sql_sel_checks_data["number"]; ?></td>
                    <td><?php echo $sql_sel_checks_data["value"]; ?></td>
                    <td><?php echo date_converter($sql_sel_checks_data["date_good_for"], "-"); ?></td>
                </tr>
                <?php
            }
            ?>
            </tbody>
            </table>
    </div>
    <div id="tabs-3">
        <table class="table_datatable">
            <thead>
            <tr>
                <th>Vendedor</th>
                <th>Número do cheque</th>
                <th>Valor</th>
                <th>Data a ser descontado</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $sql_sel_checks = "SELECT checks.id, checks.number, checks.value, checks.date_good_for, sellers.name  FROM checks INNER JOIN sellers ON checks.sellers_id = sellers.id WHERE checks.status = 2";
            $sql_sel_checks_prepare = $dbconnection->prepare($sql_sel_checks);
            $sql_sel_checks_prepare->execute();

            while($sql_sel_checks_data = $sql_sel_checks_prepare->fetch()){
                ?>
                <tr>
                    <td><?php echo $sql_sel_checks_data["name"]; ?></td>
                    <td><?php echo $sql_sel_checks_data["number"]; ?></td>
                    <td><?php echo $sql_sel_checks_data["value"]; ?></td>
                    <td><?php echo date_converter($sql_sel_checks_data["date_good_for"], "-"); ?></td>
                </tr>
                <?php
            }
            ?>
            </tbody>
            </table>
    </div>
    </div>
</div>