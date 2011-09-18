<?php 
if (function_exists("allcheck"))
{allcheck("admin_webmaster","portal_level",15); }
else
{ require_once("../lib.php");
 allcheck("admin_webmaster","portal_level",15); }
?>
Mit dieser Funktionen koennen beliebige SQL Befehle auf dem Server ausgefuehrt werden.
<?php require_once("./lib/lib.php");?>
<?php do_sql();?>

<form method="post" action="index.php?x=sql"><textarea name="sql" cols="50" rows="20"></textarea><br />
<?php userandpass();?>
<button type="submit">Ausfuehren</button></form>

