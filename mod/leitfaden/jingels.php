<?php require_once("../lib.php");?>

<?php if (function_exists("checkstatus"))
{
   $checkstatus=checkstatus("portal_level");
   if ($checkstatus=5 || $checkstatus>11)
   { echo'
   
<u><b>Mod -> Leitfaden -> Jingels und Co</b></u><br /><ul>
<li>Alle halbe Stunde ca. einen "Kurz-Jingle" von Discollection-Radio einbauen.
Jingles sind im Moderator -> Download-Bereich zu finden.</li>
<li>Einmal in der Sendung einen l&auml;ngeren Jingle oder Werbung spielen.</li>
</ul> <br />
   
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

