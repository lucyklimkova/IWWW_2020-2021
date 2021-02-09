<?php
include "../headerAFooter.php";
hlavicka("Smazat");

$pripojeni = Pripojeni::pripojeniDatabaze();

if (isset($_GET['id_her'])) {

    $id_her= vstup($_GET['id_her']);

    $query ="DELETE FROM herci WHERE id_her'$id_her'";
    $result = $pripojeni->query($query);

    $pripojeni->close();
    header("Location: ../herci.php");
}

