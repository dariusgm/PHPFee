<?php
function show_news_short()
{
$sql="SELECT datum,titel,kurznews,id FROM news_global ORDER BY datum DESC LIMIT 0,5";
$db = mysql_connect("localhost", "portal", "psacln") or die("Verbindungsfehler");
$result=mysql_db_query("portal",$sql);
while($zeile=mysql_fetch_array($result))
{
echo '<table summary="" frame="void" cellspacing="0" cellpadding="0">
<tr><td class="justwhite" width="100">'.substr($zeile["datum"],8,2).'.'.substr($zeile["datum"],5,2).'.'.substr($zeile["datum"],0,4).'</td><td class="newsheader" >'.get_utf($zeile["titel"]).'</td></tr>
<tr><td class="justwhite" colspan="2">'.get_utf($zeile["kurznews"]).'<a class="mainlink" href="artikel_'.$zeile["id"].'.htm" >>>Mehr</a></td></tr>
</table><br /><br />';
}
}


function show_last_4()
{
$db=mysql_connect("localhost","portal","psacln");
$sql="SELECT id,name,kurztext,bild_klein FROM bands ORDER BY 'datum' ASC LIMIT 0,4";
$result=mysql_db_query("portal",$sql);
echo '<table summary="Bands bei Discollection Radio" frame="void" cellspacing="0" cellpadding="0">';
while($zeile=mysql_fetch_array($result))
{

echo '<tr>
<td width="300" class="justwhite"> 
<img src="./bands/'.$zeile["bild_klein"].'" vspace="10" hspace="20" align="left" alt="Klicke hier, um die Datei runterzuladen">
<b>';
echo get_utf($zeile["name"]);
echo '</b><br />';
echo get_utf($zeile["kurztext"]);
echo '<a class="mainlink" href="band_'.$zeile["id"].'.htm">>>>Mehr</a></td></tr>';


}
echo '</table>';

	
}




function show_next_event()
{
	$sql1="SELECT datum,uhrzeit,titel FROM events WHERE datum>='".date("Y-m-d")."' LIMIT 1";
	$dbcon=mysql_connect("localhost","portal","psacln");
	$dbdb=mysql_select_db("portal");
	$result=mysql_query($sql1);
	if (mysql_num_rows($result)!=NULL)
	{
	$zeile=mysql_fetch_array($result);
	echo '<b><a href="events.htm">N&auml;chstes Event: </a>'.get_utf($zeile["titel"]).' am '.  date("d.m.Y",$zeile["datum"]) . ' ab ' . $zeile["uhrzeit"] . '</b>'; 
    }
	
	
	
	}


?>