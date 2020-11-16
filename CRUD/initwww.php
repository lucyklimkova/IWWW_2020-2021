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

$sql = file_get_contents("initwww.sql");

if ($conn->query($sql) === TRUE) {
    echo "Table users was created successfully!";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();