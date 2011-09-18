<table border="1">
<tr bgcolor="A2060B"><td><font color="#FFFFFF">P.</font></td><td><font color="#FFFFFF">V.</font></td><td><font color="#FFFFFF">Tendenz</font></td><td><font color="#FFFFFF">Interpret</font></td><td><font color="#FFFFFF">Titel</font></td><td></td><td></td></tr>
<?php
if ($_SERVER["HTTP_X_FORWARDED_FOR"]) {
   if ($_SERVER["HTTP_CLIENT_IP"]) {
   $ip = $_SERVER["HTTP_CLIENT_IP"];
  } else {
   $ip = $_SERVER["REMOTE_ADDR"];
  }
  $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
} else {
  if ($_SERVER["HTTP_CLIENT_IP"]) {
   $ip = $_SERVER["HTTP_CLIENT_IP"];
  } else {
   $ip = $_SERVER["REMOTE_ADDR"];
  }
}

$farbe0 = "\"#D9D9D9\"";
$farbe1 = "\"#C8C8C8\"";
$farbe2 = "\"#A2060B\"";
$col = 1;
$plazierung = 0;

/* Das Copyright liegt bei Darius "Tuxi" Murawski, Wohnhaft in Hamburg. 
Discollection-radio.de darf diese Script mit meiner Genemigung benutzen. Weitergabe in originaler, 
ver&auml;nderter Form oder in Teilen ist ohne schriftliche Einverst&auml;ndnis des Autors nicht gestattet. 
Bei Verstoß gegen diese Bestimmungen erfolgt eine Anzeige. 
Der Betreiber von Discollection-radio.de erkl&auml;rt sich mit den Vereinbarungen 
durch die Benutzung dieses Scripts einverstanden.
Der Autor beh&auml;lt sich das Recht vor die Bestimmungen jederzeit zu &auml;ndern.
*/

trim($ip);
if (isset($_GET["vote"]))
{  
  $fp=fopen("ip.x","r");
 
 while($line=fgets($fp,15)) 
 {
  {
	 $line=str_replace("\n","","$line");
	 if ($ip == $line)
	 {
	 $ipex = 1;
	 break;
	 }
	
	}
 }
	 if ($ipex == 1)
	 {
	 echo "<b>Du darfst leider nur einmal pro 24h einen Titel voten.<br />Morgen darfst du wieder ;-)</b>";
	 }	
	  else
	  {
	 $userip = fopen("ip.x", "a");
	 $ip2 = $ip."\n";
	 fwrite($userip, $ip2, 20);
	 fclose($userip); 
   $id = $_GET["vote"];
	 $db = mysql_connect("localhost", "portal", "psacln") or die("Verbindungsfehler");
   $vote = "UPDATE charts set klicks=klicks+1 where id='$id'"; 
   $result = mysql_db_query("portal", $vote);
	   if ($result == 1)
	   {
	   echo "<b>Deine Stimme wurde gez&auml;hlt.</b>";
	   }
	   else
	   {
	   echo "Es ist ein Fehler aufgetreten. Bitte schreibe eine Email an den webmaster<br /><a href=\"mailto:webmaster@discollection-radio.de\">webmaster@discollection-radio.de</a>";
	   }
		}
	 
   
	  
}


$db = mysql_connect("localhost", "portal", "psacln") or die("Verbindungsfehler");
$sql_befehl = 'SELECT * FROM `charts` ORDER BY `klicks` DESC ';
$result = mysql_db_query("portal", $sql_befehl);
while($row = mysql_fetch_array($result))
{
  extract ($row);
  
	if ($visible==1 && $plazierung<36)
	{
	
	$plazierung ++;
	if ($plazierung<36)
	{echo "<tr bgcolor=";
  switch ($col)
 {
 case 0:
 echo $farbe0;
 $col = 1;
 break;
 case 1:
 echo $farbe1;
 $col = 0;
 break;
 } 
	
	
	
	echo "><td><font color=" . $farbe2 . ">"	. $plazierung . ".</font></td><td><font color=" . $farbe2 . ">" . $vorwoche . ".</font></td><td><center><img src=";
	if ($plazierung==$vorwoche)
	{
	echo ("\"http://discollection-radio.de/portal/charts/gleich.gif\"");
	}
	
	if ($plazierung<$vorwoche)
	{
  echo ("\"http://discollection-radio.de/portal/charts/up.gif\"");
	}
   
	if ($plazierung>$vorwoche)
	{		
	if ($vorwoche==0)
	  {
	   echo ("\"http://discollection-radio.de/portal/charts/neu.gif\"");
	  }
	  else
	  {
	echo ("\"http://discollection-radio.de/portal/charts/down.gif\"");
	}}	
	echo "></center></td><td><font color=" . $farbe2 . ">" . $interpret . "</font></td><td><font color=" . $farbe2 . ">" . $titel . "</font></td><td><input type=\"button\" value=\"Vote\" onClick=\"location.href='?x=charts&vote=$id'\" /></td><td><button type=\"submit\">Vorschlagen</button></tr>";
  }
	}
}


mysql_close($db); 
?>

</table>
</body>
</html>
