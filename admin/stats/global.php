<?php 
if (function_exists("allcheck"))
{allcheck("admin_stats","stats_level",10); }
else
{ require_once("../lib.php");
 allcheck("admin_stats","stats_level",10); }
?>
<h4>Startseite - Statistiken</h4>
<?php include("./lib/lib.php");?>

<table border="1"><tr><td valign="top">
Die Letzen 14 Tage:

<?php
echo '<table><tr><td width="100">Datum</td><td> Counter:</td></tr></table>';
$i=0;
while($i > (-15))
{
$a = date ("Y-m-d", mktime(0, 0, 0, date(m), (date(d)+$i), date(Y)));
show_global_all($a);	
--$i;

}
?>
</td><td valign="top">
Die Besten Tage:

<?php
echo '<table><tr><td width="100">Datum</td><td> Counter:</td></tr></table>';


show_global_best();	



?></td></tr>
<tr><td valign="top">
Die schlechtesten Tage:
<?php
echo '<table><tr><td width="100">Datum</td><td> Counter:</td></tr></table>';


show_global_worse();	



?></td><td>leer</td></tr></table>
