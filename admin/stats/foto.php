<?php 
if (function_exists("allcheck"))
{allcheck("admin_stats","stats_level",10); }
else
{ require_once("../lib.php");
 allcheck("admin_stats","stats_level",10); }
?>
<h4>Foto Menü Statistiken</h4>
<?php include("./lib/lib.php");?>
<?php show_stats(31,"",10);?>
