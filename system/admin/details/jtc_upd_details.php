<?php
/**
 *Funcionalidade: Página para os registros e alterações de categorias e tamanhos.
 *Data de criação: 29/10/2016
 */

 if(isset($_POST['alt_tamanho'])){
  $id = $_POST["id"];
  $size = $_POST["tamanho"];

  if($size == ""){
    $msgid = 5;
    $data = "tamanho";
  }else{
      $sql_sel_size = "SELECT * FROM sizes WHERE size='".$size."' AND id<>'".$id."'";
      $sql_sel_size_prepare = $dbconnection->prepare($sql_sel_size);
      $sql_sel_size_prepare->execute();
      if($sql_sel_size_prepare->rowCount()==0){
        $data = array(
          'size' => $size
        );
        $result = alterar("sizes", $data, "id=".$id);

        if($result){
          $msgid = 14;
          $data = "Tamanho";
          header("Location: ?folder=details/&file=jtc_fminsupd_details&ext=php&msgid_size=".$msgid."&data=".$data);
          die();
        }else{
          $msgid = 13;
          $data = "tamanho";
        }
     }else{
       $msgid = 15;
      }
    }
  header("Location: ?folder=details/&file=jtc_fminsupd_details&ext=php&updid_tamanho=".$id."&msgid_size=".$msgid."&data=".$data);

 }else if(isset($_POST['alt_categoria'])){
   $id = $_POST["id"];
   $category = $_POST["categoria"];

   if($category == ""){
     $msgid = 5;
     $data = "categoria";
   }else{
       $sql_sel_category = "SELECT * FROM categories WHERE category='".$category."' AND id<>'".$id."'";
       $sql_sel_category_prepare = $dbconnection->prepare($sql_sel_category);
       $sql_sel_category_prepare->execute();
       if($sql_sel_category_prepare->rowCount()==0){
         $data = array(
           'category' => $category
         );
         $result = alterar("categories", $data, "id=".$id);

         if($result){
           $msgid = 14;
           $data = "Categoria";
           header("Location: ?folder=details/&file=jtc_fminsupd_details&ext=php&msgid_category=".$msgid."&data=".$data);
           die();
         }else{
           $msgid = 13;
           $data = "categoria";
         }
      }else{
        $msgid = 15;
       }
     }
   header("Location: ?folder=details/&file=jtc_fminsupd_details&ext=php&updid_categoria=".$id."&msgid_category=".$msgid."&data=".$data);



   }else{
     echo "Formulário de cadastro não encontrado!";
   }
?>
