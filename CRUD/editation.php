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

$email = "";
$pass = "";
$name = "";
$lastname = "";
$role = "";
$error = "";

if(isset($_SESSION["id"])) {
    if(isset($_GET["id"]))
        $id = $_GET["id"];
    else
        $id = $_SESSION["id"];

if($id != $_SESSION["id"] && $_SESSION["role"] != "admin") {
    $error = "You are not allowed to edit that!";
} else {

$query = "SELECT * FROM users WHERE id = '$id'";
$result = mysqli_query($conn, $query);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
         $email = $row["email"];
         $role = $row["role"];
         $name = $row["name"];
         $lastname = $row["lastname"];
    }
}

if(isset($_POST["edit_user"])) {
    if(isset($_POST["email"])) {
        $email = mysqli_real_escape_string($conn, $_POST["email"]);
        if(!empty($email)) {
            $query = "UPDATE users SET email = '$email' WHERE id = '$id'";
            mysqli_query($conn, $query);
        }
    }

    if(isset($_POST["password"])) {
        $pass = mysqli_real_escape_string($conn, $_POST["password"]);
        if(!empty($pass)) {
            $pass = md5($pass);
            $query = "UPDATE users SET password = '$pass' WHERE id = '$id'";
            mysqli_query($conn, $query);
        }
    }

    if(isset($_POST["role"])) {
        $role = mysqli_real_escape_string($conn, $_POST["role"]);
        if(!empty($role)) {
            $query = "UPDATE users SET role = '$role' WHERE id = '$id'";
            mysqli_query($conn, $query);
        }
    }

    if(isset($_POST["name"])) {
        $name = mysqli_real_escape_string($conn, $_POST["name"]);
        if(!empty($name)) {
            $query = "UPDATE users SET name = '$name' WHERE id = '$id'";
            mysqli_query($conn, $query);
        }
    }

    if(isset($_POST["lastname"])) {
        $lastname = mysqli_real_escape_string($conn, $_POST["lastname"]);
        if(!empty($lastname)) {
            $query = "UPDATE users SET name = '$lastname' WHERE id = '$id'";
            mysqli_query($conn, $query);
        }
    }

    $error = "Everything is okay!";
    }
 }
} else {
    $error = "You are not allowed to do that!";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include 'header.php'?>
<?php
if (!empty($error))
    echo $error;
if (!empty($role)) { ?>
<div class="obsah">
    <h2>Edit</h2>
    <form method="post" action="edit.php?id=<?php echo $id ?>">
    <label>Email
    <input type="email" name="email" value="<?php echo $email ?>"></label>
    <label>Password
    <input type="password" name="password"></label>
    <label>Name:
     <input type="text" name="name" value="<?php echo $name ?>"></label>
    <label>Last name:
     <input type="text" name="lastname" value="<?php echo $lastname ?>"></label>
    <?php
    if($_SESSION["role"] == "admin") {
        echo '<label>Role:';
        echo '<input type="text" name="role" value="' . $role . '"></label>';

    }
}
    ?>
        <button type="submit" class="btn" name="edit_user">Edit</button>
    </form>
</div>
</body>
</html>