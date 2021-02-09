<?php
include "headerAFooter.php";
hlavicka("Detail novinky");

$pripojeni = Pripojeni::pripojeniDatabaze();
$id_novinky = vstup($_GET['id_novinky']);

$sql = "SELECT id_novinky, nadpis, popisek, obsah, cas, jmeno, prijmeni FROM novinky 
  JOIN uzivatele ON novinky.uzivatel = uzivatele.id
  WHERE id_novinky ='$id_novinky'";

$result = $pripojeni->query($sql);
 $nadpis = $jmeno = $prijmeni = $popisek = $novyObsah = $myFormatForView  = $obsah = "";
 if($result) {
 while($row = $result->fetch_assoc()) {
   $cas = $row["cas"];
   $time = strtotime($cas);
   $myFormatForView = date("d/m/y G:i ", $time);
   $obsah = $row["obsah"];
   $nadpis = $row["nadpis"];
   $popisek = $row["popisek"];
   $jmeno = $row["jmeno"];
   $prijmeni = $row["prijmeni"];
  }
 }
 ?>
<div id="obsah">
<h1>Detail novinky</h1>
<div class="news-detail">
<h2><?php echo $nadpis ?></h2>
<span><?php echo $popisek ?></span>
<?php echo html_entity_decode($obsah) ?>
<p><b>Přidáno</b> <i><?php echo $myFormatForView ?></i><b>, uživatelem </b><i><?php echo $jmeno ?> <?php echo $prijmeni ?></i></p>

<a href="novinky.php" class="button2 right">Zpět na všechny novinky</a>
</div>
<br><br>
</div>
<?php

$pripojeni->close();
paticka(); ?>