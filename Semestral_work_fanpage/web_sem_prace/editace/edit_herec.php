<?php
include "../headerAFooter.php";
hlavicka("Editace");

$pripojeni = Pripojeni::pripojeniDatabaze();

if (isset($_GET['submit'])) {

    $id_her = vstup($_GET['id_her']);
    $jmeno = vstup($_GET['jmeno']);
    $postava = vstup($_GET['postava']);
    $obrazek = vstup($_GET['obrazek']);
    $strucny_popis = vstup($_GET['strucny_popis']);
    $uzivatel = $_SESSION['usr_id'];

    $query ="UPDATE herci SET
        jmeno='$jmeno', postava='$postava', obrazek='$obrazek',
        strucny_popis='$strucny_popis', id_uziv = '$uzivatel' WHERE id_her='$id_her'";
    $result = $pripojeni->query($query);
}

if (isset($_GET['update'])) {
    $update = vstup($_GET['update']);

    $res= "SELECT * FROM herci WHERE id_her='$update'";
    $result = $pripojeni->query($res);

    while ($row1 = $result->fetch_assoc()) {
        ?>
        <div id="obsah">
            <h2>Upravit herce</h2>
            <hr>
            <?php if (isset($_SESSION['usr_id'])) { ?>
            <form method="get" name="form" onSubmit="return check_new()">
                <input class="input" type="hidden" name="id_her" value="<?php echo $row1['id_her']; ?>"/>
                <label for="jmeno">Jméno</label><br>
                <input class="input" type="text" name="jmeno" value="<?php echo $row1['jmeno']; ?>"/><br> <br>
                <label for="postava">Postava</label><br>
                <input class="input" type="text" name="postava" value="<?php echo $row1['postava']; ?>"/><br><br>
                <label for="obrazek">Obrázek</label><br>
                <input type="file" name="obrazek" value="<?php echo $row1['obrazek']; ?>"> <input type="hidden" name="size" value="1000000"><br>
                <p>Obrázky přidávejte pouze ve formátu jpeg a gif, maximální velikost je 1MB.</p>
                <label for="strucny_popis">Stručný popis</label><br>
                <textarea rows="20" cols="50" name="strucny_popis"><?php echo $row1['strucny_popis'];  ?></textarea><br><br>
                <input name="submit" type="submit" value="Edituj herce">
            </form>
        </div>
        <script type="text/javascript" src="js/overeni.js"></script>
        <?php
    }
    }
}

if (isset($_GET['submit'])) {
    $id_her = vstup($_GET['id_her']);
    ?>
    <div id="obsah">
        <h2>Upravení herce</h2>
        <div><br><br>
            <span>Herec byl úspěšně upraven, můžete se vrátit zpět na přehled herců: <a href="herci.php">ZDE</a>.</span></div>
    </div>
    <?php
}
$pripojeni->close();
paticka();
