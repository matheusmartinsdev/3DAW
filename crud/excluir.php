<?php
  include("bdconnect.php");

  if (isset( $_GET["id"] ) )
  {
    $id = $_GET["id"];
    $query = "DELETE FROM alunos WHERE id = '$id'";
    $origin = $_GET["origin"];

    if (mysqli_query($link, $query))
    {
      header("location: $origin");
    }
    else
    {
      echo "<script>alert('Erro ao excluir aluno')</script>";
    }
  }