<?php

session_start();

// print_r($_SESSION);

 if (isset($_SESSION["user_id"])) {
    
    $mysqli = require __DIR__ . "/connection.php";
    
    $sql = "SELECT * FROM users
            WHERE id = {$_SESSION["user_id"]}";
            
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
}else{
    header("Location: index.php");

    exit;
}
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    if (empty($_POST["f_name"])) {
        die("First name is required");
    }
    
    if (empty($_POST["l_name"])) {
        die("Last name is required");
    }
    
    if ( ! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        die("Valid email is required");
    }
    
    if (strlen($_POST["password"]) < 8) {
        die("Password must be at least 8 characters");
    }
    
    if ( ! preg_match("/[a-z]/i", $_POST["password"])) {
        die("Password must contain at least one letterr");
    }
    
    if ( ! preg_match("/[0-9]/", $_POST["password"])) {
        die("Password must contain at least one number");
    }


    $mysqli = require __DIR__ . "/connection.php";
    
    $sql = " UPDATE users SET f_name=\"{$_POST["f_name"]}\" , l_name = \"{$_POST["l_name"]}\", email = \"{$_POST["email"]}\" 
                , password=\"{$_POST["password"]}\"WHERE id={$_SESSION["user_id"]};" ;
     //don't add spacees in the \"
    
    $mysqli->query($sql);

    header("Location: up_c.php");

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
    <title>Update Account</title>
</head>
<body>
    <h1>Update Account</h1>

    <form method = "post" novalidate >
        <div>
        <label for = "f_name" >First Name</label>
        <input type ="text" id="f_name" name = "f_name" value=<?= htmlspecialchars($user["f_name"]) ?>>
        </div>

        <div>
            <label for = "l_name" >Last Name</label>
            <input type ="text" id="l_name" name = "l_name" value=<?= htmlspecialchars($user["l_name"]) ?>>
            </div>

        <div>
        <label for = "email" >E-mail</label>
        <input type ="email" id="email" name = "email"  value=<?= htmlspecialchars($user["email"]) ?> >
        </div>

        <div>
        <label for = "password" >Password</label>
        <input type ="text" id="password" name = "password"  value=<?= htmlspecialchars($user["password"]) ?> >
        </div>

        

        <button>Save Changes</button>

    </form>

    <br>
    return to <a href="index.php">HOME</a><br>
</body>
</html>