<?php
  include("dbconnect.php");

  if ( isset( $_POST["atualizar"] ) )
  {
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $endereco = $_POST['endereco'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $id = $_POST['id'];
    
    // $query = "UPDATE `alunos` SET `nome` = '$nome', `email` = '$email', `matricula` = '$matricula' WHERE `alunos`.`id` = $id";
    $query = "UPDATE clientes SET nome = '$nome', cpf = '$cpf', endereco = '$endereco', cidade = '$cidade', estado = '$estado' WHERE id = $id";
    $update = mysqli_query($link, $query);

    if ($update)
    {
      echo "<script>alert('Cadastro atualizado com sucesso!')</script>";
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
  <title>Alterar Cliente</title>
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
  
  <h1>ALTERAR</h1>
  <?php
  
    if (isset($_GET["id_atualizar"]))
    {
      $id_query = $_GET["id_atualizar"];
      $query = mysqli_query($link, "SELECT * FROM clientes WHERE id = $id_query");
      $dados = mysqli_fetch_array($query);
     
      $nome = $dados['nome'];
      $cpf = $dados['cpf'];
      $endereco = $dados['endereco'];
      $cidade = $dados['cidade'];
      $estado = $dados['estado'];
      $id = $dados['id'];
    }

  ?>
  <form action="alterar.php" method="post">
    <p>ID: <input type="number" name="id" maxlength="3" value="<?php echo $id; ?>" readonly></p>
    <p>Nome: <input type="text" name="nome" maxlength="40" value="<?php echo $nome; ?>" required></p>
    <p>CPF: <input type="text" name="cpf" maxlength="11" value="<?php echo $cpf; ?>" required></p>
    <p>Endereço: <input type="text" name="endereco" maxlength="70" value="<?php echo $endereco; ?>" required></p>
    <p>Cidade: <input type="text" name="cidade" maxlength="30" value="<?php echo $cidade; ?>" required></p>
    <p>Estado: <input type="text" name="estado" maxlength="2" value="<?php echo $estado; ?>" required></p>
    <input type="submit" name="atualizar" value="Atualizar">
  </form>

</main>
</body>
</html>