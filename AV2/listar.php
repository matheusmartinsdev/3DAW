<?php
include "dbconnect.php";
if ($_SERVER["REQUEST_METHOD"] == "GET") 
{
  $query = "SELECT * FROM produtos;";
  $resultado = $link->query($query);

  if ($resultado->num_rows > 0) {
    echo "<table>
            <thead>
              <tr>
                <th>Cód. Barras</th>
                <th>Nome</th>
                <th>Preço</th>
                <th>Qtd. Estoque</th>
                <th>Status</th>
              </tr>
            </thead>" . "<tbody>";
    while ($linha = mysqli_fetch_assoc($resultado)) {
      $status = $linha["status"] ? "Ativo" : "Inativo";
      echo "<tr class='id_{$linha["id"]}'>" .
        "<td class='cod_barras'> {$linha["cod_de_barras"]} </td>" .
        "<td class='nome'> <a href='produtos/prod-{$linha["id"]}.php' target='_blank'>{$linha["nome"]}</a> </td>" .
        "<td> R$ {$linha["preco"]} </td>" .
        "<td> {$linha["quantidade"]} </td>" .
        "<td> {$status} </td>" .
        "<td><button class='delete' onclick='deletar({$linha["id"]});'>EXCLUIR</button></td>" .
        "<td><button class='alterar' onclick='alterar({$linha["id"]});'>ALTERAR</button></td>" .
        "</tr>";
    }
    echo "</tbody>" . "</table>";
  } else {
    echo "<p>Não foram encontrados registros!</p>";
  }
}
?>
