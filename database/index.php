<?php

session_start();

// print_r($_SESSION);

 if (isset($_SESSION["user_id"])) {
    
    $mysqli = require __DIR__ . "/connection.php";
    
    $sql = "SELECT * FROM users
            WHERE id = {$_SESSION["user_id"]}";
            
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
}



?>
<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <link rel="stylesheet" href="design.css">
    <meta charset="UTF-8">
</head>
<body>
    
    <h1>Home</h1>

   <?php if (isset($user)): ?>
        
        <p>Hello <?= htmlspecialchars($user["f_name"]) ?></p>
        
        <p><a href="profile.php">View Profile</a></p>
       

        <p><a href="del.php">Delete Account</a></p>
        
        <p><a href="update.php">Update Account</a></p>

        <form action="logout.php" >
            <button> LOG-OUT </button>
        </form>
        
        
    <?php else: ?>
        
        <p><a href="login.php">Log in</a> or <a href="signup.html">sign up</a></p>
        
    <?php endif; ?>
    
</body>
</html>
    
    
    
    
    
    
    
    
    
    
    