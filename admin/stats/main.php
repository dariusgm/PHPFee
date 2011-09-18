<?php 
if (function_exists("allcheck"))
{allcheck("admin_stats","stats_level",10); }
else
{ require_once("../lib.php");
 allcheck("admin_stats","stats_level",10); }
?>
<u>Statistiken</u>
<br />
Zuerst sei gesagt, dass die Statistiken in diesem Portal sehr viel geneuer ausfallen als auf der alten Page. Man sieht zu jeder Seite wie, oft diese besucht wurde UND neu auch zu jeder Unterseite, wie oft diese benutzt wurde.
Z.B. wird angezeigt, wie oft man die Charts aufgerufen hat und wie oft neue Eintr&auml;ge vorgeschlagen wurden f&uuml;r die Charts.
Die Statistiken vom aktuellen Tag sind hier nicht aufgelistet. Sie werden am Folgetag erst in die Datenbank aufgenommen. Es werden bei den Seitenaufrufen die Klicks gez&auml;hlt, unabh&auml;ngig von den IP's.<br /><br />
