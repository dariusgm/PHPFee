<?php 
if (function_exists("allcheck"))
{ allcheck("admin_bands","bands_level",10); }
else
{ require_once("../lib.php");
allcheck("admin_bands","bands_level",10); }
?>

<?php include("./lib/lib.php");?>
<?php added_bands();?>
<?php do_edit();?>
<?php del_bands();?>
<?php showedit_bands();?>


