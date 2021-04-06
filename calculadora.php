<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <title>Calculadora</title>
  </head>
  <body>

    <h2>Calculadora</h2>
    <form method="GET" action="calculadora.php">
      A: <input type="number" name="a" />
      <br />
      B: <input type="number" name="b" />
      <br />
      <h3>Operação:</h3>
      Soma <input type="checkbox" name="op" value="soma" />
      <br />
      Subtração <input type="checkbox" name="op" value="subtracao" />
      <br />
      Multiplicação <input type="checkbox" name="op" value="multiplicacao" />
      <br />
      Divisão <input type="checkbox" name="op" value="divisao" />
      <br />
      <br />
      <input type="submit" value="Enviar" />
      <br />
      <br />
    </form>

<?php 
//Funções da calculadora
function soma ($a, $b)
{
  return $a+$b;
}

function subtrair ($a, $b)
{
  return $a-$b;
}

function multiplicar ($a, $b)
{
  return $a*$b;
}

function dividir ($a, $b)
{
  return $a/$b;
}


  //Verificando se os campos estão vazios
  if ( ( !isset ( $_GET["a"] ) || !is_numeric ( $_GET["a"] ) ) || ( !isset ( $_GET["b"] ) || !is_numeric ( $_GET["b"] ) ) || !isset ( $_GET["op"] ) )
  {
    echo "Algum campo está vazio!";
  } 
  else
  {
    //Recebendo variáveis
    $a = $_GET["a"];
    $b = $_GET["b"];
    $operacao = $_GET["op"];

    //Se os campos não estão vazios, começam as operações
    if ($operacao === "soma") 
    {
      echo "{$a} + {$b} = ".soma($a, $b);
    }
    elseif ($operacao === "subtracao")
    {
      echo "{$a} - {$b} = ".subtrair($a, $b);
    }
    elseif ($operacao === "multiplicacao")
    {
      echo "{$a} * {$b} = ".multiplicar($a, $b);
    }
    else //A última operação só pode ser divisão
    {
      echo "{$a} / {$b} = ".dividir($a, $b);
    }
  }
  
?>
  </body>
</html>
