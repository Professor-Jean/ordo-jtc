<?php
  /**
  *Funcionalidade: este arquivo possua os formulários de registro e a tabela de vendedores
  *Data de criação: 28/19/2016
  */

?>
<h1 id="title-page">Registro de Vendedor</h1>
<div class="small_form">
  <?php
    if(isset($_GET["updid"])){
      ?>
        <h3>Alteração de Vendedor</h3>
      <?php
    }else{
      ?>
        <h3>Cadastro de Vendedor</h3>
      <?php
    }
    if(isset($_GET["msgid"])){
      ?>
        <span><?php echo messageRepository($_GET["msgid"], $_GET["data"])?></span>
      <?php
    }
    if(isset($_GET["updid"])){
      $sql_select_sellers = "SELECT sellers.id AS sellers_id, sellers.name, sellers.email, sellers.birth_date, sellers.phone, cities.id, cities.states_id AS states_id, cities.id AS cities_id FROM sellers INNER JOIN cities ON sellers.cities_id=cities.id WHERE sellers.id='".$_GET["updid"]."'";
      $sql_select_sellers_prepare = $dbconnection->prepare($sql_select_sellers);
      $sql_select_sellers_prepare->execute();
      $sql_select_sellers_data = $sql_select_sellers_prepare->fetch();
      ?>
        <form name="cad_seller" method="POST" action="?folder=seller/&file=jtc_upd_seller&ext=php">
          <input type="hidden" name="id" value="<?php echo $sql_select_sellers_data["sellers_id"];?>">
          <input type="text" name="name" maxlength="45" placeholder="Nome" value="<?php echo $sql_select_sellers_data["name"];?>">
          <input class="datepicker" class="datepicker" type="text" name="date" maxlength="10" placeholder="Data de Nascimento" value="<?php echo date_converter($sql_select_sellers_data["birth_date"], "-");?>">
          <input type="text" name="email" maxlength="100" placeholder="E-mail" value="<?php echo $sql_select_sellers_data["email"];?>">
          <input type="text" name="phone" maxlength="20" placeholder="Telefone" value="<?php echo $sql_select_sellers_data["phone"];?>">
          <select id="state" name="state">
            <option value="" hidden="">Estado</option>
            <?php
              $sql_select_states = "SELECT * FROM states";
              $sql_select_states_prepare = $dbconnection->prepare($sql_select_states);
              $sql_select_states_prepare->execute();
              while($sql_select_states_data = $sql_select_states_prepare->fetch()){
                if($sql_select_sellers_data["states_id"]==$sql_select_states_data["id"]){
                  ?>
                    <option selected="" value="<?php echo $sql_select_states_data["id"];?>"><?php echo $sql_select_states_data["initials"];?> <?php echo $sql_select_states_data["name"];?></option>
                  <?php
                }else{
                  ?>
                    <option value="<?php echo $sql_select_states_data["id"];?>"><?php echo $sql_select_states_data["initials"];?> <?php echo $sql_select_states_data["name"];?></option>
                  <?php
                }
              }
            ?>
          </select>
          <select id="city" name="city">
            <option value="" hidden="">Selecione uma cidade</option>
            <?php
              $sql_select_cities = "SELECT * FROM cities WHERE states_id='".$sql_select_sellers_data["states_id"]."'";
              $sql_select_cities_prepare = $dbconnection->prepare($sql_select_cities);
              $sql_select_cities_prepare->execute();
              while($sql_select_cities_data = $sql_select_cities_prepare->fetch()){
                if($sql_select_sellers_data["cities_id"]==$sql_select_cities_data["id"]){
                  ?>
                    <option selected="" value="<?php echo $sql_select_cities_data["id"];?>"><?php echo $sql_select_cities_data["name"];?></option>
                  <?php
                }else{
                  ?>
                    <option value="<?php echo $sql_select_cities_data["id"];?>"><?php echo $sql_select_cities_data["name"];?></option>
                  <?php
                }
              }
            ?>
          </select>
          <div class="buttons">
            <button type="button"><a href="?folder=seller/&file=jtc_fminsupd_seller&ext=php">Cancelar</a></button>
            <button type="reset"><i class="fa fa-refresh" aria-hidden="true"></i></button>
            <button type="submit">Alterar</button>
          </div>
        </form>
      <?php
    }else{
      ?>
        <form name="cad_seller" method="POST" action="?folder=seller/&file=jtc_ins_seller&ext=php">
          <input type="text" name="name" maxlength="45" placeholder="Nome">
          <input class="datepicker" type="text" name="date" maxlength="10" placeholder="Data de Nascimento">
          <input type="text" name="email" maxlength="100" placeholder="E-mail">
          <input type="text" name="phone" maxlength="20" placeholder="Telefone">
          <select id="state" name="state">
            <option value="" hidden="">Estado</option>
            <?php
              $sql_select_states = "SELECT * FROM states";
              $sql_select_states_prepare = $dbconnection->prepare($sql_select_states);
              $sql_select_states_prepare->execute();
              while($sql_select_states_data = $sql_select_states_prepare->fetch()){
                ?>
                  <option value="<?php echo $sql_select_states_data["id"];?>"><?php echo $sql_select_states_data["initials"];?> - <?php echo $sql_select_states_data["name"];?></option>
                <?php
              }
            ?>
          </select>
          <select disabled="" id="city" name="city">
            <option value="" hidden="">Selecione uma cidade</option>
            <?php
              $sql_select_cities = "SELECT * FROM cities";
              $sql_select_cities_prepare = $dbconnection->prepare($sql_select_cities);
              $sql_select_cities_prepare->execute();
              while($sql_select_cities_data = $sql_select_cities_prepare->fetch()){
                ?>
                  <option value="<?php echo $sql_select_cities_data["id"]?>"><?php echo $sql_select_cities_data["name"]?></option>
                <?php
              }
            ?>
          </select>
          <div class="buttons">
            <button type="reset"><i class="fa fa-refresh" aria-hidden="true"></i></button>
            <button type="submit">Cadastrar</button>
          </div>
        </form>
      <?php
    }
  ?>
</div>

<table class="table_datatable">
  <thead>
    <tr>
      <th>ID</th>
      <th>Nome</th>
      <th>E-mail</th>
      <th>Telefone</th>
      <th>Editar</th>
      <th>Excluir</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $sql_select_sellers = "SELECT id, email, name, phone FROM sellers";
      $sql_select_sellers_prepare = $dbconnection->prepare($sql_select_sellers);
      $sql_select_sellers_prepare->execute();
      while($sql_select_sellers_data = $sql_select_sellers_prepare->fetch()){
        ?>
          <tr>
            <td><?php echo $sql_select_sellers_data["id"];?></td>
            <td><?php echo $sql_select_sellers_data["name"];?></td>
            <td><?php echo $sql_select_sellers_data["email"];?></td>
            <td><?php echo $sql_select_sellers_data["phone"];?></td>
            <td><button><a href="?folder=seller/&file=jtc_fminsupd_seller&ext=php&updid=<?php echo $sql_select_sellers_data["id"];?>"><i class="fa fa-pencil-square" aria-hidden="true"></i></button></a></td>
            <td><button onclick="confirm_delete('?folder=seller/&file=jtc_del_seller&ext=php&delid=<?php echo $sql_select_sellers_data["id"];?>', 'Vendedor', '<?php echo $sql_select_sellers_data["name"];?>')"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
          </tr>
        <?php
      }
    ?>
  </tbody>
</table>
