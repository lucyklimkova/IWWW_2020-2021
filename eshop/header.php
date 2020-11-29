<header>
    <nav>
        <ul>
<?php
if(!isset($_SESSION["role"])) {
    echo '<li><a href="index.php">Main page</a></li>';
    echo '<li><a href="catalog.php">Catalog</a></li>';
    echo '<li><a href="login.php">Login</a></li>';
    echo '<li><a href="register.php">Register</a></li>';
} else {
    echo '<li><a href="index.php">Main page</a></li>';
    echo '<li><a href="catalog.php">Catalog</a></li>';
    echo '<li><a href="cart.php">Cart</a></li>';
    echo '<li><a href="orders.php">Orders</a></li>';
    echo '<li><a href="logout.php">Logout</a></li>';
}
?>
        </ul>
    </nav>
</header>
