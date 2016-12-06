<?php
/**
*Funcionalidade: Registrar o cheque.
*Data de criação: 17/10/2016
*Obs.: .....
*/
?>
<h1 id="title-page">Registro de Cheque</h1>
<div class="small_form">
  <?php
  if(isset($_GET['updid'])){
    ?>
      <h3>Alteração de Cheque</h3>
    <?php
  }else{
    ?>
     <h3>Cadastro de Cheque</h3>
  <?php
}
  if(isset($_GET['msgid'])){

    ?>
    <span><?php echo messageRepository($_GET['msgid'], $_GET['data'])?></span>
    <?php
    }
    if(isset($_GET["updid"])){
      $sql_select_check = "SELECT * FROM checks WHERE id='".$_GET["updid"]."'";
      $sql_select_check_prepare = $dbconnection->prepare($sql_select_check);
      $sql_select_check_prepare->execute();
      $sql_select_check_data = $sql_select_check_prepare->fetch();
      ?>
      <form name="alt_check" method="post" action="?folder=check/&file=jtc_upd_check&ext=php">
        <button id="modal_list_button" type="button" onclick="modal_list('seller', <?php echo $sql_select_check_data["id"];?>)">Vendedor <i>:<?php echo $sql_select_check_data["id"];?></i></button>
        <input type="hidden" name="id" value="<?php echo $sql_select_check_data["id"];?>">
        <input type="hidden" name="seller_id" value="01">
        <input type="text" name="number" placeholder="Número do cheque" value="<?php echo $sql_select_check_data["number"];?>">
        <div class="label_input">
          <label><p>R$</p></label>
          <input type="text" name="value" placeholder="Valor" value="<?php echo $sql_select_check_data["value"];?>">
        </div>
        <input type="text" name="date_good_for" placeholder="Bom-para" class="datepicker" value="<?php echo date_converter($sql_select_check_data["date_good_for"],'-');?>">
        <input type="text" name="date_receipt" placeholder="Data de recebimento" class="datepicker" value="<?php echo date_converter($sql_select_check_data["date_receipt"],'-');?>">
        <div class="buttons">
          <button type="reset"><i class="fa fa-refresh" aria-hidden="true"></i></button>
          <button type="submit">Alterar</button>
        </div>
      </form>
      <?php
    }else{
       ?>
      <form name="cad_check" method="post" action="?folder=check/&file=jtc_ins_check&ext=php">
        <button id="modal_list_button" type="button" onclick="modal_list('seller')">Vendedor <i></i></button>
        <input id="modal_list_input" type="hidden" name="seller_id">
        <input type="text" name="number" placeholder="Número do cheque">
        <div class="label_input">
          <label><p>R$</p></label>
          <input type="text" name="value" placeholder="Valor">
        </div>
        <input type="text" name="date_good_for" placeholder="Bom-para" class="datepicker">
        <input type="text" name="date_receipt" placeholder="Data de recebimento" class="datepicker">
        <div class="buttons">
        <button type="reset"><i class="fa fa-refresh" aria-hidden="true"></i></button>
          <button type="submit">Cadastrar</button>
        </div>
      </form>
      <?php
    }
  $sql_sel_checks = "SELECT checks.id, checks.number, checks.value, checks.date_good_for, sellers.name,checks.date_receipt, checks.status FROM checks INNER JOIN sellers ON checks.sellers_id = sellers.id";
  $sql_sel_checks_prepare = $dbconnection->prepare($sql_sel_checks);
  $sql_sel_checks_prepare->execute();

      ?>
    </div>
    <table class="table_datatable">
      <thead>
        <tr>
            <th>Vendedor</th>
            <th>Número de cheque</th>
            <th>Valor</th>
            <th>Data de recebimento</th>
            <th>Status</th>
            <th>Bom-para</th>
            <th>Editar</th>
            <th>Excluir</th>
        </tr>
      </thead>
      <tbody>
        <?php
          while($sql_sel_check_data = $sql_sel_checks_prepare->fetch()){
        ?>
          <tr>
              <td><?php echo $sql_sel_check_data['name'] ?></td>
              <td><?php echo $sql_sel_check_data['number'] ?></td>
              <td>R$ <?php echo $sql_sel_check_data['value'] ?></td>
              <td><?php echo date_converter($sql_sel_check_data['date_receipt'] , "-")?></td>
              <td><?php
                $type = array(
                  "0" =>"Pendente",
                  "1" =>"Confirmado",
                  "2" =>"Falhado",
                );
                echo $type[$sql_sel_check_data['status']];
                ?></td>
              <td><?php echo date_converter($sql_sel_check_data['date_good_for'], "-") ?></td>
              <td><button><a href="?folder=check/&file=jtc_fminsupd_check&ext=php&updid=<?php echo $sql_sel_check_data["id"];?>"><i class="fa fa-pencil-square" aria-hidden="true"></i></button></a></td>
              <td><button onclick="confirm_delete('?folder=check/&file=jtc_del_check&ext=php&delid=<?php echo $sql_sel_check_data["id"];?>', 'Cheque', '<?php echo $sql_sel_check_data["name"];?>')"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
          </tr>
          <?php
        }
       ?>
      </tbody>
    </table>
