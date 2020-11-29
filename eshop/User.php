<?php

class User {

    public static function login($email, $password, $pdo) {
        $pass = md5($password);
        $query = "SELECT * FROM users WHERE email = '$email' AND password = '$pass'";
        $stmt = $pdo->query($query);
        $count = $stmt->rowCount();
        $row = $stmt->fetch();
        if ($count == 1) {
            $_SESSION["id"] = $row["id"];
            $_SESSION["email"] = $row["email"];
            $_SESSION["role"] = $row["role"];
            $_SESSION["name"] = $row["name"];
            $_SESSION["lastname"] = $row["lastname"];

            header("location: index.php");
            return 2;
        } else {
            return 1;
        }
    }

    public static function register($email, $password, $name, $lastname, $pdo, $role) {
        $query = $query = "SELECT * FROM users WHERE email = '$email'";
        $stmt = $pdo->query($query);
        $count = $stmt->rowCount();
        if ($count == 0) {
            $passwordHash = md5($password);
            $query = "INSERT INTO users(name, lastname, email, password, role) VALUES('$name ', ' $lastname ', '$email', '$passwordHash ', ' $role ')";
            $pdo->query($query);
            header("location: index.php");
            return true;
        } else {
            return false;
        }
    }

}