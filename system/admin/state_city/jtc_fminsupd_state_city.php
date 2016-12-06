<?php
  /**
  *Funcionalidade: este arquivo possui o formulário de registro e a tabela de dados das cidades e estados
  *Data de criação: 29/10/2016
  */

  ?>
<h1 id="title-page">Registro de Cidade & Estado</h1>
<div class="small_form">
  <?php
    if(isset($_GET["updid_city"])){
      ?>
        <h3>Alteração de Cidade</h3>
      <?php
    }else{
      ?>
        <h3>Cadastro de Cidade</h3>
      <?php
    }
    if(isset($_GET["msgid_city"])){
      ?>
        <span><?php echo messageRepository($_GET["msgid_city"], $_GET["data"])?></span>
      <?php
    }
    if(isset($_GET["updid_city"])){
      $sql_select_cities = "SELECT cities.id AS cities_id, cities.name, states.id AS states_id FROM cities INNER JOIN states ON states.id=cities.states_id WHERE cities.id='".$_GET["updid_city"]."'";
      $sql_select_cities_prepare = $dbconnection->prepare($sql_select_cities);
      $sql_select_cities_prepare->execute();
      $sql_select_cities_data = $sql_select_cities_prepare->fetch();
      ?>
        <form name="alt_city" method="POST" action="?folder=state_city/&file=jtc_upd_state_city&ext=php">
          <input type="hidden" name="id" value="<?php echo $sql_select_cities_data["cities_id"]?>">
          <input type="text" name="name" maxlength="45" value="<?php echo $sql_select_cities_data["name"]?>">
          <select name="state">
            <?php
              $sql_select_states = "SELECT * FROM states";
              $sql_select_states_prepare = &$dbconnection->prepare($sql_select_states);
              $sql_select_states_prepare->execute();
              while($sql_select_states_data = $sql_select_states_prepare->fetch()){
                if($sql_select_cities_data["states_id"]==$sql_select_states_data["id"]){
                  ?>
                    <option selected="" value="<?php echo $sql_select_states_data["id"];?>"><?php echo $sql_select_states_data["name"];?></option>
                  <?php
                }else{
                  ?>
                    <option value="<?php echo $sql_select_states_data["id"];?>"><?php echo $sql_select_states_data["name"];?></option>
                  <?php
                }
              }
            ?>
          </select>
          <div class="buttons">
            <button type="button"><a href="?folder=state_city/&file=jtc_fminsupd_state_city&ext=php">Cancelar</a></button>
            <button type="reset"><i class="fa fa-refresh" aria-hidden="true"></i></button>
            <button type="submit" name="alt_city">Alterar</button>
          </div>
        </form>
      <?php
    }else{
      ?>
      <form name="cad_city" method="POST" action="?folder=state_city/&file=jtc_ins_state_city&ext=php">
        <input type="text" name="name" maxlength="45" placeholder="Cidade">
        <select name="state">
          <option value="">Estado</option>
          <?php
          $sql_select_states = "SELECT * FROM states";
          $sql_select_states_prepare = &$dbconnection->prepare($sql_select_states);
          $sql_select_states_prepare->execute();
          while($sql_select_states_data = $sql_select_states_prepare->fetch()){
            ?>
             <option value="<?php echo $sql_select_states_data["id"];?>"><?php echo $sql_select_states_data["name"];?></option>
            <?php
          }
          ?>
        </select>
        <div class="buttons">
          <button type="reset"><i class="fa fa-refresh" aria-hidden="true"></i></button>
          <button type="submit" name="cad_city">Cadastrar</button>
        </div>
      </form>
      <?php
    }
  ?>
</div>
<div class="small_form">
  <?php
    if(isset($_GET["updid_state"])){
      ?>
        <h3>Alteração de Estado</h3>
      <?php
    }else{
      ?>
        <h3>Cadastro de Estado</h3>
      <?php
    }
    if(isset($_GET["msgid_state"])){
      ?>
        <span><?php echo messageRepository($_GET["msgid_state"], $_GET["data"])?></span>
      <?php
    }
    if(isset($_GET["updid_state"])){
      $sql_select_state = "SELECT * FROM states WHERE id='".$_GET["updid_state"]."'";
      $sql_select_states_prepare = $dbconnection->prepare($sql_select_state);
      $sql_select_states_prepare->execute();
      $sql_select_states_data = $sql_select_states_prepare->fetch();
      ?>
      <form name="alt_state" method="POST" action="?folder=state_city/&file=jtc_upd_state_city&ext=php">
        <input type="hidden" name="id" value="<?php echo $sql_select_states_data["id"]?>">
        <input type="text" name="name" maxlength="45" placeholder="Estado" value="<?php echo $sql_select_states_data["name"]?>">
        <input type="text" name="initials" maxlength="2" placeholder="Sigla" value="<?php echo $sql_select_states_data["initials"]?>">
        <div class="buttons">
          <button type="button"><a href="?folder=state_city/&file=jtc_fminsupd_state_city&ext=php">Cancelar</a></button>
          <button type="reset"><i class="fa fa-refresh" aria-hidden="true"></i></button>
          <button type="submit" name="alt_state">Alterar</button>
        </div>
      </form>
      <?php
    }else{
      ?>
        <form name="cad_state" method="POST" action="?folder=state_city/&file=jtc_ins_state_city&ext=php">
          <input type="text" name="name" maxlength="45" placeholder="Estado">
          <input type="text" name="initials" maxlength="2" placeholder="Sigla">
          <div class="buttons">
            <button type="reset"><i class="fa fa-refresh" aria-hidden="true"></i></button>
            <button type="submit" name="cad_state" >Cadastrar</button>
          </div>
        </form>
      <?php
    }
  ?>
</div>
<div id="table_tabs">
  <ul>
    <li><a href="#tabs-1">Estados</a></li>
    <li><a href="#tabs-2">Cidades</a></li>
  </ul>
  <div id="tabs-1">
    <table class="table_datatable">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nome</th>
          <th>Sigla</th>
          <th>Editar</th>
          <th>Excluir</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $sql_select_states = "SELECT * FROM states";
          $sql_select_states_prepare = $dbconnection->prepare($sql_select_states);
          $sql_select_states_prepare->execute();
          while($sql_select_states_data = $sql_select_states_prepare->fetch()){
            ?>
              <tr>
                <td><?php echo $sql_select_states_data["id"] ?></td>
                <td><?php echo $sql_select_states_data["name"] ?></td>
                <td><?php echo $sql_select_states_data["initials"] ?></td>
                <td><button><a href="?folder=state_city/&file=jtc_fminsupd_state_city&ext=php&updid_state=<?php echo $sql_select_states_data["id"];?>"><i class="fa fa-pencil-square" aria-hidden="true"></i></button></a></td>
                <td><button onclick="confirm_delete('?folder=state_city/&file=jtc_del_state_city&ext=php&delid_state=<?php echo $sql_select_states_data["id"];?>', 'Estado', '<?php echo $sql_select_states_data["name"];?>')"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
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
          <th>ID</th>
          <th>Nome</th>
          <th>Estado</th>
          <th>Editar</th>
          <th>Excluir</th>
        </tr>
      </thead>
      <tbody>
      <?php
      $sql_select_cities = "SELECT cities.id, cities.name, states.initials FROM cities INNER JOIN states ON states.id=cities.states_id";
      $sql_select_cities_prepare = $dbconnection->prepare($sql_select_cities);
      $sql_select_cities_prepare->execute();
      while($sql_select_cities_data = $sql_select_cities_prepare->fetch()){
        ?>
        <tr>
          <td><?php echo $sql_select_cities_data["id"] ?></td>
          <td><?php echo $sql_select_cities_data["name"] ?></td>
          <td><?php echo $sql_select_cities_data["initials"] ?></td>
          <td><button><a href="?folder=state_city/&file=jtc_fminsupd_state_city&ext=php&updid_city=<?php echo $sql_select_cities_data["id"];?>"><i class="fa fa-pencil-square" aria-hidden="true"></i></button></a></td>
          <td><button onclick="confirm_delete('?folder=state_city/&file=jtc_del_state_city&ext=php&delid_city=<?php echo $sql_select_cities_data["id"];?>', 'Cidade', '<?php echo $sql_select_cities_data["name"];?>')"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
        </tr>
        <?php
      }
      ?>
      </tbody>
    </table>
  </div>
</div>