<?php 
if (function_exists("allcheck"))
{ allcheck("admin_news_intern","portal_level",15); }
else
{ require_once("../lib.php");
 allcheck("admin_news_intern","portal_level",15); }
?>
<?php include("./lib/lib.php");?>
