<?php
include "dbconnect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $data = json_decode(file_get_contents("php://input"));
  
  if (validar($data)) {
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
    return http_response_code(400);
  }
  
    $query = "INSERT INTO produtos (cod_de_barras, nome, fabricante, categoria, tipo_produto, preco, quantidade, peso, descricao, data_inclusao, status) VALUES ('$cod_barras', '$nome', '$fabricante', '$categoria', '$tipo_produto', '$preco', '$quantidade', '$peso', '$descricao', '$data_inclusao', '$status');";

    if (mysqli_query($link, $query)) {
      return http_response_code(201); //Status: Created
    } else {
      return http_response_code(304); //Status: Not Modified
    }
}
