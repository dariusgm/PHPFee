<?php 
if (function_exists("allcheck"))
{allcheck("admin_webmaster","portal_level",15); }
else
{ require_once("../lib.php");
 allcheck("admin_webmaster","portal_level",15); }
?>
<?php phpinfo();?>