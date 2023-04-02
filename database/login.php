<?php
$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $mysqli = require __DIR__ . "/connection.php";
    
    $sql = sprintf("SELECT * FROM users
                    WHERE email = '%s'",
                   $mysqli->real_escape_string($_POST["email"]));
    
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();

    print_r($user);
    
    if ($user) {
        if ($user["password"] === $_POST["password"]){

            session_start();
            session_regenerate_id();
            $_SESSION["user_id"] = $user["id"];
            header("Location: index.php");

            exit;
        }
    }
    $is_invalid = true;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="design.css">
    <title>LogIn</title>
</head>
<body>
   
<h1>Log-In</h1>
<?php if ($is_invalid): ?>
        <em>Invalid login</em>
    <?php endif; ?>


<form method = "post" novalidate >
       
        <div>
        <label for = "email" >E-mail</label>
        <input type ="email" id="email" name = "email">
        </div>

        <div>
        <label for = "password" >Password</label>
        <input type ="password" id="password" name = "password">
        </div>

        <button>Log-In</button>

    </form>
</body>
</html>