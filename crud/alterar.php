<?php
  include("bdconnect.php");

  if ( isset( $_POST["atualizar"] ) )
  {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $matricula = $_POST["matricula"];
    $id = $_POST["id"];
    
    $query = mysqli_query($link, "UPDATE `alunos` SET `nome` = '$nome', `email` = '$email', `matricula` = '$matricula' WHERE `alunos`.`id` = $id");

    if ($query)
    {
      echo "<script>alert('Cadastro atualizado com sucesso!')</script>";
      // header("location: index.php");
    }
    else
    {
      echo mysqli_error($link);
    }
  }
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
  
  <h1>ALTERAR</h1>
  <?php
  
    if (isset($_GET["id_atualizar"]))
    {
      $id_query = $_GET["id_atualizar"];
      $query = mysqli_query($link, "SELECT * FROM alunos WHERE id = $id_query");
      $dados = mysqli_fetch_array($query);
      $nome = $dados['nome'];
      $email = $dados['email'];
      $matricula = $dados['matricula'];
      $id = $dados['id'];
    }

  ?>
  <form action="alterar.php" method="post">
    <!-- <p>ID: <input type="number" name="idd" value="" required></p> -->
    <p>Nome: <input type="text" name="nome" value="<?php echo $nome; ?>" required></p>
    <p>E-mail: <input type="email" name="email" value="<?php echo $email; ?>" required></p>
    <p>Matricula: <input type="number" name="matricula" value="<?php echo $matricula; ?>" required></p>
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <input type="submit" name="atualizar" value="Atualizar">
  </form>

</main>
</body>
</html>