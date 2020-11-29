<?php
/**
 * @var $pdo
 */

session_start();
require_once "connection.php";

if(!isset($_SESSION["email"]))
    header("Location: index.php");

?>

<html>
<head>
    <title>Orders</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include 'header.php'?>
<section>
    <h2>Orders</h2>
    <?php
    $query = "SELECT * FROM orders WHERE id_user = " . $_SESSION["id"];
    $stmt = $pdo->query($query);
    while ($row = $stmt->fetch()) {
        echo '<a href="detail.php?id=' . $row["id"] . '">Order number ' . $row["id"] . ' Detail</a><br>';
    }
    ?>
</section>
</body>
</html>