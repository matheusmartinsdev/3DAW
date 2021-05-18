<?php
  include("dbconnect.php");

  if (isset( $_GET["id"] ) )
  {
    $id = $_GET["id"];
    $origin = $_GET["origin"];

    if ($origin == "produtos.php")
    {
      $query = "DELETE FROM produtos WHERE id = '$id'";
    }
    else
    {
      $query = "DELETE FROM clientes WHERE id = '$id'";
    }

    if (mysqli_query($link, $query))
    {
      header("location: $origin");
    }
    else
    {
      echo "<script>alert('Erro ao excluir registro!')</script>";
    }
  }