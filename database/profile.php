<?php

session_start();

// print_r($_SESSION);

 if (isset($_SESSION["user_id"])) {
    
    $mysqli = require __DIR__ . "/connection.php";
    
    $sql = "SELECT * FROM users
            WHERE id = {$_SESSION["user_id"]}";
            
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();

    // print_r($user);
}else{
    header("Location: index.php");

    exit;
}



?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="design.css">
    <title>Home</title>
    <meta charset="UTF-8">
</head>
<body>
    
    <h1>Home</h1>

        
        <p>FIRST NAME: <?= htmlspecialchars($user["f_name"]) ?></p>
        
        <p>LAST NAME: <?= htmlspecialchars($user["l_name"]) ?></p>

        <p>EMAIL: <?= htmlspecialchars($user["email"]) ?></p>

        <p> return to <a href="index.php"> HOME</a></p><br>
        
  

</html>
    
    
    
    
    
    
    
    
    
    
    