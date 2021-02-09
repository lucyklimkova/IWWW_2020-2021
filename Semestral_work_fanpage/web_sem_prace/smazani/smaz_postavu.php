<?php
include "../headerAFooter.php";
hlavicka("Smazat");

$pripojeni = Pripojeni::pripojeniDatabaze();

if (isset($_GET['id_pos'])) {

    $id_pos = vstup($_GET['id_pos']);

    $query ="DELETE FROM postavy WHERE id_pos='$id_pos'";
    $result = $pripojeni->query($query);

    $pripojeni->close();
    header("Location: ../postavy.php");
}


