<?php
include "headerAFooter.php";
hlavicka("Postavy");

$pripojeni =Pripojeni::pripojeniDatabaze();

$sql1 = "SELECT * FROM postavy";
$query = $pripojeni->query($sql1);

if(!$query){
   echo('Nelze vybrat záznamy:' . $pripojeni->error);
   exit();
}
?>
    <div id="obsah">
    <h1>Postavy</h1>
    <p>Zde naleznete přehled hlavních postav, které se v seriálu vyskytují.</p>
<?php
while($row = $query->fetch_assoc()) {
   $obrazek = $row["obrazek"];
   echo "<img src='obrazky/postavy/$obrazek' class='pic' alt='obrazek'>";
   $id_pos = $row["id_pos"];
?>
 <div class="postavy">
   <h3><?php echo $row["jmeno"]; ?></h3>
   <span><strong>Herec: </strong><?php echo $row["herec"]; ?></span> <br>
   <span><strong>Příslušnost: </strong><?php echo $row["prislusnost"]; ?></span> <br>
   <p> <?php echo $row["strucny_popis"]; ?>  </p>
     <?php
     if ((isset($_SESSION['prava']) && ('admin' == $_SESSION['prava']))) {
         echo "<a href='editace/edit_postava.php?update=" . $id_pos . "' class='tlacitko'>Editace postavy</a>";
      ?>
         <a <?php echo "href='smazani/smaz_postavu.php?id_pos".$id_pos."';" ?> class='tlacitko'  onclick="return confirm('Chcete opravdu smazat tuto postavu?')">Smazání postavy</a><br><br>
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

