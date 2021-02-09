<?php
include "../headerAFooter.php";
hlavicka("Diskuze");

$pripojeni = Pripojeni::pripojeniDatabaze();
$error = false;

$jmeno =  $_SESSION['usr_jmeno'];
$prijmeni =  $_SESSION ['usr_prijmeni'];
$tema = vstup($_POST['tema']);            
$text = vstup($_POST['text']);
$id_uziv= $_SESSION['usr_id'];
$vyplneni_err = "";

if(empty($tema) or empty($text)) {
  $error = true;
}
if (!$error) {  
$sql = "INSERT INTO forum_otazky(tema, text, jmeno, prijmeni, datetime, id_uziv) 
        VALUES ('$tema', '$text', '$jmeno', '$prijmeni', NOW(), '$id_uziv')";
$result = $pripojeni->query($sql);
?>
<div id="obsah">
<?php
if($result) {
 echo "Úspěšně jste vytvořili téma, podívejte se na své téma <a href='../diskuze.php'>v diskuzi</a>";
 }
}                              
else {
?>
 <p>Nepovedlo se vytvořit téma, nebyly vyplněny všechny údaje!</p>
 <p><a href='../nove_tema.php'>Znovu vytvořit téma</a></p>
<?php
}
$pripojeni->close();
?>
</div>
<?php
paticka();