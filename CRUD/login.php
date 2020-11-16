<?php
session_start();
$host = "localhost";
$username = "root";
$password = "";
$dbname = "crud";
$sql = "";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$error = "";

if(isset($_POST["login_user"])) {
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $pass = mysqli_real_escape_string($conn, $_POST["password"]);
    if(!empty($email) && !empty($pass)) {
        $pass = md5($pass);
        $query = "SELECT * FROM users WHERE email = '$email' AND password = '$pass'";
        $result = mysqli_query($conn, $query);
        if(mysqli_num_rows($result) == 1) {
            $row = $result->fetch_array();
            $_SESSION["id"] = $row["id"];
            $_SESSION["email"] = $row["email"];
            $_SESSION["role"] = $row["role"];
            $_SESSION["name"] = $row["name"];
            $_SESSION["lastname"] = $row["lastname"];
            header("Location: index.php");
        } else {
            $error = "This users does not exist! Please register first!";
        }
    } else {
        $error = "E-mail or password is not inserted!";
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
    <button type="submit" class="btn" name="login_user">Submit</button>
</form>
</div>
</body>
</html>
