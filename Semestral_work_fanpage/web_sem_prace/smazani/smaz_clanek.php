<?php
include "../headerAFooter.php";
hlavicka("Smazat");

$pripojeni = Pripojeni::pripojeniDatabaze();

if (isset($_GET['id_novinky'])) {

 $id_novinky = vstup($_GET['id_novinky']);

 $query ="DELETE FROM novinky WHERE id_novinky='$id_novinky'";
 $result = $pripojeni->query($query);

 $pripojeni->close();
 header("Location: ../vypis_novinek.php");
}

