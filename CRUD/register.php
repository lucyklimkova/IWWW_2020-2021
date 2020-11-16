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

if(isset($_POST["reg_user"])) {
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $pass = mysqli_real_escape_string($conn, $_POST["password"]);
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $lastname = mysqli_real_escape_string($conn, $_POST["lastname"]);
    if(!empty($email) && !empty($pass) && !empty($name) && !empty($lastname)) {
        $user_check = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $user_check);
        $user = mysqli_fetch_assoc($result);

    if(!$user) {
        $pass = md5($pass);
        if(isset($_POST["role"]))
            $role = mysqli_real_escape_string($conn, $_POST["role"]);
        else
            $role = "user";

        $query = "INSERT INTO users (name, lastname, email, password, role) VALUES ('$name', '$lastname', '$email',  '$pass', '$role')";
        mysqli_query($conn, $query);
        header("Location: index.php");
    } else {
        $error = "User with this e-mail does already exist!";
        }
    } else {
        $error = "All fields must be filled!";
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
        <button type="submit" class="btn" name="reg_user">Submit</button>
</form>
</div>
</body>
</html>