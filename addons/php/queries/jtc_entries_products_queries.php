<?php

include "../../../security/authentication/jtc_permission_authentication.php";
include "../../../security/database/jtc_connection_database.php";

  $id = $_POST["id"];

  $sql_select_entries =
   "SELECT products.code, manufacturers.name, products.model, products.sex, sizes.size, entries_has_products_has_sizes.quantity
    FROM entries
    INNER JOIN entries_has_products_has_sizes
      ON entries_has_products_has_sizes.entries_id=entries.id
    INNER JOIN products_has_sizes
      ON products_has_sizes.id=entries_has_products_has_sizes.products_has_sizes_id
    INNER JOIN products
      ON products.id=products_has_sizes.products_id
    INNER JOIN manufacturers
      ON manufacturers.id=products.manufacturers_id
    INNER JOIN sizes
      ON sizes.id=products_has_sizes.sizes_id
    WHERE entries.id='".$id."'";
  $sql_select_entries_prepare = $dbconnection->prepare($sql_select_entries);
  $sql_select_entries_prepare->execute();

  ?>

  <table>
    <thead>
    <tr>
      <th>Código</th>
      <th>Fabricante</th>
      <th>Modelo</th>
      <th>Sexo</th>
      <th>Tamanho</th>
      <th>Quantidade</th>
    </tr>
    </thead>
    <tbody>

<?php
  while($sql_select_entries_data = $sql_select_entries_prepare->fetch()){
    ?>
      <tr>
        <td><?php echo $sql_select_entries_data["code"]?></td>
        <td><?php echo $sql_select_entries_data["name"]?></td>
        <td><?php echo $sql_select_entries_data["model"]?></td>
        <td><?php
          $sex = array(
            0 => "Feminino",
            1 => "Masculino",
            2 => "Unissex",
          );
          echo $sex[$sql_select_entries_data["sex"]];

          ?></td>
        <td><?php echo $sql_select_entries_data["size"]?></td>
        <td><?php echo $sql_select_entries_data["quantity"]?></td>
      </tr>
    <?php
  }

?>
    </tbody>
  </table>
