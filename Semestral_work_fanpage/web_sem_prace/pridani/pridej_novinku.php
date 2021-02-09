<?php
include "../headerAFooter.php";
hlavicka("Novinka");

if (isset($_POST['submit'])) {
$pripojeni = Pripojeni::pripojeniDatabaze();
$error = false;

$nadpis = vstup($_POST['nadpis']);
$popisek = vstup($_POST['popisek']);
$obsah = vstup($_POST['obsah']);
$uzivatel= $_SESSION['usr_id']; 

if(empty($nadpis) or empty($popisek) or empty($obsah)) {
    $error = true;
    $vyplneni_err = "Nevyplnili jste všechna pole!";
    Pripojeni::alert($vyplneni_err);
}         
if (!$error) {  
$sql = "INSERT INTO novinky(nadpis, popisek, obsah, uzivatel, cas)
        VALUES
       ('$nadpis','$popisek', '$obsah', '$uzivatel', NOW())";
              
$res = $pripojeni->query($sql);
if($res){
    $errzprava = "Novinka byla úspěšně přidána, mužete napsat další anebo pokračovat v prohlížení stránek!";
    Pripojeni::alert($errzprava);
  }   
 } else {
    $succzprava = "Nepodařilo se přidat novinku!";
    Pripojeni::alert($succzprava);
  }
 }
?>
   <div id="obsah">
   <h2>Přidat novinku</h2> <hr>
   <?php if (isset($_SESSION['usr_id'])) { ?>
  <form action="pridej_novinku.php" method="post" name="form" id="form" onSubmit="return check_new()">
  <label for="nadpis">Nadpis</label><br>
  <input type="text" name="nadpis" /><br><br>
  <label for="popisek">Popisek</label><br>
  <input type="text" name="popisek" /><br><br>
  <label for="obsah">Obsah </label><br>
  <textarea rows="15" cols="45" name="obsah" id="myTextarea"></textarea><br><br>
  <input name="submit" type="submit" value="Přidej novinku">
  <a href="../ucet.php" class="button2 right">Zpět</a><br>
  </form>
  <script type="text/javascript" src="../js/overeni.js"></script>
<?php } else { ?>
 <p> Nejste přihlášeni, vstup nepovolen!</p>
<?php } ?> 
</div>
<? paticka(); ?>