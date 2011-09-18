<?php require_once("../lib.php");?>

<?php if (function_exists("checkstatus"))
{
   $checkstatus=checkstatus("portal_level");
   if ($checkstatus=5 || $checkstatus>11)
   { echo'
   
<u><b>Mod -> Leitfaden -> Chat</b></u><br />
<ul>
<li>W&auml;hrend der Sendung ist im Chat Anwesenheitspflicht. (Welchen Client ihr nutzt um in den IRC Channel zu kommen ist allein euch &uuml;berlassen,) Hauptsache ihr seid zu euren Sendungen anwesend.</li>
<li>Als Moderator von der Sendung ist es Pflicht den Operator Status zu f&uuml;hren. ( die die noch keine Chatschulung hatten werden gevoiced )</li>
<li>Der Chat ist der direkteste Kontakt vom H&ouml;rer zu euch.</li>
<li>Bitte verhaltet euch entsprechend vern&uuml;nftig.</li>
<li>Jegliche Anfeindungen mit dem H&ouml;rer sind zu unterlassen.</li>
<li>Sollten Probleme auftreten, sind sofort die Chatbetreuungen oder andere anwesende Operator zu informieren.</li>
<li>Nur diese werden den Disput zu schlichten versuchen oder notfalls einen Kick oder Bann in Erw&auml;gung ziehen.</li>
<li><b>Da Anwesenheitspflicht ist im Chat w&auml;hrend der Sendung, sind alle Moderatoren verpflichtet an einer Chatschulung teilzunehmen</b></li>
<li>Unerw&uuml;nscht ist das Begr&uuml;&szlig;en von Chatteilnehmern, wenn Sie w&auml;hrend der Sendung den Chat betreten (zu beginn ist ok). Private Gr&uuml;&szlig;e an Familienmitglieder sollten &uuml;ber dem Stream gemieden werden.</li>

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

