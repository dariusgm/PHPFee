
<?php
/* Das Copyright liegt bei Darius "Tuxi" Murawski, Wohnhaft in Hamburg. 
Discollection-radio.de darf diese Script mit meiner Genemigung benutzen. Weitergabe in originaler, 
ver&auml;nderter Form - oder in Teilen ist ohne schriftliche Einverst&auml;ndnis des Authors nicht gestattet. 
Bei Verstoß gegen diese Bestimmungen erfolgt eine Anzeige. 
Der Betreiber von Discollection-radio.de erkl&auml;rt sich mit den Vereinbarungen durch die benutzung dieses
Scripts einverstanden.
*/
$StartTime = microtime(true);
$datei = fopen ("counter.x","r+");
$counterstand = fgets($datei, 3);
fclose($datei); 
$datum = date("y-m-d");
$uhrzeit = date("H:i:s");
echo ("Daten werden aktualisiert. Bitte Warten!");

$plazierung = 0;
$vorklicks = 300;
$durchlauf = 1;
$db = mysql_connect("localhost", "charts_ver", "Rnwtz19w") or die("Verbindungsfehler");
$sql_create = "CREATE TABLE chartstemp (  id int(11) NOT NULL auto_increment,  interpret varchar(50) collate latin1_general_ci NOT NULL default '',  titel varchar(50) collate latin1_general_ci NOT NULL default '',  klicks int(11) NOT NULL default '0',  vorwoche int(11) NOT NULL default '0',  visible int(1) NOT NULL default '0',  freidatum date NOT NULL default '0000-00-00',  freizeit varchar(8) collate latin1_general_ci NOT NULL,  indatum date NOT NULL default '0000-00-00',  inzeit varchar(8) collate latin1_general_ci NOT NULL,  PRIMARY KEY  (id))";
$sql_exe_create = mysql_db_query("charts", $sql_create);

$sql_select2 = 'SELECT * FROM `charts` ORDER BY `klicks` ASC';
$sql_exe_select2 = mysql_db_query("charts", $sql_select2);
while($row = mysql_fetch_array($sql_exe_select2))
{
  extract ($row);
	if ($visible == 1)
	{
	 if ($durchlauf < (1+$counterstand))
	 
	 {
	 $durchlauf ++;
	 echo $durchlauf;
	
   $sql_del2 = "DELETE FROM charts WHERE id='$id'";
   $sql_exe_del2 = mysql_db_query("charts", $sql_del2);
	 }
	}
}

$sql_select = 'SELECT * FROM `charts` ORDER BY `klicks` DESC';
$result = mysql_db_query("charts", $sql_select);
while($row = mysql_fetch_array($result))
{
  extract ($row);
  

	$plazierung ++;
	$vorklicks = $vorklicks-1;
	if ($visible == 0)
	{
	$plazierung = 0;
	}

	$sql_update = "INSERT INTO chartstemp (interpret, titel, klicks, vorwoche, visible, freizeit, freidatum, indatum, inzeit) VALUES ('$interpret', '$titel', '$vorklicks', '$plazierung', 1, '$freidatum', '$freizeit', '$datum', '$uhrzeit')  ";
	$sql_exe_update = mysql_db_query("charts", $sql_update);	
  

	
	
}

$sql_del = "DROP TABLE charts";

$sql_exe_del = mysql_db_query("charts", $sql_del);
$sql_rename = "RENAME TABLE chartstemp TO charts";
$sql_exe_rename = mysql_db_query("charts", $sql_rename);
$override= fopen("counter.x", "w");
fclose($override); 
$EndTime = microtime(true);
$Time = $EndTime - $StartTime;
echo ("<br /><br />Aktualisierung Abgeschlossen in " . $Time . " Sekunden");

?>




