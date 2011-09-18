<?php
session_start();
?>

<?php require_once("../lib.php");?>

<?php if (function_exists("checkstatus"))
{
   $checkstatus=checkstatus("portal_level");
   if ($checkstatus=5 || $checkstatus>11)
   { echo '
   
<u>Sendeplan</u>
<br />
Der Sendeplan im Moderatorenbereich der Page bietet Euch einen &Uuml;berblick &uuml;ber die belegten Sendezeiten der n&auml;chsten 7 Tage auf allen Streams und bietet Euch die M&ouml;glichkeit der
leichten Einreichung Eurer Sendezeiten.<br />
Im Men&uuml;punkt <b>&Uuml;berblick</b> findet Ihr die &Uuml;bersicht.<br />
Im Men&uuml;punkt <b>Sendezeiten einreichen</b> findet Ihr eine einfache Erfassungsmaske zur Einreichung Eurer Sendezeiten.<br />
Die Sendezeiten einer Woche sind stets bis Freitag abend 20:00 Uhr der Vorwoche einzureichen.<br />
Um es den Sendeplanadmins m&ouml;glichst einfach zu machen, gebt eine komplette Zeitspanne ein, in der Ihr senden k&ouml;nnt, so wird die Planung erleichtert.
Beim Versenden werden automatisch alle Sendeplanadmins informiert. Bitte verzichtet auf E-Mails oder IMs, um Sendezeiten mitzuteilen und nutzt <b>ausschlie&szlig;lich</b> dieses Formular.<br />
Ihr selbst bekommt eine E-Mail &uuml;ber die so eingereichten Sendezeiten, um Euch den &Uuml;berlick &uuml;ber die eingereichten Sendezeiten zu geben.<br />

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




