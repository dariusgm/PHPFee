<?php
function show_podcast($anzahl)
{
$factor=12800;
$sql="SELECT * FROM podcast ORDER BY 'edit_time' LIMIT ".$anzahl."";
$db=mysql_connect("localhost","portal","psacln");
$result=mysql_db_query("portal",$sql);
if (mysql_num_rows($result)!=0)
{
	
	echo '<table cellspacing="5" border="0" summary="Unsere Podcasts in tabelarischer &Uuml;bersicht" width="600">';
	while($zeile=mysql_fetch_array($result))
	{echo '<tr><td width="300">"<i>'.$zeile["titel"].'</i>"</td><td width="100">von '.$zeile["author"].'</td><td width="100">'.date("d.m.Y <br />H:i:s",$zeile["edit_time"]).'</td></tr>
	       <tr><td colspan="3">'.nl2br(get_utf($zeile["beschreibung"])).'</td></tr>
	       <tr><td>Dateigr&ouml;&szlig;e: '.$zeile["size"].' kb ('.round($zeile["size"]/1024/1024,2).'MB) </td><td>Spielzeit: '.date("i:s",(($zeile["size"]*0.9)/$factor)).'</td><td><a href="./podcast/'.$zeile["file"].'.mp3" alt="Podcast runterladen" alt="'.$zeile["keywords"].'"><u>Podcast runterladen</u></a></td></tr>';
		}
	
	echo '</table>';
	}



}

?>