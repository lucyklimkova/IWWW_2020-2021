<?php
include "../headerAFooter.php";
hlavicka("Smazat");
$pripojeni = Pripojeni::pripojeniDatabaze();

if (isset($_GET['id'])) {

$id = vstup($_GET['id']);
$query ="DELETE FROM uzivatele WHERE id=$id";
$result = $pripojeni->query($query);
    
$sql ="DELETE FROM novinky WHERE uzivatel=$id";    
$res = $pripojeni->query($sql);
    
if($result && $res) {  
    session_destroy();          
    header("Location: odeber_uzivatele.php");
  }
  else {   
      $errmsg = "Nepodařilo se odstranit účet!";
      Pripojeni::alert($errmsg);
 }
$pripojeni->close();
}
