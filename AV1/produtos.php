<?php
include("import_csv.php");
include("dbconnect.php");

$uploadOk = 0;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $fileDirectory = ".\uploads";
  $fileName = $fileDirectory . '\\' . basename($_FILES["nomeArquivo"]["name"]);
  echo $fileName;
  $csvFileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
  //echo "<br>$csvFileType";
  if (isset($_POST["submit"])) {
      if (file_exists($fileName)) {
          echo "<br><br>Arquivo " . $_FILES["nomeArquivo"]["name"] . " Já existe. ";
      }
      elseif ($csvFileType != "csv") {
          echo "<br><br>Extensão " . $csvFileType . " do arquivo " . $_FILES["nomeArquivo"]["name"] . " não é permitida. ";
      } else {
          if (move_uploaded_file($_FILES["nomeArquivo"]["tmp_name"], $fileName)) {
            echo "<br><br>Gravado em: " . $fileName . "<br />";
            $uploadOk = 1;
          }
          else
          {
            echo "Erro ao mover arquivo";
          }
      }
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
    <button><a href="incluir.php">Incluir Cliente</a></button>
    <button><a href="listar.php">Listar Clientes</a></button>
    <button><a href="buscar.php">Buscar Cliente</a></button>
    <button><a href="produtos.php">Produtos</a></button>
  </div>

<form action="produtos.php" method="POST" enctype="multipart/form-data">
    Escolha o arquivo:
    <br>
    Arquivo: <input type="file" name="nomeArquivo">
    <br><br>
    <input type="submit" value="enviar" name="submit">
</form>

  <h1>LISTA DE PRODUTOS</h1>
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Descrição</th>
        <th>Preço</th>
        <th>Quantidade</th>
        <th>Peso (g)</th>
      </tr>
    </thead>

    <tbody>
      <?php 
        if ($uploadOk == 1)
        {
          // Abrir arquivo para leitura
          $f = fopen($fileName , 'r') or die ("Erro ao abrir arquivo!");
          importToDB($f);
        } 
          $query = "SELECT * FROM produtos;";
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
                    . "<td> {$linha['descricao']} </td>"
                    . "<td> {$linha['preco']} </td>"
                    . "<td> {$linha['quantidade']} </td>"
                    . "<td> {$linha['peso']} </td>"
                    . "<td><button class='delete'><a href='excluir.php?origin={$origin}&id={$linha['id']}'>EXCLUIR</a></button></td>"
                    . "<td><button class='alterar'><a href='alterar_produto.php?origin={$origin}&id_atualizar={$linha['id']}'>ALTERAR</a></button></td>"
                    ."</tr>";
            }
          }
      ?>
    </tbody>
  </table>
</main>
</body>
</html>