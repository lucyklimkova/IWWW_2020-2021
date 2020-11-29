<?php
/**
 * @var $pdo
 */

session_start();
require_once "connection.php";

if(!isset($_SESSION["email"]) || !isset($_GET["id"]))
    header("Location: index.php");

?>

<html>
<head>
    <title>Detail</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include 'header.php'?>
<section>
    <h2>Detail</h2>
    <?php
    if(isset($_GET["id"])) {
        $id = $_GET["id"];
        $query = "SELECT * FROM orders WHERE id_user = " . $_SESSION["id"] . " AND id = " . $id;
        $stmt = $pdo->query($query);
        if($stmt->rowCount() != 1)
            header("Location: catalog.php");

        $query = "SELECT * FROM ordereditems WHERE id_order = '$id'";
        $stmt = $pdo->query($query);
        $sum = 0;
        while($row = $stmt->fetch()) {
            $productId = $row["id_product"];
            $query = "SELECT name from products WHERE id = '$productId'";
            $stmtName = $pdo->query($query);
            echo "<b>Item: </b> Name: ". $stmtName->fetch()[0] . ", Quantity: ";
            echo $row["quantity"] . " piece/pieces,  Price: ";
            echo $row["pricePerPiece"] . "$<br>";
            $sum += $row["quantity"] * $row["pricePerPiece"];
        }
        echo "<b>Total price: </b>" . $sum.  "$<br>";
    }
    ?>
</section>
</html>
