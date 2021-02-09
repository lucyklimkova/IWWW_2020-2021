<?php
ob_start();
include "headerAFooter.php";
hlavicka("Registrace");

if(isset($_SESSION['usr_id'])) {
	header("Location: ucet.php");
}


if (isset($_POST['submit'])) {
    $jmeno = vstup($_POST['jmeno']);
    $prijmeni = vstup($_POST['prijmeni']);
    $email = vstup($_POST['email']);
    $heslo = vstup($_POST['heslo']);
    $over_heslo = vstup($_POST['over_heslo']);
    $prava = vstup($_POST['prava']);
    $error = false;

    if (($jmeno == "") or ($prijmeni == "") or ($email == "") or ($heslo == "") or ($over_heslo == "")) {
        $error = true;
        $vyplneni_err = "Nejsou vyplňeny všechny údaje";
        Pripojeni::alert($vyplneni_err);
    }

    //znaky abecedy plus háčky a čárky
    if (!preg_match("/^[A-ZÁČĎÉĚÍŇÓŘŠŤŮÚÝŽ]{1}[a-záčďéěíňóřšťůúýž]+$/u", $jmeno)) {
        $error = true;
        $name_err = "Jméno může obsahovat pouze znaky abecedy";
        Pripojeni::alert($name_err);
    }

    if (!preg_match("/^[A-ZÁČĎÉĚÍŇÓŘŠŤŮÚÝŽ]{1}[a-záčďéěíňóřšťůúýž]+$/u", $prijmeni)) {
        $error = true;
        $lastname_err = "Příjmení může obsahovat pouze znaky abecedy";
        Pripojeni::alert($lastname_err);
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $email_err = "Prosím napište validní Emailovou adresu";
        Pripojeni::alert($email_err);
    }

    if (strlen($heslo) < 6) {
        $error = true;
        $heslo_err = "Špatně vyplňené heslo";
        Pripojeni::alert($heslo_err);
    }
    if ($heslo != $over_heslo) {
        $error = true;
        $hesla_err = "Hesla se neshodují";
        Pripojeni::alert($hesla_err);
    }

    if ($error == false) {
        $errormsg = Pripojeni::registrace($jmeno,$prijmeni,$email,$heslo,$prava);
    }
}
?>
  <div id="obsah">  
  <form role="form" action="registrace.php" method="post" name="form" onSubmit="return overit()">
   <h1>Registrace</h1> 
   <i class="upozor">Pokud chcete mít možnost přidávat novinky, musíte se registrovat!</i>  <br>
   <i class="upozor">Jméno a příjmení zadávejte s velkým písmenem na začátku a email ve správném formátu, děkujeme!</i><br><br>
   <input type="hidden" name="prava" value="user" />
   <label for="jmeno">Jméno <br>
   <input type="text" name="jmeno" required></label><br>
   <br><br>   
   <label for="jmeno">Příjmení <br>
   <input type="text" name="prijmeni" required></label><br>
   <br><br>
   <label for="email">Email:<br>
   <input type="text" name="email" value="@" required></label><br>
   <br><br>  
   <label for="heslo">Heslo:<br>
   <input type="password" name="heslo" id="heslo" required></label><br>
   <i class="upozor">Heslo musí obsahovat minimálně 6 znaků</i><br><br>   
   <label for="heslo_overeni">Ověření hesla: <br>
   <input type="password" name="over_heslo" id="over_heslo" required></label><br>
   <br><br>
   
   <input type="submit" name="submit" value="Registrovat se" />
   <br><br>
   <?php if (isset($errormsg)) { echo "<div class='error'>$errormsg</div><br>"; } ?>
  </form>
  </div>
<?php
paticka();
ob_end_flush();
?>
