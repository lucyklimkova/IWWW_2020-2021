<?php
include "headerAFooter.php";
hlavicka("Administrace webu");

?>
 <div id="obsah">  
 <h2>Administrace</h2> 
<?php
 if (isset($_SESSION['usr_id'])) {
 $prava= $_SESSION['prava']; 
  
  if ($prava== 'admin') { ?> 
 <p>Vítejte v administraci tohoto webu!</p>
 <p>Máte tyto možnosti:</p>
 <a href="pridani/add_epizoda.php" class="button3" >Přidání epizody</a><br>
 <a href="pridani/add_postava.php" class="button3" >Přidání postavy</a><br>
 <a href="pridani/add_herec.php" class="button3" >Přidání herce</a><br>
 <a href="smazani/odeber_novinky.php" class="button3" >Odebrání novinek</a><br>
 <a href="smazani/odeber_uzivatele.php" class="button3" >Správa uživatelů</a><br>
 <a href="ucet.php" class="button2 right">Zpět</a><br>
 
<?php } else { ?>
<p> Nemáte administrátorská práva! </p>
<?php 
 }  
}  else { ?>
 <p> Nejste přihlášen/na a nebo nemáte administrátorská práva! </p>
 <?php } ?>
</div>     
<? paticka(); ?>


