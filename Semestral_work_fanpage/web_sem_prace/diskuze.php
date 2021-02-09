<?php
include "headerAFooter.php";
hlavicka("Diskuze");

$pripojeni = Pripojeni::pripojeniDatabaze();
$sql = "SELECT * FROM forum_otazky ORDER BY id_fo DESC";
$result = $pripojeni->query($sql);

?>
<div id="obsah">
    <table class="table">
        <tr>
            <th><strong>#</strong></th>
            <th><strong>Téma</strong></th>
            <th><strong>Datum/čas</strong></th>
            <th><strong>Smazat</strong></th>
            <th><strong>Upravit</strong></th>
        </tr>
<?php
while($row = $result->fetch_assoc()) {
   $uzivatel = $row['id_uziv'];
?>
<tr class="tr">
<td><?php echo $row['id_fo']; ?></td>
        <td><a href="zobraz_tema.php?id=<?php  echo $row['id_fo']; ?>"><?php  echo $row['tema']; ?></a><br></td>
        <td><?php  echo $row['datetime']; ?></td>
        <td>
            <?php if ((isset($_SESSION['usr_id']) && ($uzivatel == $_SESSION['usr_id'])) or (isset($_SESSION['prava']) && ('admin' == $_SESSION['prava']))) { ?>
                <a href="smazani/smazat_tema.php?id=<?php  echo $row['id_fo']; ?>" class="tlacitko" onclick="return confirm('Chcete opravdu smazat toto téma?')">Smazat</a><br>
            <?php  } else { ?>
            <div>Nejste autor</div>
        </td>
    <?php  } ?>
        <td>
            <?php if ((isset($_SESSION['usr_id']) && ($uzivatel == $_SESSION['usr_id'])) or (isset($_SESSION['prava']) && ('admin' == $_SESSION['prava']))) { ?>
                <a href="editace/uprav_tema.php?zmena=<?php  echo $row['id_fo']; ?>" class="tlacitko">Upravit</a><br>
            <?php } else { ?>
            <div>Nejste autor</div>
        </td>
<?php  } ?>
        </tr>
        <?php }
        $pripojeni->close(); ?>
        <tr class="tr">
            <?php if (isset($_SESSION['usr_id'])) { ?>
                <td colspan="7" class="radek"><a href="pridani/nove_tema.php" class="odkaz"><strong>Vytvořte nové téma</strong></a></td>
            <?php } else { ?>
                <p>Pro přidání tématu, se prosím přihlašte! </p>
            <?php  } ?>
        </tr>
    </table>
</div>
<?php
paticka();
?>
