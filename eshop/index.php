<?php
/**
 * @var $pdo
 */

session_start();
ob_start();
require_once "connection.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Main page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'header.php'?>
<div class="container">
    <h1>Main page</h1>
</div>
</body>
</html>
