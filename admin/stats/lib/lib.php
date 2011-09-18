<?php
$db=mysql_connect("localhost","portal","psacln");





function wochentag($d)
{
$tag = date("w",mktime(1,1,1,substr($d,5,2),substr($d,8,2),substr($d,0,4)));
switch($tag)
 {
	 case 0:
	 echo "Sonntag";
	 break;
	 case 1:
	 echo "Montag";
	 break;	 
	 case 2:
	 echo "Dienstag";
	 break;
	 case 3:
	 echo "Mittwoch";
	 break;	 
	 case 4:
	 echo "Donnerstag";
	 break;
	 case 5:
	 echo "Freitag";
	 break;	 
	 case 6:
	 echo "Samstag";
	 break;
}
}


//
// LOKALE STATISTIKEN (SEITENSPEZIFISCH)
//


//Statistiken anzeigen, a= Seite, b=Modus, c=Anzahl der Eintr&auml;ge

function show_stats($a,$b,$c)
{
echo '<br />
<table border="1" width="500">
<tr><td width="250"><u>Die Letzten '.$c.' Tage:</u>';

show_past($a,$b,$c);

echo '</td><td><u>Die Besten '.$c.' Tage:</u>';
show_best($a,$b,$c);;
echo '</td></tr><tr><td><u>Die Schlechtesten '.$c.' Tage:</u><br />';

show_worse($a,$b,$c);

echo '</td><td width="250"><hr /><u>Durchschnitt aller Tage:</u>';

show_average($a,$b);

echo '<hr /><u>Gesamt aller Tage:</u>';

show_all($a,$b);

echo '<hr /></td></tr></table>';
}





// Letzten X Tage Anzeigen
function show_past($a,$b,$c)
{
$sql = "SELECT datum, views FROM stats_site WHERE pageid='".$a."' AND modus='".$b."' ORDER BY 'datum' DESC LIMIT 0,$c";
$result = mysql_db_query("portal",$sql);
echo "<table>";

while ($zeile=mysql_fetch_array($result))
{
extract($zeile);
echo '<tr><td>';
wochentag($datum);
echo '</td><td width="100">'.substr($datum,8,2).'.'.substr($datum,5,2).'.'.substr($datum,0,4).'</td><td><b>'. $views .'</b></td></tr>';
}
echo "</table>";
}



//Besten X Tage Anzeigen
function show_best($a,$b,$c)
{
$sql = "SELECT datum, views FROM stats_site WHERE pageid='".$a."' AND modus='".$b."' ORDER BY 'views' DESC LIMIT 0,$c";
$result = mysql_db_query("portal",$sql);
echo "<table>";
while ($zeile=mysql_fetch_array($result))
{
extract($zeile);
echo '<tr><td>';
wochentag($datum);
echo '</td><td width="100">'.substr($datum,8,2).'.'.substr($datum,5,2).'.'.substr($datum,0,4).'</td><td><b>'. $views .'</b></td></tr>';
}
echo "</table>";
}


//Schlechtesten X Tage Anzeigen
function show_worse($a,$b,$c)
{
$sql = "SELECT datum, views FROM stats_site WHERE pageid='".$a."' AND modus='".$b."' ORDER BY 'views' ASC LIMIT 0,$c";
$result = mysql_db_query("portal",$sql);
echo "<table>";
while ($zeile=mysql_fetch_array($result))
{
extract($zeile);
echo '<tr><td>';
wochentag($datum);
echo '</td><td width="100">'.substr($datum,8,2).'.'.substr($datum,5,2).'.'.substr($datum,0,4).'</td><td><b>'. $views .'</b></td></tr>';
}
echo "</table>";
}


//Durchschnitt aller Tage pro Seite
function show_average($a,$b)
{
$sql = "SELECT AVG(views) AS mittelwert FROM stats_site WHERE pageid='".$a."' AND modus='".$b."'";
$result = mysql_db_query("portal",$sql);
$zeile = mysql_fetch_array($result);
extract($zeile);
echo $mittelwert;
}


//Gesamt aller Tage pro Seite
function show_all($a,$b)
{
$sql = "SELECT SUM(views) AS gesamt FROM stats_site WHERE pageid='".$a."' AND modus='".$b."'";
$result = mysql_db_query("portal",$sql);
$zeile = mysql_fetch_array($result);
extract($zeile);
echo $gesamt;
}




//
// GLOBALE STATISTIKEN (SEITENWEIT)
//

//Gesamt pro Tag, letzen Tage, alle Seiten
function show_global_all($a)
{
$sql = "SELECT SUM(count) AS gesamt FROM stats WHERE datum='".$a."'";
$result = mysql_db_query("portal",$sql);
$zeile = mysql_fetch_array($result);
extract($zeile);

echo '<table><tr><td width="100">';
echo $a;
echo '</td><td>';
echo $gesamt;
echo '</td></tr></table>';
}


//Gesamt pro Tag, letzen Tage, alle Seiten
function show_global_worse()
{
$sql = "SELECT datum, SUM(count) AS count FROM `stats` GROUP BY datum ORDER BY SUM(count) ASC LIMIT 0,14";
$result = mysql_db_query("portal",$sql);
while($zeile = mysql_fetch_array($result))
{
extract($zeile);

echo '<table><tr><td width="100">';
echo $datum;
echo '</td><td>';
echo $count;
echo '</td></tr></table>';
}
}

function show_global_best()
{
$sql = "SELECT datum, SUM(count) AS count FROM `stats` GROUP BY datum ORDER BY SUM(count) DESC LIMIT 0,14";
$result = mysql_db_query("portal",$sql);
while($zeile = mysql_fetch_array($result))
{
extract($zeile);

echo '<table><tr><td width="100">';
echo $datum;
echo '</td><td>';
echo $count;
echo '</td></tr></table>';
}
}













function get_shoutcast($ip,$port)
{
$server = $ip; //hier deinen server eintragen z.b. musik.de oder 213.61.885.8
    $fp = @fsockopen($server, $port, $errno, $errstr, 30);
    
    if ($fp) {
        fputs($fp, "GET /7.html HTTP/1.0\r\nUser-Agent: XML Getter (Mozilla Compatible)\r\n\r\n");
        while(!feof($fp))
            $page .= fgets($fp, 1000);
        fclose($fp);
        $page = ereg_replace(".*<body>", "", $page);
        $page = ereg_replace("</body>.*", ",", $page);
        $numbers = explode(",", $page);
        $shoutcast_currentlisteners = $numbers[0]; //variable ueber die aktuelle anzahl der zuh&ouml;rer
        $connected = $numbers[1]; //variable zum anzeigen ob ein sender verbunden sind
        if($connected == 1) {
            $radio_status = 1; //variable zum anzeigen ob radio an ist oder nicht
            $wordconnected = "yes"; //zus&auml;tzliche variable die ich brauchte ;)
        }
        else
            $wordconnected = "no"; //zus&auml;tzliche variable die ich brauchte
        $shoutcast_peaklisteners = $numbers[2]; //variable die die anzahl der peaks angiebt
        $shoutcast_maxlisteners = $numbers[3]; //variable ueber die maximal m&ouml;gliche anzahl der zuh&ouml;rer
        $shoutcast_reportedlisteners = $numbers[4]; //
        $shoutcast_bitrate = $numbers[5]; //bitrate ;)
        $shoutcast_cursong = $numbers[6]; //aktueller song 
        $shoutcast_curbwidth = $shoutcast_bitrate * $shoutcast_currentlisteners; //gesamtbandbreite
        $shoutcast_peakbwidth = $shoutcast_bitrate * $shoutcast_peaklisteners; //gesamtpeakbandbreite
    }

## output on ##    
echo '';
if ($radio_status == 1) {
	$max="500";
	$maxstream = $shoutcast_curbwidth*1.1 * $max;
	echo 'Anzahl der H&ouml;rer: ' . $shoutcast_currentlisteners . '<br />';
	echo 'Gesamtbandbreite: ' . $shoutcast_curbwidth*1.1 . ' kb/s<br />';
	echo 'Verbrauchte Bandbreite: = ' . ((($shoutcast_curbwidth*1.1)/$maxstream)*100) . ' %<br />';
	echo 'Bitrate: ' . $shoutcast_bitrate .' kb/s <br />';
	echo 'Zuh&ouml;rer Peak: ' . $shoutcast_peaklisteners . '<br />';
	echo 'Bandbreite Peak: ' . $shoutcast_peakbwidth*1.1 . ' kb/s<br />';
	echo 'Max. m&ouml;gliche Zuh&ouml;rer: ' . $shoutcast_maxlisteners . '<br />';
	echo 'Aktueller Song: >>' . $shoutcast_cursong . '<< <br />';
}	
	else {
		echo '<h1>Sorry aber das radio ist zur zeit offline!</h1>';
}
echo '';
## output off ##
## shoutcasthack by bikky off ##
}
?>

