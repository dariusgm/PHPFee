<?php 
if (function_exists("allcheck"))
{allcheck("admin_stats","stats_level",10); }
else
{ exit(); }
?>
<h4>Startseite - Statistiken</h4>
<?php include("./lib/lib.php");?>
<?php show_stats(60,"",14);?>
