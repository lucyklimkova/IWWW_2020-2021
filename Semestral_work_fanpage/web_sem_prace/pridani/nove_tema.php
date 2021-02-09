<?php
include "../headerAFooter.php";
hlavicka("Diskuze");
?>
<div id="obsah">  
<?php if (isset($_SESSION['usr_id'])) { ?>
<form id="form1" name="form1" method="post" action="pridej_tema.php">
<table class="table">
<tr class="tr1"><td colspan="3" class="tr1"><strong>Vytvoření nového tématu</strong> </td></tr>
<tr class="tr1">
<td class="tr1"><strong>Téma:</strong></td>
<td class="tr1"><input name="tema" type="text" id="tema" size="50" /></td>
</tr>
<tr class="tr1">
<td class="tr1"><strong>Obsah:</strong></td>
<td class="tr1"><textarea name="text" cols="50" rows="3" id="text"></textarea></td>
</tr>
<tr class="tr1">
<td class="tr1"></td>
<td class="tr1"><input type="submit" name="Submit" value="Přidej"> <input type="reset" name="Submit2" value="Resetuj">
</td>
</tr>
</table>
<a href="../diskuze.php" class="button2 right">Zpět na diskuzi</a>
</form>
<?php
} else {
?>
    <p>Nejste přihlášeni! Nemůžete přidávat témata! </p>"
<?php
}
?>
</div>
<?php
paticka();
?>