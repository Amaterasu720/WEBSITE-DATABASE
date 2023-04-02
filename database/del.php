<?php

session_start();


if(! isset($_SESSION["user_id"])){
    header("Location: index.php");

    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $mysqli = require __DIR__ . "/connection.php";
    
    $sql = "DELETE FROM users WHERE id = {$_SESSION["user_id"]}";
                   
    $mysqli->query($sql);

    session_destroy();

    header("Location: del_c.php");

    exit;

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="design.css">
    <title>Delete Account</title>
</head>
<body>
    <h1>Delete Account</h1>

    Do you really want to delete your Account 
    <form  method = "post" > 

        <button>DELETE ACCOUNT</button>

    </form>

    or  <p> return to <a href="index.php">HOME</a></p><br>
    
</body>
</html>