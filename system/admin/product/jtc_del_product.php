<?php
/**
*Funcionalidade: este arquivo deleta um produto
*Data de criação: 24/10/2016
*/
  $id = $_GET["delid"];
  $sql_select_products_has_sizes = "SELECT * FROM products_has_sizes WHERE products_id=".$id;
  $sql_select_products_has_sizes_prepare = $dbconnection->prepare($sql_select_products_has_sizes);
  $sql_select_products_has_sizes_prepare->execute();
  if($sql_select_products_has_sizes_prepare->rowCount()==0){
    $result = deletar("products", "id=".$id);
    if($result){
      $msgid = 11;
      $data  = "Produto";
    }else{
      $msgid = 10;
      $data = "produto";
    }
  }else{
    $msgid = 40;
  }

header("Location: ?folder=product/&file=jtc_fminsupd_product&ext=php&msgid=".$msgid."&data=".$data);

?>
