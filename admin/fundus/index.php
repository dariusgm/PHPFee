<?php

function get_nick_by_id_($id)
{
	$db=mysql_connect("localhost","portal","psacln");
    $sql1="SELECT nick FROM user WHERE id='".$id."'";
    $result1=mysql_db_query("portal",$sql1);
    $zeile1=mysql_fetch_array($result1);
    return $zeile1["nick"];	
}

function get_geschenk_by_id_($id)
{
	$db=mysql_connect("localhost","portal","psacln");
	$sql1="SELECT name FROM fundus_geschenke WHERE id='".$id."'";
	$result1=mysql_db_query("portal",$sql1);
	$zeile1=mysql_fetch_array($result1);
	return $zeile1["name"];
}


$csv="ID;Status;Gewinner / Mod;Geschenk;Verlost von;Versendet von;Verlost am;Verlost um;Versendet am;Versendet um;Versendungskosten;Bearbeitet von
";

if ($_GET["x"]=="down_uebersicht")
{
$db=mysql_connect("localhost","portal","psacln");
$sql1="SELECT * FROM fundus";
$result1=mysql_db_query("portal",$sql1);
while($zeile1=mysql_fetch_array($result1))
{
	$csv.="".$zeile1["id"].";".$zeile1["status"].";".get_nick_by_id_($zeile1["userid"]).";".get_geschenk_by_id_($zeile1["itemid"]).";".get_nick_by_id_($zeile1["verlosung_userid"]).";".$zeile1["verlosung_am"].";".$zeile1["verlosung_um"].";".get_nick_by_id_($zeile1["versendet_userid"]).";".$zeile1["versendet_am"].";".$zeile1["versendet_um"].";".$zeile1["versendet_kosten"].";".get_nick_by_id_($zeile1["edit_userid"])."";
}







// Dateityp, der immer abgespeichert wird
header("Content-Type: text/plain");
// Dateiname
// mit Sonderbehandlung des IE 5.5
header("Content-Disposition: ".
     (!strpos($HTTP_USER_AGENT,"MSIE 5.5")?"attachment; ":"").
     "filename=uberblick.csv");
// eigentlich ueberfluessig, hat sich aber wohl bewaehrt
header("Content-Transfer-Encoding: binary");
// Zwischenspeichern auf Proxies verhindern
// (siehe weiter unten)
header("Cache-Control: post-check=0, pre-check=0");
// Dateigröße für Downloadzeit-Berechnung
header("Content-Length: {".strlen($csv)."}");
echo $csv;
exit();	
}	
include("header.php");?>
<table cellspacing="0" cellpadding="0"><tr>
<td valign="top" width="150"><?php include("naviL.php"); ?></td>
<td valign="top" width="655"><?php 
// Pr&uuml;fe ob Dateiname angeh&auml;ngt wurde, falls ja
// Pr&uuml;fe ob die Datei Lokal vorhanden ist falls ja
// Include in die Haupttabelle
if (isset($_GET["x"]))
{
$filename = $_GET["x"];
 if (file_exists($filename . ".php"))
 {
 include($filename . ".php");
 }
 else
 {
 include("main.php");
 }
}
else
{
	include("main.php"); 
}

;?></td>
</tr>
</table>
</body></html>
