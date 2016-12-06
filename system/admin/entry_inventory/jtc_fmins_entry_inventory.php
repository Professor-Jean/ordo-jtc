<?php
  /**
  *Funcionalidade: este arquivo é destinado ao formuário de enrtadade estoque
  *Data de criação: 31/10/2016
  */
?>
<h1 id="title-page">Entrada Produto em Estoque</h1>
<div class="big_form">
  <?php
    if(isset($_GET["msgid"])){
      ?>
       <span><?php echo messageRepository($_GET["msgid"]);?></span>
      <?php
    }
  ?>
  <form name="entry_inventory" action="?folder=entry_inventory/&file=jtc_ins_entry_inventory&ext=php" method="POST" onsubmit="return validate_form()">
    <h3>Tipo de entrada</h3>
    <input type="radio" name="type" id="radio_type_1" class="radio_type" value="0" checked="checked"><label for="radio_type_1">Produtos novos</label>
    <input type="radio" name="type" id="radio_type_2" class="radio_type" value="1"><label for="radio_type_2">Devolução</label>
    <br>
    <button id="modal_list_button" type="button" disabled="" onclick="modal_list('seller')">Vendedor <i></i></button>
    <input id="modal_list_input" type="hidden" name="seller">
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
          <th>Sexo</th>
          <th>Tamanho</th>
          <th>Quantidade</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr class="line">
          <td>
            <select name="manufacturers[]" onchange="alt_code(this)">
              <option value="" hidden>Fabricante</option>
              <?php
                $sql_select_manufacturers = "SELECT id, name FROM manufacturers";
                $sql_select_manufacturers_prepare = $dbconnection->prepare($sql_select_manufacturers);
                $sql_select_manufacturers_prepare->execute();
                while($sql_select_manufacturers_data = $sql_select_manufacturers_prepare->fetch()){
                  ?>
                    <option value="<?php echo $sql_select_manufacturers_data["id"];?>"><?php echo $sql_select_manufacturers_data["name"];?></option>
                  <?php
                }
              ?>
            </select>
          </td>
          <td class="code">
            <select name="code[]" class="code" disabled="" onchange="alt_sex_model(this)">
              <option value="" hidden>Código</option>
            </select>
          </td>
          <td class="model">
            ---
          </td>
          <td class="sex">
            ---
          </td>
          <td>
            <select class="batata" name="size[]">
              <option value="" hidden>Tamanho</option>
              <?php
                $sql_select_sizes = "SELECT id, size FROM sizes";
                $sql_select_sizes_prepare = $dbconnection->prepare($sql_select_sizes);
                $sql_select_sizes_prepare->execute();
                while($sql_select_sizes_data = $sql_select_sizes_prepare->fetch()){
                  ?>
                    <option value="<?php echo $sql_select_sizes_data["id"];?>"><?php echo $sql_select_sizes_data["size"];?></option>
                  <?php
                }
              ?>
            </select>
          </td>
          <td>
            <input type="text" name="quantity[]" placeholder="Quantidade">
          </td>
          <td>
            <a href="#del_line" onclick="del_line(this)" title="Adicionar item"><i class="fa fa-minus-square" aria-hidden="true"></i></a>
          </td>
        </tr>
      </tbody>
      <tfoot>
      <td colspan="6">
      </td>
      <td>
        <a href="#add_line" onclick="add_line()" title="Adicionar item"><i class="fa fa-plus-square" aria-hidden="true"></i></a>
      </td>
      </tfoot>
    </table>
    <div class="buttons">
      <button type="reset"  onclick="reset_form()"><i class="fa fa-refresh" aria-hidden="true"></i></button>
      <button type="submit">Cadastrar</button>
    </div>
  </form>
</div>