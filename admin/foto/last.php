<?php 
if (function_exists("allcheck"))
{ allcheck("admin_foto","foto_level",10); }
else
{ require_once("../lib.php");
 allcheck("admin_foto","foto_level",10); }
?>
<?php
include("./lib/lib.php");?>
<?php
show_last_foto();
?>