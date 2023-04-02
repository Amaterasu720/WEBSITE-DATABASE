<?php

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
    die("Password must contain at least one letter");
}

if ( ! preg_match("/[0-9]/", $_POST["password"])) {
    die("Password must contain at least one number");
}

if ($_POST["password"] !== $_POST["c_password"]) {
    die("Passwords do not match");
}

$mysqli = require __DIR__ ."/connection.php";
$sql = "INSERT INTO users (f_name,l_name,email,password) values(?,?,?,?); ";


$stmt = $mysqli->stmt_init();

if ( ! $stmt->prepare($sql)) {
    echo "SQL error: " . $mysqli->error ;
}

$stmt->bind_param("ssss",
                  $_POST["f_name"],
                  $_POST["l_name"],
                  $_POST["email"],
                  $_POST["password"]);

if($stmt->execute()){
    header("location:signup_done.html");
}

   
 else {
    
    if ($mysqli->errno === 1062) {
        die("email already taken");
    } else {
        die($mysqli->error . " " . $mysqli->errno);
    }
}







