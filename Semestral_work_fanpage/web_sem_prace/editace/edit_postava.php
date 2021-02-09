<?php
include "../headerAFooter.php";
hlavicka("Editace");

$pripojeni = Pripojeni::pripojeniDatabaze();

if (isset($_GET['submit'])) {

    $id_pos = vstup($_GET['id_pos']);
    $jmeno = vstup($_GET['jmeno']);
    $herec = vstup($_GET['herec']);
    $prislusnost = vstup($_GET['prislusnost']);
    $obrazek = vstup($_GET['obrazek']);
    $strucny_popis = vstup($_GET['strucny_popis']);
    $uzivatel = $_SESSION['usr_id'];

    $query ="UPDATE postavy SET
        jmeno='$jmeno', herec='$herec', prislusnost ='$prislusnost', obrazek='$obrazek',
        strucny_popis='$strucny_popis', id_uziv = '$uzivatel' WHERE id_pos='$id_pos'";
    $result = $pripojeni->query($query);
}

if (isset($_GET['update'])) {
    $update = vstup($_GET['update']);

    $res= "SELECT * FROM postavy WHERE id_pos='$update'";
    $result = $pripojeni->query($res);

    while ($row1 = $result->fetch_assoc()) {
        ?>
        <div id="obsah">
            <h2>Upravit postavu</h2>
            <hr>
            <?php if (isset($_SESSION['usr_id'])) { ?>
            <form method="get" name="form" onSubmit="return check_new()">
                <input class="input" type="hidden" name="id_pos" value="<?php echo $row1['id_pos']; ?>"/>
                <label for="jmeno">Jméno</label><br>
                <input class="input" type="text" name="jmeno" value="<?php echo $row1['jmeno']; ?>"/><br> <br>
                <label for="herec">Herec</label><br>
                <input class="input" type="text" name="herec" value="<?php echo $row1['herec']; ?>"/><br><br>
                <label for="prislusnost">Příslušnost</label><br>
                <input class="input" type="text" name="prislusnost" value="<?php echo $row1['prislusnost']; ?>"/><br><br>
                <label for="obrazek">Obrázek</label><br>
                <input type="file" name="obrazek" value="<?php echo $row1['obrazek']; ?>"> <input type="hidden" name="size" value="1000000"><br>
                <p>Obrázky přidávejte pouze ve formátu jpeg a gif, maximální velikost je 1MB.</p>
                <label for="strucny_popis">Stručný popis</label><br>
                <textarea rows="20" cols="50" name="strucny_popis"><?php echo $row1['strucny_popis'];  ?></textarea><br><br>
                <input name="submit" type="submit" value="Edituj postavu">
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
        <h2>Upravení postavy</h2>
        <div><br><br>
            <span>Postava byla úspěšně upravena, můžete se vrátit zpět na přehled postav: <a href="postavy.php">ZDE</a>.</span></div>
    </div>
    <?php
}
$pripojeni->close();
paticka();
