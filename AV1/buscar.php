<?php include("dbconnect.php"); ?>

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
  <h1>BUSCAR</h1>
  <form action="buscar.php" method="post">
    <p>Nome: <input type="text" name="nome" placeholder="Nome do cliente" required></p>

    <input type="submit" value="Buscar">
  </form>
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>CPF</th>
        <th>Endereço</th>
        <th>Cidade</th>
        <th>Estado</th>
      </tr>
    </thead>

    <tbody>
      <?php 
        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
          $nome = $_POST["nome"];
          if ( $nome != "" and isset( $nome ) )
          {
            $query = "SELECT * FROM clientes WHERE nome LIKE '%$nome%';";

            $busca = mysqli_query($link, $query);
            $resultado = $link->query($query);
            $origin = basename(__FILE__);
            if( $resultado->num_rows > 0 )
            {
              while ($linha = mysqli_fetch_assoc($resultado))
              {
                echo  "<tr>"
                  . "<td> {$linha['id']} </td>"
                  . "<td> {$linha['nome']} </td>"
                  . "<td> {$linha['cpf']} </td>"
                  . "<td> {$linha['endereco']} </td>"
                  . "<td> {$linha['cidade']} </td>"
                  . "<td> {$linha['estado']} </td>"
                  . "<td><button class='delete'><a href='excluir.php?origin={$origin}&id={$linha['id']}'>EXCLUIR</a></button></td>"
                  . "<td><button class='alterar'><a href='alterar.php?id_atualizar={$linha['id']}'>ALTERAR</a></button></td>"
                  ."</tr>";
              }
            }
            else
            {
              echo "<script>alert('O nome {$nome} não foi encontrado!');</script>";
            }
          }
        }
      ?>
    </tbody>
  </table>
</main>
</body>
</html>