<?php 
  include ("dbconnect.php");  
  if( $_SERVER["REQUEST_METHOD"] == "POST" )
  {
    $cod_barras = file_get_contents("php://input");
    if ( $cod_barras != "" and isset( $cod_barras ) )
    {
      $query = "SELECT * FROM produtos WHERE cod_de_barras LIKE '$cod_barras';";
      $resultado = $link->query($query);
      if( $resultado->num_rows > 0 )
      {
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
          while ($linha = mysqli_fetch_assoc($resultado)) 
          {
            $status = $linha["status"] ? "Ativo" : "Inativo";
            echo "<tr class='id_{$linha["id"]}'>" .
              "<td> {$linha["cod_de_barras"]} </td>" .
              "<td> <a href='prod-id-{$linha["id"]}' target='_blank'>{$linha["nome"]}</a> </td>" .
              "<td> {$linha["categoria"]} </td>" .
              "<td> R$ {$linha["preco"]} </td>" .
              "<td> {$linha["quantidade"]} </td>" .
              "<td> {$status} </td>" .
              "<td><button class='delete' onclick='deletar({$linha["id"]});'>EXCLUIR</button></td>" .
              "<td><button class='alterar' onclick='alterar({$linha["id"]});'>ALTERAR</button></td>" .
              "</tr>";
          }
          echo "</tbody>" . "</table>";
      } 
      else 
      {
        echo "<p>Não foram encontrados nenhum registro!</p>";
      }
    }
  }