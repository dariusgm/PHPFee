<?php 
if (function_exists("allcheck"))
{ allcheck("admin_news","news_level",10); }
else
{ require_once("../lib.php");
 allcheck("admin_news","news_level",10); }
?>
<?php include("./lib/lib.php");?>
<?php del_news();?>
<?php edit_news();?>
<?php show_news() ;?>