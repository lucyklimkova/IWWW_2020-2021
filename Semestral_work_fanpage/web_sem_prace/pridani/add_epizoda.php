<?php
include "../headerAFooter.php";
hlavicka("Pridat epizodu");

if (isset($_POST['submit'])){
$pripojeni = Pripojeni::pripojeniDatabaze();
$error = false;

   $photo = vstup($_FILES['photo']['name']);
   $target = basename($photo);
   $temp = explode(".",  $_FILES["photo"]["name"]);
   $newfilename = round(microtime(true)) . '.' . end($temp);
   
$nazev = vstup($_POST['nazev']);
$ang_nazev =  vstup($_POST['ang_nazev']);
$popis =  vstup($_POST['popis']);
$sezona =  vstup($_POST['sezona']);
$epizoda =  vstup($_POST['epizoda']);
$id_uziv= $_SESSION['usr_id'];
$obrazek = $newfilename;

if(empty($nazev) or empty($ang_nazev) or empty($popis) or empty($sezona) or empty($epizoda)) {
            $error = true;
            $vyplneni_err = "Nevyplnili jste všechna pole!";
}         
if (!$error) { 
$sql = "INSERT INTO epizody(nazev, ang_nazev, obrazek, popis, sezona, epizoda, id_uziv)
        VALUES
       ('$nazev','$ang_nazev','$obrazek', '$popis', '$sezona', '$epizoda', '$id_uziv')";
$vysledek = $pripojeni->query($sql);

if(copy($_FILES["photo"]["tmp_name"], "../obrazky/epizody/".$newfilename)) {
$pridano = "Obrázek s názvem ".$newfilename." byl úspěšně nahrán do adresáře";
} 
else {
$nepridano = "Nastal problém s nahráváním obrázku!";  
}

if($vysledek){  
  $succzprava = "Epizoda přidána";
 }
}
else {
  $errzprava = "Nepodařilo se přidat epizodu"; 
 }                                                                                           
}
?>
   <div id="obsah">  
    <?php if (isset($succzprava)) { echo  " <div class='vypis'>$succzprava</div>"; } 
    if (isset($errzprava)) { echo "<div class='error'>$errzprava</div>"; } 
    if (isset($pridano)) { echo  " <div class='vypis'>$pridano</div>"; } 
    if (isset($nepridano)) { echo "<div class='error'>$nepridano</div>"; }
    if (isset($vyplneni_err)) { echo "<div class='error'>$vyplneni_err</div>"; }?>
   <h2>Přidat epizodu</h2>
   <?php if (isset($_SESSION['prava']) && ($_SESSION['prava'] == 'admin')) { ?> 
   Prosím vyplňte všechny pole! <hr> 
  <form role="form" action="add_epizoda.php" method="POST" enctype="multipart/form-data">
  Název:<br>
  <input type="text" name="nazev"/><br> <br>
  Anglický název:<br>
  <input type="text" name="ang_nazev"/><br><br>  
  Obrázek: <input type="file" name="photo">   <input type="hidden" name="size" value="1000000"><br> 
  <p>Obrázky pouze ve formátu jpeg a gif, maximální velikost je 1MB.</p>
  Sezona:<br>
  <input type="number" name="sezona"/><br><br>
  Epizoda:<br>
  <input type="number" name="epizoda"/><br><br>
  Popis:<br>
  <textarea rows="20" cols="50" name="popis"></textarea><br><br>
  <input name="submit" type="submit" value="Přidej epizodu">
  <a href="../ucet.php" class="button2 right">Zpět</a><br>
  </form>
<?php } else { ?>
 <p> Nemáte dostatečná práva, vstup nepovolen</p>
<?php } ?>
 </div>  
<?php  paticka(); ?>