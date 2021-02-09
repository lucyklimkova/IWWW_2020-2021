<?php
include "headerAFooter.php";
hlavicka("Detail epizody");
?>
<div id="obsah">  
<h1>Detail epizody</h1>
<?php
$pripojeni = Pripojeni::pripojeniDatabaze();

$id_ep = vstup($_GET['id_ep']);

$sql = "SELECT nazev, ang_nazev, obrazek, popis, sezona, epizoda FROM epizody WHERE id_ep=$id_ep 
        ORDER BY epizoda ";
                
$result = $pripojeni->query($sql);
$nazev = $ang_nazev = $popis = $sezona = $epizoda = "";
 if($result) {
 while($row = $result->fetch_assoc()) {
     $obrazek = $row["obrazek"];
     $nazev = $row["nazev"];
     $ang_nazev = $row["ang_nazev"];
     $popis = $row["popis"];
     $sezona = $row["sezona"];
     $epizoda = $row["epizoda"];
     echo "<img src='/Muj%20web/obrazky/epizody/$obrazek' class='img-box' alt='obrazek'>";
 ?>
    <div class="postavy">
        <h2><?php echo $nazev; ?></h2>
        <span><?php echo $ang_nazev; ?></span>
        <p> <?php echo $popis; ?>  </p>
        <p><b>Sezona:</b> <i><?php echo $sezona; ?></i> <b>Epizoda:</b> <i><?php echo $epizoda; ?></i></p>
        <a href="epizody.php" class="button2 right">Zpět na všechny epizody</a>
    </div>
    <br><br>

<?php
     }
 }
$pripojeni->close()
?>
</div>
<?php
paticka(); ?>

