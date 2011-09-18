<?php
session_start();
?>

<?php require_once("../lib.php");?>

<?php if (function_exists("checkstatus"))
{
   $checkstatus=checkstatus("portal_level");
   if ($checkstatus=5 || $checkstatus>11)
   { echo '
   
<u>Banner</u>
<br />
In diesem Men&uuml; ladet Ihr Eure On-Air-Bilder und Banner hoch und k&ouml;nnt sie verwalten. Das Men&uuml;r sollte selbsterkl&auml;rend sein.<br />
Wenn Ihr nur <b>ein</b> On-Air-<b>Bild</b> hochgeladen habt, wird dieses automatisch verwendet. Anderenfalls w&auml;hlt bitte das gew&uuml;nschte On-Air-Bild aus.<br />
Den Banner, den Ihr verwenden m&ouml;chtet, m&uuml;sst Ihr allerdings explizit ausw&auml;hlen.
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
