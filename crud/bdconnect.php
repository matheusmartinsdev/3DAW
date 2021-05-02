<?php

#Variáveis para conexão com o Banco de Dados
  $user = "root"; 
  $passwordDB = "";  
  $hostname = "localhost"; 
  $database = "3daw";

  #Conectando ao mysql
  $link = mysqli_connect($hostname, $user, $passwordDB, $database) or die( ' Erro na conexão ' );

  
?>