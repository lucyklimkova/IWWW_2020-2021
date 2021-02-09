<?php
include "headerAFooter.php";
hlavicka("Přidat postavu");

if (isset($_POST['submit'])){

    $pripojeni = Pripojeni::pripojeniDatabaze();
    $error = false;
   $photo = vstup($_FILES['photo']['name']);
   $target = basename( $_FILES['photo']['name']);
   $temp = explode(".", $_FILES["photo"]["name"]);
   $newfilename = round(microtime(true)) . '.' . end($temp);
    
$jmeno = vstup($_POST['jmeno']);
$herec = vstup($_POST['herec']);
$prislusnost = vstup($_POST['prislusnost']);
$strucny_popis = vstup($_POST['strucny_popis']);
$obrazek = $newfilename;
$id_uziv= $_SESSION['usr_id'];

if(empty($jmeno) or empty($herec) or empty($prislusnost) or empty($strucny_popis)) {
    $error = true;
    $vyplneni_err = "Nevyplnili jste všechna pole!";
}

if (!$error) { 
$sql = "INSERT INTO postavy(jmeno, herec, prislusnost, obrazek, strucny_popis, id_uziv)
        VALUES
       ('$jmeno','$herec', '$prislusnost', '$obrazek', '$strucny_popis', '$id_uziv')";

$vysledek = $pripojeni->query($sql);

if(move_uploaded_file($_FILES["photo"]["tmp_name"], "../obrazky/epizody/".$newfilename)) {
$pridano = "Obrázek s názvem ".$newfilename. " byl úspěšně nahrán do adresáře";
} 
else {
$nepridano = "Nastal problém s nahráváním obrázku!";  
}

if($vysledek){ 
    $succzprava = "Postava přidána";
 }
}
else {
   $errzprava = "Nepodařilo se přidat postavu";
 }
}

?> 
  <div id="obsah">  
   <?php if (isset($succzprava)) { echo  " <div class='vypis'>$succzprava</div>"; } 
    if (isset($errzprava)) { echo "<div class='error'>$errzprava</div>"; } 
    if (isset($pridano)) { echo  " <div class='vypis'>$pridano</div>"; } 
    if (isset($nepridano)) { echo "<div class='error'>$nepridano</div>"; } 
    if (isset($vyplneni_err)) { echo "<div class='error'>$vyplneni_err</div>"; }?>
  <h2>Přidat postavu</h2> 
  <?php if (isset($_SESSION['prava']) && ($_SESSION['prava'] == 'admin')) { ?> 
  Prosím vyplňte všechny pole! <hr> 
  <form role="form" action="add_postava.php" method="POST" enctype="multipart/form-data" >
  Jméno:<br>
  <input type="text" name="jmeno"/><br> <br>
  Herec:<br>
  <input type="text" name="herec"/><br><br>
  Příslušnost:<br>
  <input type="text" name="prislusnost"/><br><br>
  Obrázek: <input type="file" name="photo">   <input type="hidden" name="size" value="1000000"><br>
  <p>Obrázky pouze ve formátu jpeg a gif, maximální velikost je 1Mb.</p> 
  Stručný popis: <br>
  <textarea rows="20" cols="50" name="strucny_popis"></textarea><br><br>
  <input name="submit" type="submit" value="Přidej postavu">
  <a href="../ucet.php" class="button2 right">Zpět</a><br>
  </form>
<?php } else { ?>
 <p> Nejste přihlášeni, vstup nepovolen</p>
<?php } ?>
</div>
<? paticka(); ?>             