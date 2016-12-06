<?php
  /**
  *Funcionalidade: Página para a inserção e a verrificação dos registros dos produtos.
  *Data de criação: 18/10/2016
  */
  $code = $_POST["codigo"];
  $model = $_POST["modelo"];
  $categories = $_POST["categoria"];
  $sex = $_POST["sexo"];
  $manufacturers = $_POST["fabricante"];
  $price = $_POST["preco"];

  if($code==""){
    $msgid = 5;
    $data = "código";
  }else if($model==""){
    $msgid = 5;
    $data = "modelo";
  }else if($categories==""){
    $msgid = 5;
    $data = "categorias";
  }else if($sex==""){
    $msgid = 5;
    $data = "sexo";
  }else if($manufacturers==""){
    $msgid = 5;
    $data = "fabricante";
  }else if($price==""){
    $msgid = 5;
    $data = "preço";
  }else if(!validate_number($code)){
    $msgid = 4;
    $data = "código";
  }else if(!validate_price($price)){
    $msgid = 4;
    $data = "preço";
  }else{
    $sql_sel_product = "SELECT * FROM products WHERE code = '".$code."'";
    $sql_sel_product_prepare = $dbconnection->prepare($sql_sel_product);
    $sql_sel_product_prepare->execute();

    if($sql_sel_product_prepare->rowCount()=='0'){
      $data=array(
        'code' => $code,
        'model' => $model,
        'categories_id' => $categories,
        'sex' => $sex,
        'manufacturers_id' => $manufacturers,
        'price' => $price
      );
      $result = adicionar("products", $data);
      if($result){
        $msgid = 1;
        $data = "produto";
      }else{
        $msgid = 2;
        $data = "produto";
      }
    }else{
      $msgid = 7;
      $data = "Produto";
    }
  }
  header("Location:?folder=product/&file=jtc_fminsupd_product&ext=php&msgid=".$msgid."&data=".$data);
?>
