<?php
  /**
  *Funcionalidade: este arquivo possui funcionalidades de apoio
  *Data de criação: 27/10/2016
  */

  function date_converter($date, $caractere){//transforma o formato de data do BD em formato brasileiro
    $date_array = explode($caractere, $date);
    return $date_final = $date_array[2]."/".$date_array[1]."/".$date_array[0];
  }