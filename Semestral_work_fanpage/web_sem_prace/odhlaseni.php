<?php
ob_start();
session_start();

if(isset($_SESSION['usr_id'])) {
  unset($_SESSION['prava']);
	session_destroy();
	header("Location: prihlaseni.php");
} 
  else {
	header("Location: prihlaseni.php");
}
ob_end_flush();
