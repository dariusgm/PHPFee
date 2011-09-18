<?php 
if (function_exists("allcheck"))
{ allcheck("admin_events","events_level",10); }
else
{ require_once("../lib.php");
 allcheck("admin_events","events_level",10); }
?>
<?php include("./lib/lib.php");?>
<?php added_events(); ?>
<?php del_events();?>
<?php edit_events();?>
<?php show_events() ;?>