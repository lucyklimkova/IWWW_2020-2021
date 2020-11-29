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

    if(empty(trim($_POST["name"]))) {
        $error .= "Please enter name.<br>";
    } else {
        $name = trim($_POST["name"]);
    }

    if(empty(trim($_POST["lastname"]))) {
        $error .= "Please enter last name.<br>";
    } else {
        $lastname = trim($_POST["lastname"]);
    }

    $role = "user";
    if(empty($error)) {
        if(!User::register($email, $password, $name, $lastname, $pdo, $role)) {
            $error .= "User already exists.<br>";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Registration</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include 'header.php'?>
<?php
if (!empty($error))
    echo $error;
?>
<div class="obsah">
<form method="post" action="register.php">
    <h2>Registration</h2>
        <label>E-mail:
        <input type="email" name="email"></label>
        <label>Password:
        <input type="password" name="password"></label>
        <label>Name:
        <input type="text" name="name"></label>
        <label>Last name:
        <input type="text" name="lastname"></label>
        <?php
        if(isset($_SESSION["role"])) {
            if($_SESSION["role"] == "admin") {
                echo '<label>Role</label>';
                echo '<input type="text" name="role">';
            }
        }
        ?>
        <input type="submit" value="Register">
</form>
</div>
</body>
</html>