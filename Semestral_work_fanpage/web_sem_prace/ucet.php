<?php
include "headerAFooter.php";
hlavicka("Váš Účet");
?>
 <div id="obsah">
 <h2>Váš účet</h2> 
 <?php if (isset($_SESSION['usr_id'])) { ?>
 <p>Vítejte! Vstoupili jste do vašeho účtu!</p>
 <p>Jste přihlášen/a jako: <b> <?php echo $_SESSION['usr_jmeno']; ?> <?php echo $_SESSION['usr_prijmeni']; ?> </b></p>
 <P>Máte tyto práva: <b><?php echo $_SESSION['prava']; ?></b></p>
 <p>Můžete dále pokračovat na výpis vašich novinek anebo můžete přidat novou novinku.</p>
 <p>V kategorii Nastavení účtu si můžete změnit heslo a nebo smazat svůj účet.</p>
  <a href="pridani/pridej_novinku.php" class="button3">Přidat novinku</a> <br>
  <a href="vypis_novinek.php" class="button3">Správa novinek</a> <br>
  <a href="odhlaseni.php" class="button3">Odhlásit se</a> <br>
  <a href="nastaveni.php" class="button3">Nastavení účtu</a> <br>

<?php 
 if (isset($_SESSION['prava']) && ('admin' == $_SESSION['prava'])) { ?>
 <p>V administraci webu můžete přidávat nové epizody, herce a postavy. Také máte možnost odstranit jakýkoliv článek a odebrat uživatele.</p>
 <a href="administrace.php" class="button3" >Administrace webu</a><br>
 <?php } else { ?>
 <p>Pokud chcete vstoup do Administrace webu, musíte požádat Administrátora o práva.</p>
 <?php 
 }  
} 
else {
?>
<p> Nejste přihlášen/na, vstup nepovolen!</p>
<?php
}
?>
</div>
<?php
paticka();


