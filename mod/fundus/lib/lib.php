<?php
function userandpass()
{
echo '<input type="hidden" name="userinput" value="'.$_POST["userinput"].'" />
<input type="hidden" name="passinput" value="'.$_POST["passinput"].'" />';
}

function show_fundus()
{
	$db=mysql_connect("localhost","portal","psacln");
	$sql1="SELECT id,name,beschreibung,anzahl FROM fundus_geschenke WHERE anzahl>0 ORDER BY 'anzahl' DESC";
	$result1=mysql_db_query("portal",$sql1);
	echo '<table><tr><td width="50">ID</td><td width="100">Name</td><td width="400">Beschreibung</td><td>Anzahl</td></tr>';
	while($zeile1=mysql_fetch_array($result1))
	{
		echo '<tr><td>'.$zeile1["id"].'</td><td>'.get_utf(unfilter($zeile1["name"])).'</td><td>'.nl2br(get_utf(unfilter($zeile1["beschreibung"]))).'</td><td>'.$zeile1["anzahl"].'</td></tr>';
	}
	echo '</table>';
}

?>