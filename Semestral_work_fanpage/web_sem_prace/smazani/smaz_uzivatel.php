<?php
include "../headerAFooter.php";
hlavicka("Smazat");

$pripojeni = Pripojeni::pripojeniDatabaze();
if(isset($_POST['submit'])) {
    $heslo= vstup($_POST['heslo']);
    $id_uzivatele= $_SESSION['usr_id'];
    $password = password_hash($heslo,PASSWORD_DEFAULT);

    
    if((isset($_SESSION['prava']) && ('admin' != $_SESSION['prava']))) {
        $query ="DELETE FROM uzivatele WHERE id = '$id_uzivatele' AND heslo = '$password'";
        $result = $pripojeni->query($query);

        $sql ="DELETE FROM novinky WHERE uzivatel = '$id_uzivatele'";
        $res = $pripojeni->query($sql);
        session_destroy();
        header("Location: registrace.php");
  }
  else {   
      $errmsg = "Nepodařilo se odstranit účet!";
 }
} 
?>
   <div id="obsah">  
   <?php if (isset($_SESSION['usr_id'])) { ?> 
   <form role="form" action="smaz_uzivatel.php" method="post">
   <h1>Smazání účtu</h1> 
   <label for="heslo">Vaše heslo:</label><br>
   <input type="password" name="heslo" /> 
   <br><br>    
   <input type="submit"  name="submit"  value="Smazat účet"/><br><br>
   <?php if (isset($errmsg)) { echo  " <span class='error'>$errmsg</span>"; } ?><br>
   <a href="../ucet.php" class="button2 right">Zpět</a><br>
  </form>
 
<?php
} else { ?>
 <p> Nejste přihlášen/na! </p>
<?php  }
$pripojeni->close();
?>
 </div>
<? paticka();
?>