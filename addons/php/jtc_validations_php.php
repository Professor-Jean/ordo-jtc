<?php
/**
*Duncionalidade: este aquivo possui funções que validam campos
*Data de criação: 10/10/2016
*/

// Raliza a validação de nomes próprios
// Ex.: João M. da Silva (correto); João d@ 5!lv@ (errado).
function validate_name($name){
  return preg_match("/^[a-zA-ZáéíóúàâêôãõüçÁÉÍÓÚÀÂÊÔÃÕÜÇ. ]{1,}$/", trim($name));
}

// Raliza a validação de nomes de usuários
// Ex.: João_Silva (correto); João d@ 5!lv@ (errado).
function validate_username($username){
  return preg_match("/^[a-zA-Z_]/", $username);
}

// Raliza a validação de números inteiros
// Ex.: 10982789 (correto); 123.123.234,09 (errado).
function validate_number($number){
  return preg_match("/^[0-9]{1,}/", $number);
}

// Raliza a validação de preços
// Ex.: 10,34 (correto), 10,10d,10 (errado).
function validate_price($price){
  return preg_match("/^\\$?\\d+(.\\d{3})*(\\,\\d*)?$/", $price);
}

// Raliza a validação de data
// Ex.: 12/12/19990 (correto); 10/40/0000 (errado).
function validate_date($date){
  return preg_match("/^\d{1,2}\/\d{1,2}\/\d{4}$/", $date);
}

// Raliza a validação de hora
// Ex.: 12:56 (correto); 12;70 (errado).
function validate_hour($hour){
  return preg_match("/^(2[0-3]|[01][0-9]):[0-5][0-9]$/", $hour);
}

// Raliza de siglas
// Ex.: pr (correto); áÇ (errado).
function validate_initials($initials){
  return preg_match("/^[a-zA-Z]{2}/", $initials);
}
