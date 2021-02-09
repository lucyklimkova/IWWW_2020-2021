<?php
include "../headerAFooter.php";
hlavicka("Smazat");

$pripojeni = Pripojeni::pripojeniDatabaze();

if (isset($_GET['id_ep'])) {

    $id_ep = vstup($_GET['id_ep']);

    $query ="DELETE FROM epizody WHERE id_ep='$id_ep'";
    $result = $pripojeni->query($query);

    $pripojeni->close();
    header("Location: ../epizody.php");
}

