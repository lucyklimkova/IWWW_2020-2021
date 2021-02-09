<?php
include "../headerAFooter.php";
hlavicka("Smazat tema");

$pripojeni = Pripojeni::pripojeniDatabaze();

if (isset($_GET['id'])) {

 $id = vstup($_GET['id']);

 $query ="DELETE FROM forum_otazky WHERE id_fo=$id";
 $result = $pripojeni->query($query);

 $pripojeni->close();
 header("Location: ../diskuze.php");
}