<?php
include "headerAFooter.php";
hlavicka("Nastavení");
?>
 <div id="obsah">  
 <h2>Administrace</h2> 
 <?php if (isset($_SESSION['usr_id'])) { ?>
 <p>Jste přihlášen/na jako: <b> <?php echo $_SESSION['usr_jmeno']; ?> <?php echo $_SESSION['usr_prijmeni']; ?>  </b></p>
 <p>Vítejte v nastavení svého účtu, máte tyto možnosti:</p>

<?php
$id_uzivatele = $_SESSION['usr_id'];

?> 
<a href="smazani/smaz_uzivatel.php" class="tlacitko">Smazání účtu</a><br>
<a href="zmena_hesla.php" class="tlacitko" >Změna hesla</a><br>
<a href="ucet.php" class="button2 right">Zpět</a><br> 
<?php   
 } 
else {
?>
  <p>Sem nemáte bez příhlášení přístup!</p>
<?php
}
?>
  </div>
<?php
paticka(); ?>


