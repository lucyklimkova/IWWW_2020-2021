<?php
include "../headerAFooter.php";
hlavicka("Editace");

$pripojeni = Pripojeni::pripojeniDatabaze();

if (isset($_GET['submit'])) {

    $id_ep = vstup($_GET['id_ep']);
    $nazev = vstup($_GET['nazev']);
    $ang_nazev = vstup($_GET['ang_nazev']);
    $obrazek = vstup($_GET['obrazek']);
    $popis = vstup($_GET['popis']);
    $sezona = vstup($_GET['sezona']);
    $epizoda = vstup($_GET['epizoda']);
    $uzivatel = $_SESSION['usr_id'];

    $query ="UPDATE epizody SET
        nazev='$nazev', ang_nazev='$ang_nazev', obrazek='$obrazek', 
        popis='$popis', sezona = '$sezona', epizoda = '$epizoda', id_uziv = '$uzivatel' WHERE id_ep='$id_ep'";
    $result = $pripojeni->query($query);
}

if (isset($_GET['update'])) {
    $update = vstup($_GET['update']);

    $res= "SELECT * FROM epizody WHERE id_ep='$update'";
    $result = $pripojeni->query($res);

    while ($row1 = $result->fetch_assoc()) {
        ?>
        <div id="obsah">
            <h2>Upravit epizodu</h2>
            <hr>
            <?php if (isset($_SESSION['usr_id'])) { ?>
            <form method="get" name="form" onSubmit="return check_new()">
                <input class="input" type="hidden" name="id_ep" value="<?php echo $row1['id_ep']; ?>"/>
                <label for="nazev">Název</label><br>
                <input class="input" type="text" name="nazev" value="<?php echo $row1['nazev']; ?>"/><br> <br>
                <label for="ang_nazev">Anglický název</label><br>
                <input class="input" type="text" name="ang_nazev" value="<?php echo $row1['ang_nazev']; ?>"/><br> <br>
                <label for="obrazek">Obrázek</label><br>
                <input type="file" name="obrazek" value="<?php echo $row1['obrazek']; ?>"> <input type="hidden" name="size" value="1000000"><br>
                <p>Obrázky přidávejte pouze ve formátu jpeg a gif, maximální velikost je 1MB.</p>
                <label for="popis">Popis</label><br>
                <textarea rows="20" cols="50" name="popis"><?php echo $row1['popis'];  ?></textarea><br><br>
                <label for="sezona">Sezóna</label><br>
                <input type="number" name="sezona" value="<?php echo $row1['sezona']; ?>"/><br> <br>
                <label for="epizoda">Epizoda</label><br>
                <input type="number" name="epizoda" value="<?php echo $row1['epizoda']; ?>"/><br> <br>
                <input name="submit" type="submit" value="Edituj epizodu">
            </form>
        </div>
        <script type="text/javascript" src="js/overeni.js"></script>
        <?php
    }
    }
}

if (isset($_GET['submit'])) {
    ?>
    <div id="obsah">
        <h2>Upravení epizody</h2>
        <div><br><br>
            <span>Epizoda byla úspěšně upravena, můžete se vrátit zpět na přehled epizod: <a href="../epizody.php">ZDE</a>.</span></div>
    </div>
    <?php
}
$pripojeni->close();
paticka();
