<?php
include "headerAFooter.php";
hlavicka("Herci");

$pripojeni = Pripojeni::pripojeniDatabaze();
$sql1 = "SELECT * from herci";
$query = $pripojeni->query($sql1);

if(!$query){
   echo('Nelze vybrat záznamy:' . $pripojeni->error);
   exit();
}

?>
<div id="obsah">
    <h1>Herci</h1>
    <p>Herecké obsazení seriálu.</p>
<?php
while($row = $query->fetch_assoc()) {
     $obrazek= $row["obrazek"];
     echo "<img src='obrazky/herci/$obrazek' class='pic' alt='obrazek'>";
     $id_her = $row["id_her"];
     ?>
    <div class="postavy">
        <h3><?php echo $row["jmeno"]; ?></h3>
        <span><strong>Postava: </strong><?php echo $row["postava"]; ?></span><br>
        <p> <?php echo $row["strucny_popis"]; ?> </p>
        <?php
        if ((isset($_SESSION['prava']) && ('admin' == $_SESSION['prava']))) {
        echo "<a href='editace/edit_herec.php?update=" . $id_her . "' class='tlacitko'>Editace herce</a>";
        ?>
        <a <?php echo "href='smazani/smaz_herce.php?id_her=".$id_her."';" ?> class='tlacitko'  onclick="return confirm('Chcete opravdu smazat tohoto herce?')">Smazání herce</a><br><br>
<?php
        }?>
    </div>
    <br><br><br><br><br><br>
<?php
}
$pripojeni->close();
?>
</div>
<?php
paticka();