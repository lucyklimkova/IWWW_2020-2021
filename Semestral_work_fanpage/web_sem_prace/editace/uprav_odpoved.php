<?php
include "../headerAFooter.php";
hlavicka("Editace odpovědi");

$pripojeni = Pripojeni::pripojeniDatabaze();

$otazka_id = '';
if (isset($_GET['submit'])) {
$id_fod = vstup($_GET['id_fod']);
$otazka_id =  vstup($_GET['otazka_id']);
$od_jmeno = $_SESSION['usr_jmeno'];
$od_prijmeni = $_SESSION ['usr_prijmeni'];
$od_odpoved = vstup($_GET['od_odpoved']);
$id_uziv= $_SESSION['usr_id'];

$query ="UPDATE forum_odpovedi SET
         otazka_id='$otazka_id', od_jmeno='$od_jmeno', 
         od_prijmeni='$od_prijmeni', od_odpoved='$od_odpoved', 
         od_datetime=NOW(), id_uziv='$id_uziv' 
         WHERE id_fod='$id_fod'";
$result = $pripojeni->query($query);
}

$sql = "SELECT id_fod, otazka_id, od_odpoved FROM forum_odpovedi";
$result = $pripojeni->query($sql);

if (isset($_GET['update'])) {
$update = vstup($_GET['update']);

$res= "SELECT * FROM forum_odpovedi WHERE id_fod='$update'";
?>
<div id="obsah">
<?php
$result = $pripojeni->query($res);
while ($row1 = $result->fetch_assoc()) {
if (isset($_SESSION['usr_id'])) {
?>
    <br>
    <form role="form" name="form" method="get">
        <input class="input" type="hidden" name="id_fod" value="<?php echo $row1['id_fod']; ?>"/>
        <input class="input" type="hidden" name="otazka_id" value="<?php echo $row1['otazka_id']; ?>"/>
        <table class="t1">
            <tr>
                <td><strong>Odpověď</strong></td>
                <td><textarea cols="35" rows="3" name="od_odpoved"><?php echo $row1['od_odpoved']; ?></textarea></td>
                <td></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td><input name="submit" type="submit" value="Uprav"> <input type="reset" name="Submit2" value="Resetuj"></td>
            </tr>
        </table>
    </form>
</div>
<?php
         }
    }
}
$pripojeni->close();
if (isset($_GET['submit'])) {
?>
<div id="obsah">
    <div>
        <h2>Odpověď upravena</h2>
        <div><br><br>
            <span>Upravili jste úspěšně odpověď! <a href="zobraz_tema.php?id=<?php echo $otazka_id ?>">Zobrazte si vaši odpověď</a>.</span></div>
    </div>
</div>
<?php
 }
paticka();
