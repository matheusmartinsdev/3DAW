<?php 
  include("dbconnect.php");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Atividade 3DAW - CRUD</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<main>
  <div class="botoes">
    <button><a href="incluir.php">Incluir Cliente</a></button>
    <button><a href="listar.php">Listar Clientes</a></button>
    <button><a href="buscar.php">Buscar Cliente</a></button>
    <button><a href="produtos.php">Produtos</a></button>
  </div>
  
  <h1>INCLUIR</h1>
  
  <form action="incluir.php" method="post">
    <p>Nome: <input type="text" name="nome" placeholder="Ex.: Fulano da Silva de Oliveira" maxlength="40" required></p>
    <p>CPF: <input type="text" name="cpf" placeholder="Ex.: 12345678910" maxlength="11" required></p>
    <p>Endereço: <input type="text" name="endereco" placeholder="Ex.: Rua dos Coqueiros, 20, 302" maxlength="70" required></p>
    <p>Cidade: <input type="text" name="cidade" placeholder="Ex.: Rio de Janeiro" maxlength="30" required></p>
    <p>Estado: <input type="text" name="estado" placeholder="Ex.: RJ" maxlength="2" required></p>
    <input type="submit" value="Enviar">
  </form>

  <?php
    if ($_SERVER["REQUEST_METHOD"]=="POST")
    {
      $nome = $_POST["nome"];
      $cpf = $_POST["cpf"];
      $endereco = $_POST["endereco"];
      $cidade = $_POST["cidade"];
      $estado = $_POST["estado"];

      if( 
          $nome != "" and isset( $nome ) && 
          $cpf != "" and isset( $cpf ) &&
          $endereco != "" and isset( $endereco ) &&
          $cidade != "" and isset( $cidade ) &&
          $estado != "" and isset( $estado )
        )
      {
        $query = "INSERT INTO clientes (nome, cpf, endereco, cidade, estado) VALUES ('$nome', '$cpf', '$endereco', '$cidade', '$estado');";

        if (mysqli_query($link, $query))
        {
          echo "<script>alert('{$nome} inserido com sucesso!');</script>";
        }
        else
        {
          echo "<script>alert('Desculpe, mas tivemos um erro interno no servidor!');</script>";
        }
      }
      else
      {
        echo "<script>alert('Erro ao cadastrar, verifique os campos!');</script>";
      }
    }
  ?>

</main>
</body>
</html>