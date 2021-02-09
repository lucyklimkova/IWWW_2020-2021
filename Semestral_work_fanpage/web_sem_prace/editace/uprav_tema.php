<?php
include "../headerAFooter.php";
hlavicka("Editace tématu");

$pripojeni = Pripojeni::pripojeniDatabaze();

if (isset($_GET['submit'])) {
$id = vstup($_GET['id_fo']);
$jmeno =  $_SESSION['usr_jmeno'];
$prijmeni =  $_SESSION ['usr_prijmeni'];
$tema = vstup($_GET['tema']);            
$text = vstup($_GET['text']);
$id_uziv= $_SESSION['usr_id'];

$query ="UPDATE forum_otazky set
        jmeno='$jmeno', prijmeni='$prijmeni', tema='$tema',
        text='$text', datetime=NOW(), id_uziv='$id_uziv' WHERE id_fo='$id'";
$result = $pripojeni->query($query);
}

$sql = "SELECT id_fo, tema, text FROM forum_otazky";
$result = $pripojeni->query($sql);

if (isset($_GET['zmena'])) {
$update = vstup($_GET['zmena']);

$res= "SELECT * from forum_otazky WHERE id_fo='$update'";
$result = $pripojeni->query($res);

while ($row1 = $result->fetch_assoc()) {
?> 
<div id="obsah">  
<?php if (isset($_SESSION['usr_id'])) { ?>
<form role="form" method="get">
<input class="input" type="hidden" name="id_fo" value="<?php echo $row1['id_fo']; ?>"/>
<table class="t1">
<tr class="tr1"><td colspan="3" class="tr1"><strong>Vytvoření nového tématu</strong> </td></tr>
<tr class="tr1">
<td class="tr1"><strong>Téma:</strong></td>
<td class="tr1"><input name="tema" type="text" id="tema" size="50" value="<?php echo $row1['tema']; ?>"/></td>
</tr>
<tr class="tr1">
<td class="tr1"><strong>Obsah:</strong></td>
<td class="tr1"><textarea name="text" cols="60" rows="5" id="text"><?php echo $row1['text']; ?></textarea></td>
</tr>
<tr class="tr1">
<td class="tr1"></td>
<td class="tr1"><input type="submit" name="submit" value="Uprav"> <input type="reset" name="Submit2" value="Resetuj">
</td>
</tr>
</table>
</form>
</div>
<?php 
  }
 }
}

if (isset($_GET['submit'])) { 
?>
<div id="obsah">  
<h2>Téma upraveno</h2> 
<div><br><br>
<Span>Upravili jste úspěšně téma!<a href="diskuze.php">Zpět na diskuzi</a>.</span></div>
</div>
<?php
}
$pripojeni->close();
paticka();
?>