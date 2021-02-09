<?php
include "headerAFooter.php";
hlavicka("Diskuze");
$pripojeni = Pripojeni::pripojeniDatabaze();

$id = vstup($_GET['id']);
$sql = "SELECT * FROM forum_otazky WHERE id_fo='$id' LIMIT 1";
$result = $pripojeni->query($sql);

$row = $result->fetch_array();

?>
    <div id="obsah">
    <table class="t1">
    <tr>
        <th colspan="2"><strong><?php echo $row['tema']; ?></strong></th>
    </tr>
    <tr>
        <td class="left"><strong>Příspěvek: </strong></td>
        <td class="left"><?php echo $row['text']; ?></td>
    </tr>
    <tr>
        <td class="left"><strong>Autor tématu: </strong></td>
        <td class="left"><?php echo $row['jmeno']; ?> <?php echo $row['prijmeni']; ?></td>
    </tr>
    <tr>
        <td class="left"><strong>Datum/čas: </strong></td>
        <td class="left"><?php echo $row['datetime']; ?></td>
    </tr>
    </table>
    <br><br>
<?php

$sql2 = "SELECT * FROM forum_odpovedi WHERE otazka_id='$id'";
$result2 = $pripojeni->query($sql2);
while($row = $result2->fetch_assoc()) {
$uzivatel = $row['id_uziv'];

?>
<table class="t1">
<tr>
<th colspan="2"><strong>Odpověď</strong></th>
</tr>
<tr>
<td class="left"><strong>Text: </strong></td>
<td class="left"><?php  echo $row['od_odpoved']; ?></td>
</tr>
<tr>
<td class="left"><strong>Autor odpovědi:</strong></td>
<td class="left"><?php  echo $row['od_jmeno']; ?> <?php  echo $row['od_prijmeni']; ?></td>
</tr>
<tr>
<td class="left"><strong>Datum/čas: </strong></td>
<td class="left"><?php  echo $row['od_datetime']; ?>
</tr>
<tr>
<td></td>
<td>
<?php if ((isset($_SESSION['usr_id']) && ($uzivatel == $_SESSION['usr_id'])) or (isset($_SESSION['prava']) && ('admin' == $_SESSION['prava']))) { ?>
<a href="smazani/smazat_odpoved.php?id_answer=<?php echo $row['id_fod']; ?>" class="tlacitko right" onclick="return confirm('Chcete opravdu smazat tuto odpověď?')">Smazat</a>
<a href="editace/uprav_odpoved.php?update=<?php  echo $row['id_fod']; ?>" class="tlacitko right">Upravit</a>
<?php  } else { ?>
</td>
<?php  } ?>
</tr>
</table>
<br>
<?php
}
$pripojeni->close();
if (isset($_SESSION['usr_id'])) {
?>
<br>
<form name="form1" method="post" action="pridej_odpoved.php">
<td>
<table class="t1">
<tr>
<td><strong>Odpověď</strong></td>
<td><textarea name="od_odpoved" cols="35" rows="3" id="od_odpoved"></textarea></td>
<td></td>
</tr>
<tr>
<td>&nbsp;</td>
<td><input name="id" type="hidden" value="<?php echo $id; ?>"></td>
<td>
    <input type="submit" name="Submit" class="tlacitko"  value="Přidej">
    <input type="reset" name="Submit2" class="tlacitko"  value="Resetuj">
</td>
</tr>
</table>
</td>
</form>
<?php } else { ?>
<p>Nemůžete odpovídat, dokud nejste přihlášeni!</p>
<?php  }  ?>
<a href="diskuze.php" class="button2 right">Zpět na diskuzi</a>
</div>
<?php
paticka();
?>


