<?php 
if (function_exists("allcheck"))
{ allcheck("admin_gastebuch","gastebuch_level",10); }
else
{ require_once("../lib.php");
 allcheck("admin_gastebuch","gastebuch_level",10); }
?>

<?php include("./lib/lib.php");?>
<?php do_gbook();?>
<?php show_gbook() ;?>