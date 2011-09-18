<?php require_once("../lib.php");?>

<?php if (function_exists("checkstatus"))
{
   $checkstatus=checkstatus("portal_level");
   if ($checkstatus=5 || $checkstatus>11)
   { echo'
   
<u><b>Mod -> Leitfaden -> Sendeplan</b></u><br /><ul>
<li>Jeder Moderator von Discollection-Radio verpflichtet sich, in der Woche von Montag bis Sonntag, 4 Stunden zu senden, um den Radiobetrieb aufrecht zu erhalten.</li>
<li>Die 4 Stunden m&uuml;ssen in je 2 Stunden Bl&ouml;cken abgearbeitet werden.</li>
<li>Wer l&auml;nger als die in der Pflicht stehenden Stunden senden m&ouml;chte, darf diese selbstverst&auml;ndlich machen und beachte bitte den Sendeplan, ob ein Termin noch frei ist.</li>
<li>Die Sendeplanerstellung beginnt am Donnerstag um 18:00 und endet am Freitag um 20:00. Um dieses auch zu gew&auml;hrleisten, wird gebeten bis sp&auml;testens Freitag 20:00 alle Sendezeiten den Sendeplan-Verantwortlichen ( -> Mitwirkende) mitzuteilen.</li>
<li>Verpflichtet zum Senden sind alle Moderatoren und Admin\'s mit Moderatoren Status. Einzige Ausnahme, sind Webmaster. sie k&ouml;nnen senden, stehen aber nicht in der Pflicht.</li>
<li>Dreimaliges Vers&auml;umen der Frist f&uuml;hrt zu einem Ausschluss aus dem Team. <b>Diese Regelung tritt sofort in Kraft.</b></li>
<li>Nennt mehrere Zeiten, damit die Sendeplan-Verantwortlichen alle Moderatoren einplanen k&ouml;nnen und nicht nur ein und dieselben senden m&uuml;ssen, somit k&ouml;nnen sie besser planen und verplanen.</li>
<li>Formular daf&uuml;r. Nach wie vor gilt: Sendezeiten sind bis Freitag abend 20 Uhr f&uuml;r die n&auml;chste Woche abzugeben. Wer diese Frist vers&auml;umt, wird f&uuml;r eine Woche auf inaktiv gesetzt und kann nicht am Sendebetrieb  und an TS-Versammlungen teilnehmen. </li>
<li>Bei „nicht senden k&ouml;nnen” aus privaten Gr&uuml;nden, muss ein Urlaubsantrag eingereicht werden. Weiterhin , hat sich der jeweilige Moderator , dann f&uuml;r einen Ersatz zu bem&uuml;hen.</li>
<li>Wer L&Auml;NGER als eine Woche Urlaub hat, wird auf inaktiv zur&uuml;ckgestuft. Bei R&uuml;ckkehr reicht ein Melden bei einem der Admins, es wird ein kurzes Gespr&auml;ch &uuml;ber die Vorg&auml;nge w&auml;hrend der Urlaubszeit geben und der Moderator wird wieder aktiviert. Findet eine Woche nach eingereichtem Urlaubsende keine R&uuml;ckmeldung statt, wird der Moderator auf Benutzer zur&uuml;ckgestuft.</li>
<li>Bei einem Ausfall von 4 Wochen wird der jeweilige Moderator ohne Ansage auf User Status gesetzt und gilt als inaktiv.</li></ul>
   <br />
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

