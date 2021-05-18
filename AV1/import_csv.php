<?php

function importToDB ($f)
{
  include("dbconnect.php"); 
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
    $descricao = $registro['descricao'].PHP_EOL;
    $preco = $registro['preco'].PHP_EOL;
    $quantidade = $registro['quantidade'].PHP_EOL;
    $peso = $registro['peso'].PHP_EOL;

    $query =  "INSERT INTO produtos (nome, descricao, preco, quantidade, peso) VALUES ('$nome', '$descricao', '$preco', '$quantidade', '$peso')";

    if( 
      ( $nome != "" && $nome != PHP_EOL && isset($nome) ) &&
      ( $descricao != "" && $descricao != PHP_EOL && isset($descricao) ) &&
      ( $preco != "" && $preco != PHP_EOL && isset($preco) ) &&
      ( $quantidade != "" && $quantidade != PHP_EOL && isset($quantidade) ) &&
      ( $peso != "" && $peso != PHP_EOL && isset($peso) )
      )
    {
      if(mysqli_query($link, $query))
      {
        echo "$nome inserido com sucesso <br>";
      }
      else
      {
        echo "Falha na inserção dos dados do CSV. Erro: ".mysqli_error($link);
      }
    }
    else
    {
      echo "Dados presentes no CSV são inválidos! Favor verificar o arquivo<br>";
    }
  }
  //Fechando arquivo
  fclose($f);
}
  
?>