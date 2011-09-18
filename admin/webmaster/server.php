<?php 
if (function_exists("allcheck"))
{allcheck("admin_webmaster","portal_level",15); }
else
{ require_once("../lib.php");
 allcheck("admin_webmaster","portal_level",15); }
?>
<?php require_once("./lib/lib.php");?>
<?php do_server();?>
Diese Funktion fuehrt beliebige Serverbefehle uber die Konsole aus. Auch hier ist aesserste Vorsicht geboten!
<form method="post" action="index.php?x=server"><textarea name="server" cols="50" rows="20"></textarea><br />
<?php userandpass();?>
<button type="submit">Ausfuehren</button></form>