<?php require_once("../lib.php");?>

<?php if (function_exists("checkstatus"))
{
   $checkstatus=checkstatus("portal_level");
   if ($checkstatus=5 || $checkstatus>11)
   { echo'
   
<u><b>Mod -> Leitfaden -> Versammlung</b></u><br /><ul>
<li>Jeden 2. Sonntag ab 20 Uhr ist Teamspeakversammlung !! Hier ist eine zwingende Anwesenheit erforderlich. Sollte jemand nicht erscheinen aus privaten Gr&uuml;nden ist dieses der Teamleitung mitzuteilen (E-Mail an Drachi).</li></ul>
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

