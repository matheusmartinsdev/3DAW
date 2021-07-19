<?php
function validar ($arr) {
  if ($arr)
  {
    return true;
  }
  else
  {
    return false;
  }
}

#Variáveis para conexão com o Banco de Dados
$user = "root";
$passwordDB = "";
$hostname = "localhost";
$database = "av2";

#Conectando ao mysql
($link = new mysqli($hostname, $user, $passwordDB, $database)) or
  die(" Erro na conexão ");
?>
