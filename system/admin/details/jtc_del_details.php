<?php
/**
*Funcionalidade: este arquivo deleta uma categoria ou tamanho(detalhes do produto).
*Data de criação: 28/10/2016
*/
if(isset($_GET["delid_size"])){

  $id = $_GET["delid_size"];
  $sql_select_products_has_sizes = "SELECT * FROM products_has_sizes WHERE sizes_id=".$id;
  $sql_select_products_has_sizes_prepare = $dbconnection->prepare($sql_select_products_has_sizes);
  $sql_select_products_has_sizes_prepare->execute();
  if($sql_select_products_has_sizes_prepare->rowCount()==0){
    $result = deletar("sizes", "id=" . $id);
    if ($result) {
      $msgid = 11;
      $data = "Tamanho";
    } else {
      $msgid = 10;
      $data = "tamanho";
    }
  }else{
    $msgid = 41;
  }

  header("Location: ?folder=details/&file=jtc_fminsupd_details&ext=php&msgid_size=".$msgid."&data=".$data);

}elseif($_GET["delid_category"]){

  $id = $_GET["delid_category"];
  $sql_select_products = "SELECT * FROM products WHERE categories_id=".$id;
  $sql_select_products_prepare = $dbconnection->prepare($sql_select_products);
  $sql_select_products_prepare->execute();
  if($sql_select_products_prepare->rowCount()==0){
    $result = deletar("categories", "id=" . $id);
    if ($result) {
      $msgid = 11;
      $data = "Categoria";
    } else {
      $msgid = 10;
      $data = "categoria";
    }
  }else{
    $msgid = 41;
  }
  header("Location: ?folder=details/&file=jtc_fminsupd_details&ext=php&msgid_category=".$msgid."&data=".$data);

}


?>
