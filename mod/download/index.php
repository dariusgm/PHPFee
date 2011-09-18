<?php
if ($_GET["x"]=="msn")
{




$xml='<?xml version="1.0"?>
<messenger>
  <service name=".NET Messenger Service">
    <contactlist>
';
$db=mysql_connect("localhost","portal","psacln");
$sql1="SELECT msn FROM user WHERE portal_level>4 AND portal_level<10 AND msn!=''";
$result1=mysql_db_query("portal",$sql1);
if (mysql_num_rows($result1)>0)
{
  while($zeile1=mysql_fetch_array($result1))
  {
  $xml.='      <contact>'.$zeile1["msn"].'</contact>
';	
  }
}


$sql2="SELECT msn FROM user WHERE portal_level>11 AND msn!='' ";
$result2=mysql_db_query("portal",$sql2);
if (mysql_num_rows($result2)>0)
{
  while($zeile2=mysql_fetch_array($result2))
  {
  $xml.='     <contact>'.$zeile2["msn"].'</contact>
  ';	
  }
}
$xml.='    </contactlist>
  </service> 
</messenger>';


// Dateityp, der immer abgespeichert wird
header("Content-Type: text/plain");
// Dateiname
// mit Sonderbehandlung des IE 5.5
header("Content-Disposition: ".
     (!strpos($HTTP_USER_AGENT,"MSIE 5.5")?"attachment; ":"").
     "filename=kontakte.ctt");
// eigentlich ueberfluessig, hat sich aber wohl bewaehrt
header("Content-Transfer-Encoding: binary");
// Zwischenspeichern auf Proxies verhindern
// (siehe weiter unten)
header("Cache-Control: post-check=0, pre-check=0");
// Dateigröße für Downloadzeit-Berechnung
header("Content-Length: {".strlen($xml)."}");
echo $xml;
exit();	
}	
ob_start("ob_gzhandler");
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
