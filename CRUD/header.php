<header>
    <nav>
        <ul>
<?php
if(!isset($_SESSION["role"])) {
    echo '<li><a href="index.php">Main page</a></li>';
    echo '<li><a href="login.php">Login</a></li>';
    echo '<li><a href="register.php">Register</a></li>';
} else {
    echo '<li><a href="index.php">Main page</a></li>';
    echo '<li><a href="logout.php">Logout</a></li>';
    echo '<li><a href="editation.php?id=' . $_SESSION["id"] . '">Edit</a></li>';
    if($_SESSION["role"] == "admin")
        echo '<li><a href="tableResults.php">Table results</a></li>';
}
?>
        </ul>
    </nav>
</header>
