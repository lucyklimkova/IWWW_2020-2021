<?php
/**
 * @var $pdo
 */

session_start();
require_once "connection.php";
require_once "User.php";
$email ="";
$password ="";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $error = NULL;
    if(empty(trim($_POST["email"]))) {
        $error .= "Please enter email.<br>";
    } else {
        $email = trim($_POST["email"]);
    }

    if(empty(trim($_POST["password"]))) {
        $error .= "Please enter password.<br>";
    } else {
        $password = trim($_POST["password"]);
    }

    if(empty($error)) {
        if(User::login($email, $password, $pdo) == 1) {
            $error .= "Email or password is not valid.<br>";
        } elseif(User::login($email, $password, $pdo) == 0) {
            $error .= "errr2.<br>";
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include 'header.php'?>
<?php
if (!empty($error))
    echo $error;
?>
<div class="obsah">
<form method="post" action="login.php">
    <h2>Login</h2>
    <label for="email">E-mail:
    <input type="email"  id="email" name="email"></label>
    <label for="password">Password:
    <input type="password" id="password" name="password"></label>
    <input type="submit" value="Log in" class="button">
</form>
</div>
</body>
</html>
