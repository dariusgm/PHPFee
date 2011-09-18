<?php 
if (function_exists("allcheck"))
{allcheck("admin_webmaster","portal_level",15); }
else
{ require_once("../lib.php");
 allcheck("admin_webmaster","portal_level",15); }
?>
<?php include("./lib/lib.php");?>
<form method="post" action="index.php?x=adminlog">
<?php userandpass();?>

<input type="text" name="von" value="von" />
<input type="text" name="bis" value="bis" />
<button type="submit">Ausführen</button></form>
<?php show_mod_log();?>

