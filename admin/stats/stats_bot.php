<?php 
if (function_exists("allcheck"))
{allcheck("admin_stats","stats_level",10); }
else
{ exit(); }
?>
<h4>Referer &Uuml;bersicht</h4>
<?php
# Zeige die Zugriffe von BOTs an.
echo '<table border="1"><th>ID</th><th>IP (Host)</th><th>Betreten</th><th>Verlassen</th><th>Besuchszeit</th><th>Seitenaufrufe</th><th>Browser</th><th>Referer</th>';
$sql2="SELECT AVG(views) AS mittelwert FROM stats_user

$sql1="SELECT * FROM stats_bot ORDER BY id DESC ";
$db=mysql_connect("localhost","portal","psacln");
$result1=mysql_db_query("portal",$sql1);
$color0="#FAFAD2";
$color1="#90EE90";
$mycolor=0;
while($zeile=mysql_fetch_array($result1))
{
	echo '<tr style="background-color:';
	if ($mycolor) {echo $color1; $mycolor=0;}
	else {echo $color0; $mycolor=1;}
	
	echo '"><td>'.$zeile["id"].'</td>
	<td>'.$zeile["ip"].' <br />('.gethostbyaddr($zeile["ip"]).')</td>
	<td>'.$zeile["anfang"].'</td>
	<td>'.$zeile["ende"].'</td>
	<td>'.($zeile["ende"]-$zeile["anfang"]).'</td>
	<td>'.$zeile["views"].'</td>
	<td>'.$zeile["referer"].'</td>	
	</tr>';
	
}


echo '</table>';
?>