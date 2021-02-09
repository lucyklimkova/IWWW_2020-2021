<?php
include "headerAFooter.php";
hlavicka("Epizody");
?>
<div id="obsah">
<h1>Epizody</h1>
<ul class="sezona">
<li>
<?php
$pripojeni = Pripojeni::pripojeniDatabaze();
$dotaz ="SELECT sezona FROM epizody GROUP BY sezona" ;
$res =  $pripojeni->query($dotaz);

while($row = $res->fetch_assoc()) {
$sezona = $row["sezona"];
echo "<a href='epizody_sezona.php?sezona=".$sezona."' class='tlacitko li'>Sezona $sezona</a>";
}
?>
</li>
</ul>
<br>
<?php
$sql1 = "SELECT* from epizody";
$query = $pripojeni->query($sql1);

if(!$query) {
   echo('Nelze vybrat záznamy:' . mysqli_error($pripojeni));
   exit();
}
$nazev = $ang_nazev = $popis = $sezona = $epizoda = "";
while($row = $query->fetch_assoc()) {
    $obrazek= $row["obrazek"];
    $id_ep = $row["id_ep"];
?>
    <li class="ep">
        <?php
        echo "<img src='obrazky/epizody/$obrazek' class='img-box' alt='obrazek'>";
        ?>
        <div class="epizody">
            <h3><?php echo $row["nazev"]; ?></h3>
            <span><?php echo $row["ang_nazev"]; ?></span><br>
            <span><?php echo $row["popis"]; ?></span>
            <p>Sezona: <?php echo $row["sezona"]; ?> Epizoda: <?php echo $row["epizoda"]; ?> </p>
            <?php
            echo "<a href='detail_epizoda.php?id_ep=".$id_ep."' class='button'>Detail epizody</a>";
            ?>
            <?php
            if ((isset($_SESSION['prava']) && ('admin' == $_SESSION['prava']))) {
                echo "<a href='editace/edit_epizoda.php?update=" . $id_ep . "' class='button'>Editace epizody</a>";
             ?>
                <a <?php echo "href='smazani/smaz_epizodu.php?id_ep=".$id_ep."';" ?> class='button'  onclick="return confirm('Chcete opravdu smazat tuto epizodu?')">Smazání epizody</a><br><br>
            <?php
            }?>
        </div>
    </li> <br><br>
<?php
}
$pripojeni->close();
?>
</div>
<?php
paticka();
