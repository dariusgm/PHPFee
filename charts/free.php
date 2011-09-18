<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
<title>Freigabe &copy; Darius "Tuxi" Murawski.</title>
</head>
<body>



<?php

$db = mysql_connect("localhost", "charts_freigabe", "6rrHBeMH") or die("Verbindungsfehler");
if (isset($_GET[delid]))
{
	 $delid=($_GET[delid]);
	 $sql_del = "DELETE FROM userinput WHERE id='$delid' "; 
   $result = mysql_db_query("charts", $sql_del);
	 if ($result == 1)
	 {
	 echo $delid;
	 echo " wurde erfollgreich gel&ouml;scht";
	 }
}
/* Das Copyright liegt bei Darius "Tuxi" Murawski, Wohnhaft in Hamburg. 
Discollection-radio.de darf diese Script mit meiner Genemigung benutzen. Weitergabe in originaler, 
ver&auml;nderter Form oder in Teilen ist ohne schriftliche Einverst&auml;ndnis des Authors nicht gestattet. 
Bei Verstoß gegen diese Bestimmungen erfolgt eine Anzeige. 
Der Betreiber von Discollection-radio.de erkl&auml;rt sich mit den Vereinbarungen durch die benutzung dieses
Scripts einverstanden.
*/
if (isset($_GET[freeid]))
{
  $freeid = ($_GET[freeid]);
	$sql_select = "SELECT * FROM userinput WHERE id='$freeid'";
	$sql_exe_select = mysql_db_query("charts", $sql_select);
	$row = mysql_fetch_array($sql_exe_select);
	extract ($row);
	 echo "<form action=\"free.php\" method=\"post\">
	 Eintrag bearbeiten:
	 <table border=1>
   <tr><td>ID</td><td>Interpret</td><td>Titel</td><td>Klicks</td></tr>
	 
	 <tr bgcolor=\"#FF0000\">
	 <td><textarea name=\"a\" cols=\"20\" rows=\"1\" readonly>" . $id  ."</textarea></td>
	 <td><textarea name=\"b\" cols=\"20\" rows=\"1\">" . $interpret  ."</textarea></td>
	 <td><textarea name=\"c\" cols=\"20\" rows=\"1\">" . $titel  ."</textarea></td>	 
	 <td><input type=\"submit\" value=\"Vor-ver&ouml;ffentlichen\"></input><td>
	 </tr></table></form><hr>";


}

if (isset($_POST[a]))

{
$id = $_POST[a];

$interpret = $_POST["b"];

$titel = $_POST["c"];

$klicks = $_POST["d"];

$datum = date("y-m-d");

$uhrzeit = date("H:i:s");



$sql_insert = "INSERT INTO charts (interpret, titel, klicks, vorwoche, freidatum, freizeit) VALUES ('$interpret',  '$titel', 0, 0,  '$datum', '$uhrzeit')";
$sql_exe_insert = mysql_db_query("charts", $sql_insert);
$sql_del = "DELETE FROM userinput WHERE id='$id'"; 
$sql_exe_del = mysql_db_query("charts", $sql_del);
if ($sql_exe_insert == $sql_exe_del)
 {
	 echo $id;
	 echo " wurde erfollgreich gel&ouml;scht und in die Charts eingetragen";
	 
   $online = fopen("counter.x", "r");
   $counterstand = fgets($online, 3);
   fclose($online); 
	 if ($counterstand == "")
	 {
	 $counterstand = 0;
	 }
	 else
	 {
   $counterstand++;
	 }
	 $online = fopen("counter.x", "w");	 
	 fwrite($online, $counterstand);
	 fclose($online);
	 
	}
	
}


	 
$sql_befehl = "SELECT * FROM userinput";
$result = mysql_db_query("charts", $sql_befehl);


echo "
<table cellspacing=5 border=1>
<tr>
<td>ID</td>
<td>Interpret</td>
<td>Titel</td>
</tr>
";
while($row = mysql_fetch_array($result))
 {
 extract ($row);
   echo "
   <tr>
	 <td><textarea name=\"\" cols=\"20\" rows=\"1\" readonly>" . $id  ."</textarea></td>
	 <td><textarea name=\"\" cols=\"20\" rows=\"1\" readonly>" . $interpret  ."</textarea></td>	 
	 <td><textarea name=\"\" cols=\"20\" rows=\"1\" readonly>" . $titel  ."</textarea></td>	 
   <td><input type=\"button\" value=\"Bearbeiten\" onClick=\"location.href='?freeid=$id'\" /></td>
	 <td><input type=\"button\" value=\"L&ouml;schen\" onClick=\"location.href='?delid=$id'\" /></td>
	 </tr>";
	 
	 
	  }
	 
 ?>
 </body></html>

	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 

