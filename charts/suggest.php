<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
<title>Discollection-radio.de Charts &copy; Tuxi</title>
<link rel="stylesheet" type="text/css" href="http://discollection-radio.de/portal/charts/charts.css">
</head>
<body bgcolor="#D9D9D9">
<?php
/* Das Copyright liegt bei Darius "Tuxi" Murawski, Wohnhaft in Hamburg. 
Discollection-radio.de darf diese Script mit meiner Genemigung benutzen. Weitergabe in originaler, 
ver&auml;nderter Form oder in Teilen ist ohne schriftliche Einverst&auml;ndnis des Authors nicht gestattet. 
Bei Verstoﬂ gegen diese Bestimmungen erfolgt eine Anzeige. 
Der Betreiber von Discollection-radio.de erkl&auml;rt sich mit den Vereinbarungen durch die benutzung dieses
Scripts einverstanden.
*/
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
$titel = $_POST["titel"];
$interpret = $_POST["interpret"];
$fp=fopen("ip2.x","r");
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
	 echo "-<p>Sie d&uuml;erfen leider nur einmal pro Tag einen Titel vorschlagen.<br />Morgen geht es wieder ;-)</p>";
	 }	
	  else
	{
	 $userip = fopen("ip2.x", "a");
	 $ip2 = $ip."\n";
	 fputs($userip, $ip2);
	 fclose($userip); 
   $db = mysql_connect("localhost", "charts_user", "TcvbxWnH") or die("Verbindungsfehler");
   $sql_insert = "INSERT INTO userinput (titel, interpret) VALUES ('$titel',  '$interpret')";
   $sql_exe_insert = mysql_db_query("charts", $sql_insert);
	 if ($sql_exe_insert == 1)
	 {
	 echo "<br /><br /><br /><p>Ihr Vorschlag wird bearbeitet.<br />Das Discollection-Radio-Team w&uuml;nscht Ihnen noch viel Spaﬂ bei uns.</p>";
	 }
	 else
	 {
	 echo "<p>Ihre Stimme wurde leider nicht gez&auml;hlt. Bitte schreiben Sie eine E-Mail an den Webmaster<br /></p><a href=\"mailto:webmaster@discollection-radio.de\">webmaster@discollection-radio.de</a></p>";
   }
mysql_close($db);
	}






?>
</body>
</html>
