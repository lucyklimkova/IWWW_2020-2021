<?php
include "headerAFooter.php";
hlavicka("Změna hesla");

$pripojeni = Pripojeni::pripojeniDatabaze();
        $error = false;
		if(isset($_POST['submit'])) {
		$heslo= vstup($_POST['heslo']);
		$nove_heslo= vstup($_POST['nove_heslo']); 
		$opak_heslo= vstup($_POST['opak_heslo']);
        $id_uzivatele= $_SESSION['usr_id'];
    
    if(password_hash($heslo,PASSWORD_DEFAULT) == $_SESSION['usr_heslo'])  {
        if(empty($nove_heslo)) {
            $error = true;
            $heslo_err = "Nezadali jste nové heslo!";
          }
        else if($nove_heslo != $opak_heslo) {
              $error = true;
	          $hesla_err = "Hesla se neshodují!";
	        } 
        else if(strlen($nove_heslo) < 6) {
		      $error = true;
		      $delka = "Nové heslo není dostatečně dlouhé! Zkuste to znovu.";
        }
        else {
        $password = password_hash($nove_heslo,PASSWORD_DEFAULT);
        if (!$error) {
          $query ="UPDATE uzivatele SET heslo='".$password."' WHERE id = '".$id_uzivatele."' ";
          $result = $pripojeni->query($query);
        
        if($result) {
          Pripojeni::alert("Heslo bylo úspěšně změněno, nyní budete odhlášeni!");
          session_destroy();
          header("Location: prihlaseni.php");
                 }
            }
        }
}
else {
   $errmsg = "Zadali jste špatné heslo!";
 } 
} ?>
   <div id="obsah">  
   <?php if (isset($_SESSION['usr_id'])) { ?> 
   <form role="form" action="zmena_hesla.php" method="post">
   <h1>Změna hesla</h1> 
   <label for="stare_heslo">Staré heslo:</label> <br>
   <input type="password" name="heslo" /> <?php if (isset($errmsg)) { echo  " <span class='error'>$errmsg</span>"; } ?> 
   <br><br>    
   <label for="nove_heslo">Nové heslo:</label><br>
   <input type="password" name="nove_heslo" />    <?php if (isset($heslo_err)) { echo  " <span class='error'>$heslo_err</span>"; } ?>
   <br><br>   
   <label for="nove_heslo">Nové heslo znovu:</label><br>
   <input type="password" name="opak_heslo" />  <?php if (isset($hesla_err)) { echo  " <span class='error'>$hesla_err</span>"; } ?>
   <br><br> 
   <input type="submit"  name="submit"  value="Změnit heslo"/><br><br>
   <?php if (isset($delka)) { echo  " <span class='error'>$delka</span>"; } ?>
   <a href="nastaveni.php" class="button2 right">Zpět</a><br> 
  </form>
<?php }
else {
?>
<p> Nejste přihlášen/na! </p>
<?php
 }
?>
   </div>
<?php
paticka();
?>