<?php
  include("bdconnect.php");

  // Abrir arquivo para leitura
  $f = fopen('alunos.csv', 'r') or die ("Erro ao abrir arquivo!");

  // Lendo cabeçalho do arquivo
  $cabecalho = fgetcsv($f, 0, ";");

  // Enquanto nao terminar o arquivo
  while (!feof($f)) 
  {
    // Ler uma linha do arquivo
    $linha = fgetcsv($f, 0, ";");

    //Combinando campo com valor em um array
    $registro = array_combine($cabecalho, $linha);

    //Gravando no Banco de Dados
    $nome = $registro['nome'].PHP_EOL; 
    $email = $registro['email'].PHP_EOL;
    $matricula = $registro['matricula'].PHP_EOL;

    $query =  "INSERT INTO alunos (nome, email, matricula) VALUES ('$nome', '$email', '$matricula')";

    if( 
      ( $nome != "" && $nome != PHP_EOL && isset($nome) ) &&
      ( $email != "" && $email != PHP_EOL && isset($email) ) &&
      ( $matricula != "" && $matricula != PHP_EOL && isset($matricula) ) 
      )
    {
      if(mysqli_query($link, $query))
      {
        echo "$nome inserido com sucesso <br>";
      }
      else
      {
        echo "Falha na inserção dos dados do CSV";
      }
    }
    else
    {
      echo "Dados presentes no CSV são inválidos! Favor verificar o arquivo<br>";
    }
  }
  //Fechando arquivo
  fclose($f);
?>