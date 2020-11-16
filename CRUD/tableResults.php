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
$error = "";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Table results</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include 'header.php';
if(isset($_SESSION["role"])) {
    if($_SESSION["role"] != "admin") {
        $error = "You are not an admin!";
    } else {
$query = "SELECT * FROM users";
$result = mysqli_query($conn, $query);
if ($result->num_rows > 0) {
    echo "<h2>Results from table users: </h2><br>";
    while($oneRow = $result->fetch_assoc()) {
        echo "User ID: " . $oneRow["id"]. " - Name: " . $oneRow["name"]. " - Last name: " . $oneRow["lastname"].  " - E-mail: " . $oneRow["email"]. " - Role: " . $oneRow["role"] . ' <a href="editation.php?id=' . $oneRow["id"] . '">Edit</a><br>';
    }
}
    }
} else {
    $error = "You are not logged in!";
}
if (!empty($error))
    echo $error;
?>
</body>
</html>
