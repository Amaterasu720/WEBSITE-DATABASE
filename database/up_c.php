<?php

session_start();
if(! isset($_SESSION["user_id"])){
    header("Location: index.php");

    exit;
}
//  print_r($_SESSION);


?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="design.css">
    <title>Changes Done</title>
    <meta charset="UTF-8">
</head>
<body>
<h1>CHANGES DONE SUCCESSFULY </h1>  
        <a href="index.php">return to home </a> 
        
    
</body>
</html>