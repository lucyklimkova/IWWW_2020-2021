<?php
session_start();
include_once 'pripojeni.php';
function hlavicka($title, $description = "") {
?>
<!DOCTYPE html>
<html lang="cs-cz">
    <head>
	<meta charset="utf-8" />
	<meta name="author" content="Lucy Klimková" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="obrazky/ikona.ico" />
    <link rel="shortcut icon" href="../obrazky/ikona.ico" />
    <link rel="shortcut icon" href="../../obrazky/ikona.ico" />
    <title><?=empty($title) ? "Agents of S.H.I.E.L.D" : $title . " – Agents of S.H.I.E.L.D"?></title>
    <?php if (!empty($description)) { ?>
    <meta name="description" content="<?=$description?>">  <?php } ?>
    <link rel="stylesheet" href="css/styl.css" type="text/css" />
    <link rel="stylesheet" type="text/css" href="../css/styl.css">
    <link rel="stylesheet" type="text/css" href="../../css/styl.css">
    <script type="text/javascript" src="js/overeni.js"></script>
    <script type="text/javascript" src="../js/overeni.js"></script>
    <script type="text/javascript" src="../../js/overeni.js"></script>
    <script src='tinymce/js/tinymce/tinymce.min.js'></script>
    <script src='../tinymce/js/tinymce/tinymce.min.js'></script>
    <script src='../../tinymce/js/tinymce/tinymce.min.js'></script>
    <script>
     tinymce.init({
       selector: '#myTextarea',
       width: 600,
       height: 300
     });
    </script>
	</head>  
	<body>
    <header>
	<nav>
      <div id="logo"></div>
      <div class="menu">
      <label for="show-menu" class="show-menu">Menu</label>
      <input type="checkbox" id="show-menu" role="button">
			<ul id="menu">
				<li><a href="/web_sem_prace/index.php">Úvod</a></li>
				<li><a href="/web_sem_prace/novinky.php">Novinky</a></li>
				<li><a href="/web_sem_prace/epizody.php">Epizody</a></li>
				<li><a href="/web_sem_prace/postavy.php">Postavy</a></li>
        <li><a href="/web_sem_prace/herci.php">Herci</a></li>
        <li><a href="/web_sem_prace/diskuze.php">Diskuze</a></li>
        <?php if (isset($_SESSION['usr_id'])) { ?>
        <li class="right"><a href="/web_sem_prace/odhlaseni.php">Odhlášení</a></li>
        <li class="right"><a href="/web_sem_prace/ucet.php">Váš účet</a></li>
        <?php } else { ?>
        <li class="right"><a href="/web_sem_prace/registrace.php">Registrace</a></li>
		<li class="right"><a href="/web_sem_prace/prihlaseni.php">Přihlášení</a></li>
		<?php } ?>
      </ul>
      </div>
	</nav>
    </header>
  <div id="centrovac">  
<?php }
function paticka() {
?> 
  </div>
	<footer id="footer" style="width: 100%">		
	<p id="paticka" > Semestrální práce IWWW, Autorka: Lucie Klimková.</p>
	</footer>
</body>
</html>

<?php }
function vstup($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>