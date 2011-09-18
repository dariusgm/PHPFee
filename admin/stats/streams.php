<?php 
if (function_exists("allcheck"))
{allcheck("admin_stats","stats_level",10); }
else
{ require_once("../lib.php");
 allcheck("admin_stats","stats_level",10); }
?>

<?php include("./lib/lib.php");?>
<table border="1"><tr><td>
DSL Main1:
<?php
get_shoutcast("discollection-radio.eu",8000);
?></td>
<td>ISDN Main1:
<?php get_shoutcast("discollection-radio.eu",8002); ?></td></tr>

<tr><td>DSL Main2:
<?php
get_shoutcast("discollection-radio.eu",9000);
?></td>
<td>ISDN Main2:
<?php get_shoutcast("discollection-radio.eu",9002); ?></td></tr></table>
