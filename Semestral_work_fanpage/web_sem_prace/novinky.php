<?php
include "headerAFooter.php";
hlavicka("Novinky");

?>
<div id="obsah">
 <h1>Novinky</h1>
 <p>Zde nalaznete novinky, které napsali uživatelé.</p>
<?php

static  $time, $myFormatForView, $page, $cas, $id_novinky;
$pripojeni = Pripojeni::pripojeniDatabaze();

$sql1 = "SELECT * FROM novinky INNER JOIN uzivatele ON novinky.uzivatel=uzivatele.id";

$nadpis = $jmeno = $prijmeni = $popisek = $novyObsah = $myFormatForView  = $obsah = "";

if ($query = $pripojeni->query($sql1)) {
while($row = $query->fetch_assoc()) {
   $id_novinky = $row["id_novinky"];
   $cas = $row["cas"];
   $nadpis =  $row["nadpis"];
    $popisek =$row["popisek"];
    $jmeno =$row["jmeno"];
    $prijmeni = $row["prijmeni"];


 if (($time = strtotime($cas)) == false) {
      Pripojeni::alert("Špatný čas!");
  }
  if (($myFormatForView = date("d/m/y G:i ", $time)) == false) {
      Pripojeni::alert("Špatné datum a čas!");
  }
?>
    <div class="news-box">
    <h3><?php  echo $nadpis; ?></h3>
    <span><b>Popisek: </b><?php  echo $popisek; ?></span>
    <p><b>Přidáno: </b><?php  echo $myFormatForView; ?></p>
    <p><b>Autor: </b><?php  echo $jmeno; ?> <?php echo $prijmeni; ?></p>

    <?php
    echo "<a href='detail_novinka.php?id_novinky=".$id_novinky."' class='button'>Detail novinky</a>";
    ?>
    </div>
    <br><br>
<?php
    }
}
else {
?>
    <p>Žádné novinky v databázi!</p>
<?php
}
$pripojeni->close();
?>
 </div>
<?php
paticka();
