<?php
ob_start();
include "headerAFooter.php";
hlavicka("Přihlášení");

if(isset($_SESSION['usr_id'])!="") {
	header("Location: ucet.php");
}

if (isset($_POST['login'])) {

	$email = vstup($_POST['email']);
	$heslo = vstup($_POST['heslo']);
  
    if (($email=="") or ($heslo=="")) {
        $vyplneni_err = "Nejsou vyplňeny všechny údaje";
        Pripojeni::alert($vyplneni_err);
    }
    $msg = Pripojeni::prihlaseni($email, $heslo);
}
?>
  <div id="obsah">  
   <form role="form" action="prihlaseni.php" method="post">
   <h1>Přihlášení</h1>                         
   <label for="email">E-mail:</label><br>
   <input type="text" name="email" maxlength="100" required><br><br>
   <label for="heslo">Heslo:</label><br>
   <input type="password" name="heslo" required><br><br>
   <input type="submit" name="login" value="Přihlásit se" />
   <br>
   <p>Pokud nemáte účet, <a href="registrace.php">registrujte se zde</a>.</p>
   <?php if (isset($msg)) {  echo "<div class='error'>$msg</div>"; } ?> <br>
   </form>
   </div>

<?php
paticka();
ob_end_flush();
?>
