<?php
include "../headerAFooter.php";
hlavicka("Editace");

$pripojeni = Pripojeni::pripojeniDatabaze();

if (isset($_GET['submit'])) {

$id_novinky = vstup($_GET['id_novinky']);
$nadpis = vstup($_GET['nadpis']);
$popisek = vstup($_GET['popisek']);
$obsah = vstup($_GET['obsah']);
$uzivatel= $_SESSION['usr_id']; 

$query ="UPDATE novinky SET
        nadpis='$nadpis', popisek='$popisek', obsah='$obsah',
        uzivatel='$uzivatel', cas=NOW() WHERE id_novinky='$id_novinky'";
$result = $pripojeni->query($query);
}

if (isset($_GET['update'])) {
$update = vstup($_GET['update']);

$res= "SELECT * FROM novinky WHERE id_novinky='$update'";
$result = $pripojeni->query($res);

while ($row1 = $result->fetch_assoc()) {
?>
    <div id="obsah">
        <h2>Upravit novinku</h2>
        <hr>
        <?php if (isset($_SESSION['usr_id'])) { ?>
        <form method="get" name="form" onSubmit="return check_new()">
            <input class="input" type="hidden" name="id_novinky" value="<?php echo $row1['id_novinky']; ?>"/>
            <label for="nadpis">Nadpis</label><br>
            <input class="input" type="text" name="nadpis" value="<?php echo $row1['nadpis']; ?>"/><br> <br>
            <label for="popisek">Popisek</label><br>
            <input class="input" type="text" name="popisek" value="<?php echo $row1['popisek']; ?>"/><br><br>
            <label for="obsah">Obsah</label><br>
            <textarea rows="20" cols="50" name="obsah" id="myTextarea"><?php echo $row1['obsah'];  ?></textarea><br><br>
            <input name="submit" type="submit" value="Edituj novinku">
        </form>
    </div>
    <script type="text/javascript" src="js/overeni.js"></script>
<?php
  }
 }
}

if (isset($_GET['submit'])) {
   $id_novinky = vstup($_GET['id_novinky']);
?>
    <div id="obsah">
        <h2>Upravení novinky</h2>
        <div><br><br>
            <span>Novinka byla úspěšně upravena, můžete se na ni podívat zde:<a href="detail_novinka.php?id_novinky=<?php echo $id_novinky ?>">Detail novinky</a></span></div>
    </div>
<?php
}
$pripojeni->close();
paticka();
