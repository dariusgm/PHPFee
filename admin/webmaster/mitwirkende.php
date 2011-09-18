<?php 
if (function_exists("allcheck"))
{allcheck("admin_webmaster","portal_level",15); }
else
{ require_once("../lib.php");
 allcheck("admin_webmaster","portal_level",15); }
?>
Hier können die Hauptverantwortlichen festgelegt werden.<br />

<?php include("./lib/lib.php");?>
<?php do_mitwirkende();?>
<?php show_mitwirkende();?>
