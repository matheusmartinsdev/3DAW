<?php
  include("dbconnect.php");
  if ( $_SERVER["REQUEST_METHOD"] == "DELETE" )
  {
    $id = file_get_contents("php://input");
    
    $query = "DELETE FROM produtos WHERE id = '$id'";
    
    if (mysqli_query($link, $query))
    {
      http_response_code(200);
    }
    else
    {
      http_response_code(500);
    }
  }
?>