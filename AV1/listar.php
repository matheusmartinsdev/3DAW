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
  <h1>LISTAR ALUNOS</h1>
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
        $query = "SELECT * FROM clientes;";
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
      ?>
    </tbody>
  </table>
</main>
</body>
</html>