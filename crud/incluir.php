<?php 
  include("bdconnect.php");
  $nomeValido = 0;
  $emailValido = 0;
  $matriculaValido = 0;
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
    <button><a href="incluir.php">Incluir Aluno</a></button>
    <button><a href="listar.php">Listar Alunos</a></button>
    <button><a href="buscar.php">Buscar Aluno</a></button>
  </div>
  
  <h1>INCLUIR</h1>
  
  <form action="incluir.php" method="post">
    <p>Nome: <input type="text" name="nome" placeholder="Nome completo" required></p>
    <p>E-mail: <input type="email" name="email" placeholder="E-mail" required></p>
    <p>Matricula: <input type="number" name="matricula" placeholder="Numero da matrícula" required></p>

    <input type="submit" value="Enviar">
  </form>

  <?php
    if ($_SERVER["REQUEST_METHOD"]=="POST")
    {
      $nome = $_POST["nome"];
      $email = $_POST["email"];
      $matricula = $_POST["matricula"];

      if ( $nome != "" and isset( $nome ) )
      {
        $nomeValido = 1;
      }
      
      if ( $email != "" and isset( $email ) )
      {
        $emailValido = 1;
      }

      if ( $matricula != "" and isset( $matricula ) )
      {
        $matriculaValido = 1;
      }

      if ( $nomeValido && $emailValido && $matriculaValido )
      {
        $query = "INSERT INTO alunos (nome, email, matricula) VALUES ('$nome', '$email', '$matricula');";

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