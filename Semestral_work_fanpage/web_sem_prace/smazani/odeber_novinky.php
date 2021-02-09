<?php
include "../headerAFooter.php";
hlavicka("Odebrání novinky");

$pripojeni = Pripojeni::pripojeniDatabaze();

$sql = "SELECT id_novinky, nadpis, popisek, cas, jmeno, prijmeni FROM novinky 
        JOIN uzivatele ON novinky.uzivatel = uzivatele.id
        ORDER BY cas DESC";

$result = $pripojeni->query($sql);

if(!$result) {
   echo('Nelze vybrat záznamy:' . $pripojeni->error);
   exit();
}

if (isset($_SESSION['prava']) && ('admin' == $_SESSION['prava'])) {
?>
    <div id="obsah">
    <h1>Odebrání novinky</h1>
<?php
while($row = $result->fetch_assoc()) {
  $id_novinky = $row["id_novinky"];
?>
    <div>
        <h3> <?php echo $row["nadpis"]; ?> </h3>
        <p><b>Autor: </b> <?php echo $row["jmeno"]; ?> <?php echo $row["prijmeni"]; ?> </p>
        <a <?php echo "href='smaz_clanek_admin.php?id_novinky=".$id_novinky."';" ?> class='tlacitko'  onclick="return confirm('Chcete opravdu smazat tuto novinku?')">Smazat novinku</a><br>
    </div>
    <br><br>
<?php
   }
$pripojeni->close();
 } else {
?>
<p> Nejste přihlášen/na a nebo nemáte administrátorská práva! </p>
<?php
}
?>
<a href="../administrace.php" class="button2 right">Zpět</a><br>
</div>
<?php
paticka();
