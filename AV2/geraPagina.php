<?php
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    include ("dbconnect.php");

    //recebendo codigo de barras
    $cod_barras = file_get_contents("php://input");
    $query = "SELECT * FROM produtos WHERE cod_de_barras = '$cod_barras';";

    //Recebendo dados do produto do Banco de Dados
    $resultado = $link->query($query);

    if ($resultado) {
        if ($resultado->num_rows > 0) {
            while ($linha = mysqli_fetch_assoc($resultado)) {
                $id = $linha["id"];
                $produto = $linha["nome"];
                $fabricante = $linha["fabricante"];
                $descricao = $linha["descricao"];
                $tipo = $linha["tipo_produto"];
                $categoria = $linha["categoria"];
                $quantidade = $linha["quantidade"];
                $preco = $linha["preco"];
                $status = ($linha["status"] == 1) ? "Disponível" : "Indisponível";
            }
        }
    }

    //Gerando página
    $pagina = "<!DOCTYPE html>
    <html lang='pt-br'>
    <head>
    <meta charset='UTF-8'>
    <title>{$fabricante} - {$produto}</title>
    <link rel='stylesheet' href='./css/style.css'>
    <script src='./script/script.js'></script>
    </head>
    <body>
    <main>
    <div class='container'>
        <img src='../img/{$cod_barras}.jpg' alt='{$produto}'>
        <h3>Nome:</h3>
        <p>{$produto}</p>

        <h3>Fabricante:</h3>
        <p>{$fabricante}</p>

        <h3>Descrição:</h3>
        <p>{$descricao}</p>

        <h3>Preço:</h3>
        <p>R$ {$preco}</p>

        <h3>Status:</h3>
        <p>{$status}</p>
    </div>
    </main>
    <footer> Ximbolé Baiano - 2021 - Todos os direitos reservados </footer>
    </body>
    </html>";

    //Salvando página do produto
    $prod_pag = "prod-{$id}.php";    
    file_put_contents("produtos/$prod_pag", $pagina);
}