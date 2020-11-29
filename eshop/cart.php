<?php
/**
 * @var $pdo
 */
session_start();
require_once "connection.php";
$text = "";

if(!isset($_SESSION["email"]))
    header("Location: index.php");

function getBy($att, $value, $array) {
    foreach ($array as $key => $val) {
        if ($val[$att] == $value) {
            return $key;
        }
    }
    return null;
}

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

if (isset($_GET["action"])) {
    if ($_GET["action"] == "add" && !empty($_GET["id"])) {
        addToCart($_GET["id"]);
        header("Location: cart.php");
    }

    if ($_GET["action"] == "remove" && !empty($_GET["id"])) {
        removeFromCart($_GET["id"]);
        header("Location: cart.php");
    }

    if ($_GET["action"] == "delete" && !empty($_GET["id"])) {
        deleteFromCart($_GET["id"]);
        header("Location: cart.php");
    }
}
function addToCart($productId) {
    if (!array_key_exists($productId, $_SESSION["cart"])) {
        $_SESSION["cart"][$productId]["quantity"] = 1;
    } else {
        $_SESSION["cart"][$productId]["quantity"]++;
    }
}

function removeFromCart($productId) {
    if (array_key_exists($productId, $_SESSION["cart"])) {
        if ($_SESSION["cart"][$productId]["quantity"] <= 1) {
            deleteFromCart($productId);
        } else {
            $_SESSION["cart"][$productId]["quantity"]--;
        }
    }
}

function deleteFromCart($productId) {
    unset($_SESSION["cart"][$productId]);
}

if (isset($_POST["Order"])) {
    $query = 'INSERT INTO orders(id_user) VALUES(' . $_SESSION["id"] . ')';
    $pdo->query($query);
    $query = "SELECT id FROM orders ORDER BY id DESC LIMIT 1";
    $stmt = $pdo->query($query);
    $orderId = $stmt->fetch()[0];
    foreach ($_SESSION["cart"] as $key => $value) {
        $item = $catalog[getBy("id", $key, $catalog)];
        $query = 'INSERT INTO ordereditems(id_order, id_product, quantity, pricePerPiece) VALUES(' . $orderId . ', ' . $item["id"] . ', ' . $value["quantity"] . ',' . $item["price"] . ')';
        $pdo->query($query);
    }

    $text = "Order was successfully created!";
    unset($_SESSION["cart"]);
}

?>
<html>
<head>
    <title>Cart</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include 'header.php'?>

<section>
<h2>Cart</h2>
    <?php
    if (!empty($text))
        echo $text;
    if (isset($_SESSION["cart"])) {
        $totalPrice = 0;
        foreach ($_SESSION["cart"] as $key => $value) {

            $item = $catalog[getBy("id", $key, $catalog)];
            $totalPrice = $totalPrice + ($value["quantity"] * $item["price"]);
            echo '
<div class="cart-item">
<div class="cart-img">
' . $item["img"] . '
</div>
<div>
Name: 
' . $item["name"] .'
</div>
<div class="cart-control">
<div class="cart-price">
Price: 
' . $item["price"] . '
</div>
<div class="cart-quantity">
Quantity: 
' . ($value["quantity"]) . '
</div>
<div class="cart-quantity">
Total price: 
' . ($value["quantity"] * $item["price"]) . '
</div>
<a href="cart.php?action=add&id=' . $item["id"] . '" class="cart-button">
+
</a>
<a href="cart.php?action=remove&id=' . $item["id"] . '" class="cart-button">
-
</a>
<a href="cart.php?action=delete&id=' . $item["id"] . '" class="cart-button">
Delete
</a>
</div>
</div>';
        }
        if($totalPrice != 0) {
            echo '<div id="cart-total-price">Total price is: ' . $totalPrice . '</div>
            <form action="cart.php" method="post">
            <br>
            <input type="submit" value="Order" name="Order">
            </form>';
        }
    }
    ?>

</section>
</body>
</html>