<?php
  include("dbconnect.php");

  if ( isset( $_POST["atualizar"] ) )
  {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $quantidade = $_POST['quantidade'];
    $peso = $_POST['peso'];
    $id = $_POST['id'];
    
    // $query = "UPDATE `alunos` SET `nome` = '$nome', `email` = '$email', `matricula` = '$matricula' WHERE `alunos`.`id` = $id";
    $query = "UPDATE produtos SET nome = '$nome', descricao = '$descricao', preco = '$preco', quantidade = '$quantidade', peso = '$peso' WHERE id = $id";
    $update = mysqli_query($link, $query);

    if ($update)
    {
      echo "<script>alert('Produto atualizado com sucesso!')</script>";
      header ($origin);
    }
    else
    {
      echo "Erro ao atualizar produto: " . mysqli_error($link);
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
  
  <h1>ALTERAR PRODUTO</h1>
  <?php
  
    if (isset($_GET["id_atualizar"]))
    {
      $id_query = $_GET["id_atualizar"];
      $query = mysqli_query($link, "SELECT * FROM produtos WHERE id = $id_query");
      $dados = mysqli_fetch_array($query);
     
      $nome = $dados['nome'];
      $descricao = $dados['descricao'];
      $preco = $dados['preco'];
      $quantidade = $dados['quantidade'];
      $peso = $dados['peso'];
      $id = $dados['id'];

      $origin = $_GET['origin'];
    }

  ?>
  <form action="alterar_produto.php" method="post">
    <p>ID: <input type="number" name="id" maxlength="3" value="<?php echo $id; ?>" readonly></p>
    <p>Nome: <input type="text" name="nome" maxlength="20" value="<?php echo $nome; ?>" required></p>
    <p>Descrição: <input type="text" name="descricao" maxlength="100" value="<?php echo $descricao; ?>" required></p>
    <p>Preço: <input type="number" name="preco" maxlength="10" value="<?php echo $preco; ?>" required></p>
    <p>Quantidade: <input type="number" name="quantidade" maxlength="3" value="<?php echo $quantidade; ?>" required></p>
    <p>Peso: <input type="number" name="peso" value="<?php echo $peso; ?>" required></p>
    <input type="submit" name="atualizar" value="Atualizar">
  </form>

</main>
</body>
</html>