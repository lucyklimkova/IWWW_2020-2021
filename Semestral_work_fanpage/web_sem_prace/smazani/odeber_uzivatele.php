<?php
include "../headerAFooter.php";
hlavicka("Odebrání uživatele");

$pripojeni = Pripojeni::pripojeniDatabaze();
$sql1 = "SELECT id, jmeno, prijmeni, email FROM uzivatele";
$res = $pripojeni->query($sql1);
 
if(!$res){
   echo('Nelze vybrat záznamy:' . $pripojeni->error);
   exit();
}
?>
 <div id="obsah">
 <h1>Smazání uživatele</h1>
<?php
 if (isset($_SESSION['prava']) && ('admin' == $_SESSION['prava'])) { 
 $id_uzivatele = $_SESSION['usr_id'];

 while($row = $res->fetch_assoc()) {
 $id = $row["id"];
?>
     <div>
         <h3> <?php echo $row["email"]; ?> </h3>
         <p><b>Jméno a příjmení: </b> <?php echo $row["jmeno"]; ?> <?php echo $row["prijmeni"]; ?> </p>
         <a <?php echo "href='smaz_uzivatel_admin.php?id=".$id."';" ?> class='tlacitko'  onclick="return confirm('Chcete opravdu smazat totoho uživatele?')">Smazat účet tohoto uživatele</a><br>
     </div>
     <br><br>
<?php
 }
$pripojeni->close();
 } else {
?>
  <p> Nejste přihlášen/na anebo nemáte administrátorská práva! </p>
<?php
}
?>
 <a href="../administrace.php" class="button2 right">Zpět</a><br>
 </div>
<?php
paticka();
