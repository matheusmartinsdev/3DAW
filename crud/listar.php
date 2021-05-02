<?php include("bdconnect.php"); ?>

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
  <h1>LISTAR ALUNOS</h1>
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>E-mail</th>
        <th>Matrícula</th>
      </tr>
    </thead>

    <tbody>
      <?php 
        $query = "SELECT * FROM alunos;";
        $busca = mysqli_query($link, $query);
        $resultado = $link->query($query);
        $origin = $_SERVER["PHP_SELF"];
        if( $resultado->num_rows > 0 )
        {
          while ($linha = mysqli_fetch_assoc($resultado))
          {
            echo  "<tr>"
                  . "<td> {$linha['id']} </td>"
                  . "<td> {$linha['nome']} </td>"
                  . "<td> {$linha['email']} </td>"
                  . "<td> {$linha['matricula']} </td>"
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