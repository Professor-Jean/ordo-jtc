<?php
 /**
 *Funcionalidade: este arquivo faz a pesquisa da requisição ajax, ajax_seller();
 *Data de criação: 29/10/2016
 */

include "../../../security/authentication/jtc_permission_authentication.php";
include "../../../security/database/jtc_connection_database.php";

$id = $_POST["id"];

$sql_select_sellers = "SELECT id, name FROM sellers";
$sql_select_sellers_prepare = $dbconnection->prepare($sql_select_sellers);
$sql_select_sellers_prepare->execute();
?>
<table class="table_datatable_list">
  <thead>
    <tr>
      <th>#</th>
      <th>ID</th>
      <th>Nome</th>
    </tr>
  </thead>
  <tbody>
  <?php
    while($sql_select_sellers_data = $sql_select_sellers_prepare->fetch()){
      if($sql_select_sellers_data["id"]==$id){
        ?>
        <tr>
          <td><input checked  type="radio" name="id" value="<?php echo $sql_select_sellers_data["id"]; ?>"></td>
          <td><?php echo $sql_select_sellers_data["id"]; ?></td>
          <td><?php echo $sql_select_sellers_data["name"]; ?></td>
        </tr>
        <?php
      }else{
        ?>
        <tr>
          <td><input type="radio" name="seller" value="<?php echo $sql_select_sellers_data["id"]; ?>"></td>
          <td><?php echo $sql_select_sellers_data["id"]; ?></td>
          <td><?php echo $sql_select_sellers_data["name"]; ?></td>
        </tr>
        <?php
      }
    }
  ?>
  </tbody>
</table>
<script>
  $(".table_datatable_list").dataTable({
    "language": {
      "url": "//cdn.datatables.net/plug-ins/1.10.12/i18n/Portuguese-Brasil.json"
    },
    "bLengthChange": false,
    "info": false,
  });
</script>