<?php
include "../headerAFooter.php";
hlavicka("Diskuze");

$pripojeni = Pripojeni::pripojeniDatabaze();
$error = false;

$id = vstup($_POST['id']);
$id_uziv= $_SESSION['usr_id'];  
$od_jmeno = $_SESSION['usr_jmeno'];
$od_prijmeni = $_SESSION ['usr_prijmeni'];
$od_odpoved = vstup($_POST['od_odpoved']);
$vyplneni_err = "";

if(empty($od_odpoved)) {
    $error = true;
}
?>
   <div id="obsah">
<?php
if (!$error) {
  $sql2 = "INSERT INTO forum_odpovedi(otazka_id, od_jmeno, od_prijmeni, od_odpoved, od_datetime, id_uziv) 
           VALUES ('$id', '$od_jmeno', '$od_prijmeni', '$od_odpoved', NOW(), '$id_uziv')";
  $result2 = $pripojeni->query($sql2);

if($result2) {
?>
 <p>Odpověď byla přidána!</p><br>
<?php
    echo "<a href='../zobraz_tema.php?id=".$id."'>Podívej se na svou odpověď</a>";
 }
}
else {
?>
<p>Odpověď nebyla přidána, jelikož jste nevyplnili svou odpověď!</p>
<?php
 echo $vyplneni_err;
 echo "<p><a href='../zobraz_tema.php?id=".$id."'>Zkusit znovu napsat odpověď</a></p>";
}
$pripojeni->close();
?>
</div>
<?php
paticka();