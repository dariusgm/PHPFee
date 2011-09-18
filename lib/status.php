<?php

function get_utf($text)
{
return stripslashes(htmlspecialchars($text));
		
}



function get_smilies($text)
{
	
$b=mysql_connect("localhost","portal","psacln");
$d=mysql_select_db("portal");
$sql1="SELECT title,smilietext,smiliepath FROM forum_smilie";	
$result1=mysql_query($sql1);
while($zeile1=mysql_fetch_array($result1))
{
	$such[]=$zeile1["smilietext"];
	$er[]='<img src="./forum/'.$zeile1["smiliepath"].'" alt="'.$zeile1["title"].'" />';
	
	
	}
return str_replace($such, $er, $text);
	
}


// Filter(t) SQL Manipulationen aus $_POST anfragen aus
// 1. parameter die Zeichenfolge die gepr&uuml;ft werden soll
function filter($var)
{
$temp_var= mysql_escape_string(utf8_decode($var)); 
return $temp_var;
}


function get_bundesland($plz)
{
$db = mysql_connect("localhost", "portal", "psacln") or die("Verbindungsfehler");
$sql="SELECT bundesland FROM plz WHERE plz='".$plz."'";
$result=mysql_db_query("portal",$sql);
if (mysql_num_rows($result)=="0")
{ return false; }
$zeile=mysql_fetch_array($result);
switch ($zeile["bundesland"])
{
case "BB": return "Brandenburg"; break;
case "BE": return "Berlin"; break;
case "BW": return "Baden-W&uuml;rttemberg"; break;
case "BY": return "Bayern"; break;
case "HB": return "Bremen"; break;
case "HE": return "Hessen"; break;
case "HH": return "Hamburg"; break;
case "MV": return "Mecklenburg-Vorpommern"; break;
case "NI": return "Niedersachsen"; break;
case "NW": return "Nordrhein-Westfalen"; break;
case "RP": return "Rheinland-Pfalz"; break;
case "SH": return "Schleswig-Holstein"; break;
case "SL": return "Saarland"; break;
case "SN": return "Sachen"; break;
case "ST": return "Sachsen-Anhalt"; break;
case "TH": return "Th&uuml;ringen"; break;
		
}
	
	
}

function get_bezirk($plz)
{ $sql="SELECT bezirk FROM plz WHERE plz='".$plz."'";
$db = mysql_connect("localhost", "portal", "psacln") or die("Verbindungsfehler");
$result=mysql_db_query("portal",$sql);
if (mysql_num_rows($result)=="0")
{ return false; }

$zeile=mysql_fetch_array($result);
return $zeile["bezirk"];
}



function get_kreis($plz)
{ 
	$sql="SELECT kreis FROM plz WHERE plz='".$plz."'";
	$db = mysql_connect("localhost", "portal", "psacln") or die("Verbindungsfehler");
$result=mysql_db_query("portal",$sql);
if (mysql_num_rows($result)=="0")
{ return false; }

$zeile=mysql_fetch_array($result);
return $zeile["kreis"];
	
	}

function get_ort($plz)
{$sql="SELECT ort FROM plz WHERE plz='".$plz."'";
$db = mysql_connect("localhost", "portal", "psacln") or die("Verbindungsfehler");
$result=mysql_db_query("portal",$sql);
if (mysql_num_rows($result)=="0")
{ return false; }

$zeile=mysql_fetch_array($result);
return $zeile["ort"];}

// P = Der Bereich der Gepr&uuml;ft werden soll
function checkstatus($p)
{

  if (isset($_SESSION["id"]))
   {
	
	   $sql="SELECT ".$p." AS status FROM user WHERE id='".filter($_SESSION["id"])."'";
	   $db = mysql_connect("localhost", "portal", "psacln") or die("Verbindungsfehler");
   $result=mysql_db_query("portal",$sql);
   $zeile=mysql_fetch_array($result);

   return $zeile["status"];
	
		
   }
 	else { return -50; }
		
}

function checkpage($p)
{ 
	
	$sql1="SELECT * FROM config WHERE id='".$p."'";
	$db = mysql_connect("localhost", "portal", "psacln") or die("Verbindungsfehler");
	$result1=mysql_db_query("portal",$sql1);
	$zeile1=mysql_fetch_array($result1);
	if ($zeile1["status"]==1)
	{ return true;}
	else
	{ echo '<b>Die von ihnen angeforderte Seite ist zur Zeit nicht erreichtbar.<br />';
	     if (empty($zeile1["grund"]))
	     { $message='Die Seite befindet sich zur Zeit in der Wartung. Sie ist demn&auml;chst f&uuml;r sie wieder aufrufbar.</b>';
	     echo $message; return false;}
	     else
	     { $message='Die Seite befindet sich zur Zeit in der Wartung. '.get_utf($zeile1["grund"]).' Vorraussichtliches Ende: '.substr($zeile1["datum"],8,2).'.'.substr($zeile1["datum"],5,2).'.'.substr($zeile1["datum"],0,4).' etwa bis '.$zeile1["uhrzeit"].' Uhr. Aktuelle Serverzeit: '.date("H:i") . '</b><br /> ';
         echo $message; return false;}	     
    }
		
}


// Page= Seite die geprueft wird, $modus = unterseite, $status = status der benoetigt wird, $statuslevel = level der benoetigt wird um diese aktion auszufuehren
// status=false=> gastzugang
function allcheck($page,$modus,$status,$statuslevel)
{
	
	if ($status==false)
	{ 
	   $checkpage=checkpage($page);
       if ($checkpage==true)
       { addstats($page,$modus);
	       return true; }
       else
       { echo $checkpage; return false;}	
	}
	elseif (checkstatus($status)>=$statuslevel)
	{
	   $checkpage=checkpage($page);
       if ($checkpage==true)
       { addstats($page,$modus);
	       return true; }
       else
       { echo $checkpage; return false;}
    }
	else
	{ echo 'Zertifikatsfehler
Sie können sich derzeit nicht im Netzwerk anmelden, es ist ein unbekannter Fehler aufgetreten.
Bitte versuchen Sie es später erneut.
'; return false;}



}


function write_user_log($sql,$page,$modus)
{
	
$db=mysql_connect("localhost","portal","psacln");
$sql1="INSERT INTO user_log (sqlcmd,userid,page,modus,datum,uhrzeit,ip,hostname,proxy) VALUES (
'".filter($sql)."',
'".filter($_SESSION["id"])."',
'".$page."',
'".$modus."',
'".date("Y-m-d")."',
'".date("H:i:s")."',
'".$_SERVER["REMOTE_ADDR"]."',
 '".gethostbyaddr($_SERVER["REMOTE_ADDR"])."',
'".$_SERVER["HTTP_X_FORWARDED_FOR"]."')";
$result1=mysql_db_query("portal",$sql1);
}

DEFINE("deu","./txt/deu/"); 
// A = Admin, M = MOD, O = oeffentlich ( Public)
function include_text($path)
{
	include(deu . $path);
}
	
	
	
	



?>