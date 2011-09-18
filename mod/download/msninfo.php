<?php
session_start();
?>

<?php require_once("../lib.php");?>

<?php if (function_exists("checkstatus"))
{
   $checkstatus=checkstatus("portal_level");
   if ($checkstatus=5 || $checkstatus>11)
   { echo'
   
Die MSN Liste einfach in MSN Importieren:<br />
<b>Kontakte</b> -> <b>Kontakte aus einer Datei Importieren</b><br /><br />

Alternativ auf die datei doppelt klicken, dann steht dort wie man sie importiert.
   ';
   }
   else
   {
   echo '<h1>Zugriff verweigert.</h1> ';
   exit();
   }
}
else
{
echo '<h1>Zugriff verweigert.</h1> ';
exit();
}


?>


