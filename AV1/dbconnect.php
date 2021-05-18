<?php

#Variáveis para conexão com o Banco de Dados
  $user = "root"; 
  $passwordDB = "";  
  $hostname = "localhost"; 
  $database = "av1";

  #Conectando ao mysql
  $link = mysqli_connect($hostname, $user, $passwordDB, $database) or die( ' Erro na conexão ' );
?>