<?php
include "headerAFooter.php";
hlavicka("Epizody");

$pripojeni = Pripojeni::pripojeniDatabaze();
$sezona = vstup($_GET['sezona']);

$sql = "SELECT id_ep, nazev, ang_nazev, obrazek, popis, sezona, epizoda FROM epizody
         WHERE sezona = $sezona
         LIMIT 25";
$result = $pripojeni->query($sql);
    
if(!$result){
   echo('Nelze vybrat záznamy:' . mysqli_error($pripojeni));
   exit();
}

?>
  <div id="obsah">
  <h1>Epizody - Sezona <?php echo $sezona; ?></h1>
<?php
while($row = mysqli_fetch_assoc($result)) {
   $id_ep = $row["id_ep"];
   $obrazek = $row["obrazek"];
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
        </div>
    </li>
    <br><br>
<?php
}
$pripojeni->close();
?>
 <a href='epizody.php' class='button2 right'>Zpět na všechny epizody</a>
 </div>
<?php
paticka();


