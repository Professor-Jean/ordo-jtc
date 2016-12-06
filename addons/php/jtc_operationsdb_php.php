
<?php
/**
*Funcionalidade: este aquivo possui funções que criam a sintaxe SQL automaticamente.
*/

function adicionar($adc_tabela, $adc_dados){// Essa função prepara e executa o camando de inserção de dados no banco
  $adc_campos = array_keys($adc_dados);
  $adc_n_campos = count($adc_dados);

  $adc_sintaxe = "INSERT INTO ".$adc_tabela." (";

  for ($adc_aux=0; $adc_aux < $adc_n_campos; $adc_aux++) {
    $adc_sintaxe .= $adc_campos[$adc_aux].", ";
  }

  $adc_sintaxe = substr($adc_sintaxe, 0,-2);
  $adc_sintaxe .= ") VALUES (";

  for ($adc_aux=0; $adc_aux < $adc_n_campos; $adc_aux++) {
    if($adc_dados[$adc_campos[$adc_aux]]!=""){
      $adc_sintaxe .= "'".addslashes($adc_dados[$adc_campos[$adc_aux]])."', ";
    }else{
      $adc_sintaxe.= "NULL, ";
    }
  }
  $adc_sintaxe = substr($adc_sintaxe, 0,-2);
  $adc_sintaxe .= ")";
  global $dbconnection;
  $adc_preparado = $dbconnection->prepare($adc_sintaxe);
  $adc_resultado = $adc_preparado->execute();
  echo $adc_sintaxe;
  return $adc_resultado;
}

function alterar($alt_tabela, $alt_dados, $alt_condicao){

  $alt_campos = array_keys($alt_dados);
  $alt_n_campos = count($alt_dados);

  $alt_sintaxe = "UPDATE ".$alt_tabela." SET ";

  for ($alt_aux=0; $alt_aux<$alt_n_campos ; $alt_aux++){
    if($alt_dados[$alt_campos[$alt_aux]]!=""){
      $alt_sintaxe .= $alt_campos[$alt_aux]."='".addslashes($alt_dados[$alt_campos[$alt_aux]])."', ";
    }else{
      $alt_sintaxe .= $alt_campos[$alt_aux]."=NULL, ";
    }
  }
  $alt_sintaxe = substr($alt_sintaxe, 0, -2);
  $alt_sintaxe .= " WHERE ".$alt_condicao;

  global $dbconnection;
  $alt_preparado = $dbconnection->prepare($alt_sintaxe);
  $alt_resultado = $alt_preparado->execute();
  echo $alt_sintaxe;
  return $alt_resultado;
}

function deletar($del_tabela, $del_condicao){// deleta uma linha crinado a sintaxe AQL
  $del_sintaxe = "DELETE FROM ".$del_tabela." WHERE ".$del_condicao;

  global $dbconnection;
  $del_preparado = $dbconnection->prepare($del_sintaxe);
  $del_resultado = $del_preparado->execute();

  return $del_resultado;
}
 ?>
