<?php
include "headerAFooter.php";
hlavicka("Výpis novinek");

$pripojeni = Pripojeni::pripojeniDatabaze();
$id_uzivatele = $_SESSION['usr_id'];

$sql = "SELECT id, id_novinky, jmeno, nadpis, obsah, cas FROM novinky
  JOIN uzivatele ON novinky.uzivatel = uzivatele.id
  WHERE novinky.uzivatel='$id_uzivatele'
  ORDER BY cas ";
?>
 <div id="obsah">
 <h2>Výpis novinek uživatele</h2>
 <?php if (isset($_SESSION['usr_id'])) { ?>
 <p>Vítejte <?php echo $_SESSION['usr_jmeno']; ?> <?php echo $_SESSION['usr_prijmeni']; ?> zde naleznete seznam všech vašich novinek.</p>
 <p>Novinky můžete editovat, odstranit anebo se podívat na jejich detail.</p>
<?php
$result = $pripojeni->query($sql);
 if($result) {
         while ($row = $result->fetch_assoc()) {
             $id_novinky = $row["id_novinky"];
             $cas = $row["cas"];
             $time = strtotime($cas);
             $myFormatForView = date("d/m/y G:i ", $time);
?>
<div>
    <i>Název novinky:</i> <?php echo $row["nadpis"]; ?><br>
    <i>Čas vytvoření:</i> <?php echo $myFormatForView; ?><br>
    <?php
    echo "<a href='detail_novinka.php?id_novinky=".$id_novinky."' class='tlacitko'>Detail novinky</a>";
    echo "<a href='editace/edit_novinka.php?update=".$id_novinky."' class='tlacitko'>Editace novinky</a>";
    ?>
    <a <?php echo "href='smazani/smaz_clanek.php?id_novinky=".$id_novinky."';" ?> class='tlacitko'  onclick="return confirm('Chcete opravdu smazat tuto novinku?')">Smazání novinky</a><br><br>
</div> <br>
<?php
    }
}
else { ?>
    <p>Nepodařilo se najít požadované záznamy.</p>
<?php }
$prava= $_SESSION['prava'];
if ($prava == 'admin') {
    if(isset($_POST['buttonImport'])) {
         copy($_FILES['jsonFile']['tmp_name'], 'json_files/'.$_FILES['jsonFile']['name']);
         $data = file_get_contents('json_files/'.$_FILES['jsonFile']['name']);
         $novinky = json_decode($data);
         if (is_array($novinky) || is_object($novinky)) {
         foreach ($novinky as $novinka) {
             $stmt = $pripojeni->prepare('INSERT INTO novinky (popisek, nadpis, obsah, uzivatel, cas)  
                                                VALUES(?,?,?,?, NOW())');
             $stmt->bind_param("sssi", $novinka->popisek, $novinka->nadpis, $novinka->obsah, $novinka->uzivatel);
             $stmt->execute();
         }
      }
    }
    if(isset($_POST['buttonExport'])) {
        $sql = "SELECT * FROM novinky";
        $result = $pripojeni->query($sql) or die("Error in Selecting " . $pripojeni->error);

        $emparray = array();
        while($row = $result->fetch_assoc())
        {
            $emparray[] = $row;
        }
        $fp = fopen('json_files/data.json', 'w');
        fwrite($fp, json_encode($emparray));
        fclose($fp);
    }
?>
    <form method="post" enctype="multipart/form-data">
        Import z JSON souboru: <input type="file" name="jsonFile">
        <br>
        <input type="submit" value="Import" name="buttonImport">
    </form>
    <form method="post" enctype="multipart/form-data">
        Export do JSON souboru:
        <input type="submit" value="Export" name="buttonExport">
    </form>
<?php
   }
 }
else { ?>
     <p> Nejste přihlášeni, vstup nepovolen!</p>
<?php
 }
?>
<a href="ucet.php" class="button2 right">Zpět</a><br>
</div>
<?php
paticka();
?>



