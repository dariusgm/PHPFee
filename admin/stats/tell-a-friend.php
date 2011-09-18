<?php 
if (function_exists("allcheck"))
{allcheck("admin_stats","stats_level",10); }
else
{ exit(); }
?>
<h4>Weiterempfehlen (Tell-a-friend) - Statistiken</h4>
<?php include("./lib/lib.php");?>
<?php show_stats(59,"",14);?>
