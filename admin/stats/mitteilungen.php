<?php 
if (function_exists("allcheck"))
{allcheck("admin_stats","stats_level",10); }
else
{ require_once("../lib.php");
 allcheck("admin_stats","stats_level",10); }
?>
<h4>Mitteilungen</h4>
<?php include("./lib/lib.php");?>
Mitteilungen aufrufe:<br />
<?php show_stats(40,"send",5);?>
<br /><br />
Mitteilungen Gelöscht:<br />
<?php show_stats(40,"archiv",5);?>
<br /><br />


