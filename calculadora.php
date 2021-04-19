<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="style.css">
    <title>Calculadora</title>
  </head>
  <body>
  <div class="container">
    <h2>Calculadora</h2>
    <form method="POST" action="calculadora.php">
      A: <input type="number" name="a" />
      B: <input type="number" name="b" />
      <h3>Operação:</h3>
      <select name="op">
        <option value="somar">Soma</option>
        <option value="subtrair">Subtração</option>
        <option value="multiplicar">Multiplicação</option>
        <option value="dividir">Divisão</option>
        <option value="porcento">Porcentagem</option>
        <option value="potenciacao">Potenciação</option>
        <option value="inverso">Inverso</option>
        <option value="raiz">Raíz Quadrática</option>
      </select>
      <input type="submit" value="Calcular" />
    </form>
  
    <?php

      //Recebendo variáveis
      $a = $_POST["a"];
      $b = $_POST["b"];
      $operacao = $_POST["op"];

      //Validação das entradas
      function validaEntradas ($a, $b, $operacao)
      {
        if ( isset ($operacao) )
        {
          //Operações com 2 números:
          if( 
            ($operacao === "somar") ||
            ($operacao === "subtrair") || 
            ($operacao === "multiplicar") || 
            ($operacao === "dividir") ||
            ($operacao === "porcento") ||
            ($operacao === "potenciacao") 
            )
          {
            if ( (isset($a) || is_numeric($a) ) || ( isset($b) || is_numeric($b) ) )
            {
              return true;
            }
            else
            {
              return false;
            }
          }
          elseif ($operacao === "inverso" || $operacao === "raiz")
          {
            //Operações com 1 número:
            if ( isset($a) && is_numeric($a) && !is_numeric($b) )
            {
              return true;
            }
            else
            {
              return false;
            }
          }
        }
        else //Se a operação não for selecionada, retorna falso
        {
          return false;
        }
      }

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

      function porcentagem($a, $b)
      {
        return ($a/$b) * 100;
      }

      function inverso ($a)
      {
        return 1/($a);
      }

      function potenciacao ($a, $b)
      {
        return pow($a, $b);
      }

      function raizQuadradada ($a)
      {
        return sqrt($a);
      }


      //Validando as entradas
      if ( validaEntradas($a, $b, $operacao) )
      {        
        if ($operacao === "somar") //Soma
        {
          echo "{$a} + {$b} = ".soma($a, $b);
        }
          elseif ($operacao === "subtrair") //Subtração
          {
            echo "{$a} - {$b} = ".subtrair($a, $b);
          }
            elseif ($operacao === "multiplicar") //Multiplicação
            {
              echo "{$a} * {$b} = ".multiplicar($a, $b);
            }
              elseif ($operacao === "dividir") //Divisão
              {
                if ($b == 0)
                {
                  echo "Não é possível dividir por 0!";
                }
                else
                {
                  echo "{$a} / {$b} = ".dividir($a, $b);
                }
              }
                elseif ($operacao === "porcento") //Porcentagem
                {
                  echo "{$a} representa ".porcentagem($a, $b)."% de {$b}";
                }
                  elseif ($operacao === "potenciacao") //Potenciação
                  {
                    echo "{$a} ^ {$b} = ".potenciacao($a, $b);
                  }
                    elseif ($operacao === "inverso")
                    {
                      echo "O inverso de {$a} é ".inverso($a);
                    }
                      elseif ($operacao === "raiz")
                      {
                        echo "A raíz quadrada de {$a} é ". raizQuadradada($a);
                      }
      }
      else
      {
        echo "Entradas inválidas!";
      }
    ?>
  </div>
  </body>
</html>
