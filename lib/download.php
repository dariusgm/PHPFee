<?php


function show_download($anzahl)
{
$sql="SELECT * FROM download WHERE level=1";
if (isset($_SESSION["nick"]) && isset($_SESSION["pw"]) && isset($_SESSION["id"]))
{$sql.=" OR level=2";}

$sql.=" ORDER BY 'datum' DESC LIMIT 0,$anzahl";
$db = mysql_connect("localhost", "portal", "psacln") or die("Verbindungsfehler");
$result=mysql_db_query("portal",$sql);
while($zeile=mysql_fetch_array($result))
{
echo '<table><tr><td width="100">'.substr($zeile["datum"],8,2).'.'.substr($zeile["datum"],5,2).'.'.substr($zeile["datum"],0,4).'</td><td width="300"><b>'.get_utf($zeile["titel"]).'</b></td><td><a href="./download/'.$zeile["dateiname"].'">Download</a></td></tr>
<tr><td height="50" valign="top" colspan="3"><br />'.get_utf(nl2br($zeile["beschreibung"])).'</td></tr></table><hr />';	
	
}



}

?>
