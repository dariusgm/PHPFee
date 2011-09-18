<?php
session_start();
?>

<?php require_once("../lib.php");?>

<?php if (function_exists("checkstatus"))
{
   $checkstatus=checkstatus("portal_level");
   if ($checkstatus=5 || $checkstatus>11)
   { echo '
   
<u>On Air</u>
<br />
In diesem Men&uuml; betretet Ihr die Gru&szlig;boxen f&uuml;r die einzelnen Streams.<br />
Ihr w&auml;hlt hier Euer On-Air-Bild und den Banner f&uuml;r die Sendung aus. Die Verwaltung der Banner wird im Men&uuml;punkt <b>"Banner"</b> vorgenommen.<br />
Weitere Informationen zur Verwaltung der Banner erhaltet Ihr dort.

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


