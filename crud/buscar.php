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
  <h1>BUSCAR</h1>
  <form action="buscar.php" method="post">
    <p>Matricula: <input type="number" name="matricula" placeholder="Numero da matrícula" required></p>

    <input type="submit" value="Buscar">
  </form>
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
        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
          $matricula = $_POST["matricula"];
          if ( $matricula != "" and isset( $matricula ) )
          {
            $query = "SELECT * FROM alunos WHERE matricula = '$matricula';";
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
                      . "<td> <button class='delete'><a onclick='return confirm('Tem certeza que deseja excluir este registro?');' name='confirma' href='excluir.php?origin={$origin}&id={$linha['id']}'>EXCLUIR</a></button> </td>"
                      . "<td> <button class='alterar'><a href='alterar.php?id_atualizar={$linha['id']}'>ALTERAR</a></button> </td>"
                      ."</tr>";
              }
            }
            else
            {
              echo "<script>alert('A matrícula {$matricula} não foi encontrada!');</script>";
            }
          }
        }
      ?>
    </tbody>
  </table>
</main>
</body>
</html>