<?php 
if (function_exists("allcheck"))
{allcheck("admin_stats","stats_level",10); }
else
{ exit(); }
?>
<h4>Referer &Uuml;bersicht</h4>
<?php
# Zeige die Zugriffe der Letzten 24h an.
$sql1="SELECT * FROM stats_user WHERE anfang>".(time()-86400)." ORDER BY id DESC ";

# Zeige durschschnittliche Pageviews Pro besucher
$sql2="SELECT AVG(views) AS mittelwert_views FROM stats_user";
#Zeige durchschnittliche Besuchszeit in Sekunden
$sql3="SELECT AVG(ende-anfang) AS mittelwert_zeit FROM stats_user";

$db=mysql_connect("localhost","portal","psacln");
$result1=mysql_db_query("portal",$sql1);
$result2=mysql_db_query("portal",$sql2);
$result3=mysql_db_query("portal",$sql3);
$zeile2=mysql_fetch_array($result2);
$zeile3=mysql_fetch_array($result3);

echo '<table border="1"><th>ID</th><th>IP (Host)</th><th>Betreten</th><th>Verlassen</th><th>Besuchszeit<br /> (Ø'.date("i:s",$zeile3["mittelwert_zeit"]).'min)</th><th>Seitenaufrufe<br /> (Ø'.$zeile2["mittelwert_views"].')</th><th>Browser</th><th>Referer</th>';
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
	<td>'.$zeile["browser"].'</td>	
	<td>'.$zeile["referer"].'</td>	
	</tr>';
	
}


echo '</table>';
?>