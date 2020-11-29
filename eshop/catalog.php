<?php
/**
 * @var $pdo
 */

session_start();
ob_start();
require_once "connection.php";
$text = "";

function createCatalog($pdo) {
    $arr[][] = NULL;
    $i = 0;
    $query = "SELECT * FROM products";
    $stmt = $pdo->query($query);
    while ($row = $stmt->fetch()) {
        $arr[$i]["id"] = $row["id"];
        $arr[$i]["img"] = $row["img"];
        $arr[$i]["name"] = $row["name"];
        $arr[$i]["price"] = $row["price"];
        $i++;
    }
    return $arr;
}

$catalog = createCatalog($pdo);

function getBy($att, $value, $array) {
    foreach ($array as $key => $val) {
        if ($val[$att] == $value) {
            return $key;
        }
    }
    return null;
}

if (isset($_GET["action"])) {
    if ($_GET["action"] == "add" && !empty($_GET["id"])) {
        addToCart($_GET["id"]);
        $text = "Item was successfully added to cart!";
        header("Location: catalog.php");
    }
}


function addToCart($productId) {
    if (!array_key_exists($productId, $_SESSION["cart"])) {
        $_SESSION["cart"][$productId]["quantity"] = 1;
    } else {
        $_SESSION["cart"][$productId]["quantity"]++;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Catalog</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'header.php'?>
    <h2>Catalog</h2>
    <?php
    if (!empty($text))
        echo $text; ?>
<div id ="catalog-items">
        <?php
        foreach ($catalog as $item) {
            echo '
<div class="catalog-item">
<div class="catalog-img">
' . $item["img"] . '
</div>
<h3>
Name:
' . $item["name"] . '
</h3>
<div>
Price: 
' . $item["price"] . '$
</div>';
            if (isset($_SESSION["email"])) {
                echo '<a href="catalog.php?action=add&id=' . $item["id"] . '" class="catalog-buy-button">Buy</a>';
            }
            echo '</div>';
        }
        ?>
</div>
</body>
</html>
