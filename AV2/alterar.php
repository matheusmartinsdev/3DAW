<?php
  include("dbconnect.php");

  if ( $_SERVER["REQUEST_METHOD"] == "PUT" ) {
    $data = json_decode(file_get_contents("php://input"));

    if (validar ($data)) {
      $id = $data->{'id'};
      $cod_barras = $data->{'cod_barras'};
      $nome = $data->{'nome'};
      $fabricante = $data->{'fabricante'};
      $categoria = $data->{'categoria'};
      $tipo_produto = $data->{'tipo_prod'};
      $preco = $data->{'preco'};
      $quantidade = $data->{'quant'};
      $peso = $data->{'peso'};
      $descricao = $data->{'descricao'};
      $data_inclusao = $data->{'data'};
      $status = $data->{'status'};
    } else {
      http_response_code(400);
    }

    $query = "UPDATE produtos SET cod_de_barras = '$cod_barras', nome = '$nome', fabricante = '$fabricante', categoria = '$categoria', tipo_produto = '$tipo_produto', preco = '$preco', quantidade = '$quantidade', peso = '$peso', descricao = '$descricao', data_inclusao = '$data_inclusao' WHERE id = '$id'";

    if (mysqli_query($link, $query)) {
      http_response_code(200);
    } else {
      http_response_code(500);
    }
  } else {
      if ( $_SERVER["REQUEST_METHOD"] == "POST" ) {
        $id = file_get_contents("php://input");

        $query = "SELECT * FROM produtos WHERE id = '$id';";
        
        $resultado = $link->query($query);
                
        if ($resultado->num_rows > 0) {
          while ($linha = mysqli_fetch_assoc($resultado)) {
            echo "<form id='form'>
            <p>Imagem:<br><input type='file' name='inpFile'><br>
            <p>Código de Barras: <input type='text' name='cod_barras' value='{$linha["cod_de_barras"]}' placeholder='7829238208123' maxlength='13' minlength='12'></p>
            <p>Produto: <input type='text' name='nome' value='{$linha["nome"]}' placeholder='Galaxy S20+' maxlength='60' ></p>
            <p>Fabricante: <input type='text' name='fabricante' value='{$linha["fabricante"]}' placeholder='Samsung' maxlength='20'></p>
            <p>Categoria:<select name='categoria'><option value='op1'>Opcao</option></select></p>
            <p>Tipo de produto:<select name='tipo_prod'><option value='op1'>Opcao</option></select></p>
            <p>Preço: <input type='number' value='{$linha["preco"]}' name='preco' placeholder='9.999,99'></p>
            <p>Quantidade: <input type='number' name='quant' value='{$linha["preco"]}' placeholder='10'></p>
            <p>Peso (g): <input type='number' name='peso' value='{$linha["peso"]}' placeholder='1000'></p>
            <p>Descrição: <textarea name='descricao' value='{$linha["descricao"]}' rows='4' cols='50' maxlength='700' style='resize: none;'></textarea></p>
            <p>Status: <input type='checkbox' name='status'><label for='status'>Ativo/Inativo</label></p>
            <button type='button' id='submit' onclick='upload(); enviaAlteracao({$linha["id"]});'>Alterar</button>
            </form>";
          }
        }
      }
    }
?>