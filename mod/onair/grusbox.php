<?php
session_start();
?>

<?php require_once("../lib.php");?>

<?php 
if (isset($_SESSION["id"]) && isset($_SESSION["stream"]) && isset($_SESSION["modus"]))
{
include("./lib/lib.php");   
change_settings();
do_grusbox();
show_grusbox();
}
else
{ echo '<h1>Zugriff verweigert!</h1>';}
?>