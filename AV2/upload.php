<?php
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $barCode = $_POST["barrCode"];
    $tempName = $_FILES["myFiles"]["tmp_name"][0];
    
    if ($barCode && $tempName) { 
        $path = "img/" . basename($barCode . ".jpg");
        move_uploaded_file($tempName, $path);
    }
}