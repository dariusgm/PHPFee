<?php 
if (function_exists("allcheck"))
{ allcheck("admin_podcast","podcast_level",10); }
else
{ require_once("../lib.php");
 allcheck("admin_podcast","podcast_level",10); }
?>
<?php include("./lib/lib.php");?>
<?php write_podcast_file();?>
