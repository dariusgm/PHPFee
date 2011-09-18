<?php require_once("../lib.php");?>

<?php if (function_exists("checkstatus"))
{
   $checkstatus=checkstatus("portal_level");
   if ($checkstatus=5 || $checkstatus>11)
   { echo'
   
<u><b>Mod -> Leitfaden -> Homepage</b></u><br /><ul>
<li>Sollten diverse W&uuml;nsche, Anregungen, dringende Dinge, technische &Auml;nderungen oder einfach nur die &Auml;nderung von Sachen die euch auffallen bez&uuml;glich der Homepage vorliegen, wendet Euch bitte an Tuxi.</li>
</ul><br />
   
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

