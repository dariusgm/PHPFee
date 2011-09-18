<?php require_once("../lib.php");?>

<?php if (function_exists("checkstatus"))
{
   $checkstatus=checkstatus("portal_level");
   if ($checkstatus=5 || $checkstatus>11)
   { echo'
   
<u>Leitfaden</u>
<br /><br />
<b><u>Jeder Moderator, ist für seine eigene Sendung Verantwortlich, im Musikgebrauch , der veröffentlichungen , so wie im Kommunikativen Bereich der Moderation auf dem Stream (Radio) .Der Betreiber der Webseite www.discollection-radio.de haftet Grundsätzlich nicht für Fehlverhalten.</u></b><br /><br />
In diesem Men&uuml; findet Ihr den Moderatorenleitfaden. Der Leitfaden enthält die Regeln von Discollection-Radio und ist von <b>allen</b> Moderatoren<br />
einzuhalten. Der Leitfaden ist Pflichtlekt&uuml;re <b>vor</b> der ersten Sendung.<br />
Auch ist der Leitfaden immer wieder durchzulesen, da &Auml;nderungen m&ouml;glich sind.
   
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



