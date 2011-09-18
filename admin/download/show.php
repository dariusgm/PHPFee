<?php 
if (function_exists("allcheck"))
{ allcheck("admin_download","download_level",10); }
else
{ require_once("../lib.php");
 allcheck("admin_download","download_level",10); }
?>

<?php include("./lib/lib.php");?>
<?php del_download();?>
<?php show_download();?>