<?php
/*
*Funcionalidade: este arquivo cria conexão com banco de dados.
*Data de criação: 11/10/2016
*/
//dados
$server = "localhost";
$username = "root";
$password = "root";
$database = "jtc_database";

//salt segurança
$salt = "0112358";

try{
  $dbconnection = new PDO("mysql:host=".$server.";dbname=".$database.";charset=utf8", $username, $password);
}catch (PDOException $e){
  die ("Erro ao se conectar com o banco de dados: ".$e->getMessage());
}
