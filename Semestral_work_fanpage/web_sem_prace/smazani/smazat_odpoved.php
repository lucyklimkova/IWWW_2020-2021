<?php
include "../headerAFooter.php";
hlavicka("Smazat tema");

$pripojeni = Pripojeni::pripojeniDatabaze();

if (isset($_GET['id_fod'])) {
 
 $id_fod = vstup($_GET['id_fod']);

 $query ="DELETE FROM forum_odpovedi WHERE id_fod=$id_fod";
 $result = $pripojeni->query($query);

 $pripojeni->close();
 header("Location: ../diskuze.php");
}
