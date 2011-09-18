<?php 
if (function_exists("allcheck"))
{allcheck("admin_stats","stats_level",10); }
else
{ exit(); }
?>
<h4>Browser &Uuml;bersicht</h4>
<?php
$sql1="SELECT browser,count(browser) AS anzahl FROM stats_user GROUP BY browser ORDER BY anzahl DESC";
$db=mysql_connect("localhost","portal","psacln");
$result1=mysql_db_query("portal",$sql1);
echo '<table border="1"><th>Browser</th><th>Anzahl der Benutzungen insgesamt</th>';
$color0="#FAFAD2";
$color1="#90EE90";
$mycolor=0;
while($zeile=mysql_fetch_array($result1))
{
	echo '<tr style="background-color:';
	if ($mycolor) {echo $color1; $mycolor=0;}
	else {echo $color0; $mycolor=1;}
	
	echo '"><td>'.$zeile["browser"].'</td><td>'.$zeile["anzahl"].'</td></tr>';
	
}


echo '</table>';
?>