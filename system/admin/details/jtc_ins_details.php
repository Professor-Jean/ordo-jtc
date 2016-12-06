<?php
/**
*Funcionalidade: Página para a inserção e a verrificação de tamanho e categoria
*Data de criação: 28/10/2016
*/
if(isset($_POST['form_tamanho'])) {
    $size = $_POST["tamanho"];

    if($size == ""){
        $msgid = 5;
        $data = "tamanho";
    }else{
        $sql_sel_size = "SELECT * FROM sizes WHERE id = '".$id."'";
        $sql_sel_size_prepare = $dbconnection->prepare($sql_sel_size);
        $sql_sel_size_prepare->execute();

        if ($sql_sel_size_prepare->rowCount() == '0') {
            $data = array(
                'size' => $size
            );
            $result = adicionar("sizes", $data);
            if ($result){
                $msgid = 1;
                $data = "tamanho";
            }else {
                $msgid = 2;
                $data = "tamanho";
            }
        }else{
            $msgid = 7;
            $data = "Produto";
            }
        }

    header("Location:?folder=details/&file=jtc_fminsupd_details&ext=php&msgid_size=" . $msgid . "&data=" . $data);
}else if(isset($_POST['form_categoria'])){
    $category = $_POST["categoria"];

    if($category == ""){
        $msgid = 5;
        $data = "categoria";
    }else{
        $sql_sel_category = "SELECT * FROM categories WHERE id = '" . $id . "'";
        $sql_sel_category_prepare = $dbconnection->prepare($sql_sel_category);
        $sql_sel_category_prepare->execute();

        if ($sql_sel_category_prepare->rowCount() == '0') {
            $data = array(
                'category' => $category
            );
            $result = adicionar("categories", $data);
            if ($result) {
                $msgid = 1;
                $data = "categoria";
            } else {
                $msgid = 2;
                $data = "categoria";
            }
        }else{
            $msgid = 7;
            $data = "Categoria";
            }
        }
    header("Location:?folder=details/&file=jtc_fminsupd_details&ext=php&msgid_category=" . $msgid . "&data=" . $data);
}else{
  echo "Formulário de cadastro não encontrado!";
}
?>
