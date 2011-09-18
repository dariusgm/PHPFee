<?php

// P = Der Bereich der Gepr&uuml;ft werden soll
function checkstatus($p)
{
	
	
if (isset($_POST["userinput"]))
{ $nick=filter($_POST["userinput"]);}
else
{ $nick=$_SESSION["nick"]; }


if (isset($_POST["passinput"]))
{ $pw=filter($_POST["passinput"]);}
else
{ $pw=$_SESSION["pw"]; }
	



  if ($nick!="" && $pw!="")
   {
	
	   $sql="SELECT ".$p." AS status FROM user WHERE nick='".$nick."' AND pw='".$pw."'";
	   $db=mysql_connect("localhost","portal","psacln");
   $result=mysql_db_query("portal",$sql);
   $zeile=mysql_fetch_array($result);

	
   return $zeile["status"];
	
		
   }
 	else { return -50; }
		
}

function checkpage($p)
{ 
	$sql1="SELECT * FROM config WHERE page='".$p."'";
	$db=mysql_connect("localhost","portal","psacln");
	$result1=mysql_db_query("portal",$sql1);
	$zeile1=mysql_fetch_array($result1);
	if ($zeile1["status"]==1)
	{ return true;}
	else
	{ echo '<b>Die von ihnen angeforderte Seite ist zur Zeit nicht erreichtbar.<br />';
	     if (empty($zeile1["grund"]))
	     { $message='Die Seite befindet sich zur Zeit in der Wartung. Sie ist demn&auml;chst f&uuml;r sie wieder aufrufbar.</b>';
	     echo $message; exit();}
	     else
	     { $message='Die Seite befindet sich zur Zeit in der Wartung.'.$zeile1["grund"].' Vorraussichtliches Ende: '.substr($zeile1["datum"],8,2).'.'.substr($zeile1["datum"],5,2).'.'.substr($zeile1["datum"],0,4).' etwa bis '.$zeile1["uhrzeit"].' Uhr. Aktuelle Serverzeit: '.date("H:i") . '</b><br /> ';
         echo $message; exit();}	     
    }
		
}


// Page= Seite die geprueft wird, $modus = unterseite, $status = status der benoetigt wird, $statuslevel = level der benoetigt wird um diese aktion auszufuehren
// status=false=> gastzugang
function allcheck($page,$status,$statuslevel)
{

	
if (checkstatus($status)>=$statuslevel)
	{
	   $checkpage=checkpage($page);
       if ($checkpage==true)
       { return true; }
       else
       { echo $checkpage; return false;}
    }
	else
	{ echo '<h1>Zugriff verweigert! Dieser Zugriff wurde Protokoliert!'; exit();}



}

function filter($var)
{
$temp_var= mysql_escape_string(htmlspecialchars($var)); 

return $temp_var; }

function unfilter($var)
{
$temp_var= stripslashes(htmlspecialchars($var)); 

return $temp_var; }



function get_user_id()
{
if (isset($_POST["userinput"]))
{ $nick=filter($_POST["userinput"]);}
else
{ $nick=$_SESSION["nick"]; }


if (isset($_POST["passinput"]))
{ $pw=filter($_POST["passinput"]); }
else
{ $pw=$_SESSION["pw"]; }

$sql1="SELECT id FROM user WHERE nick='".$nick."' AND pw='".$pw."' ";
$db=mysql_connect("localhost","portal","psacln");
$result1=mysql_db_query("portal",$sql1);
$zeile1=mysql_fetch_array($result1);
return $zeile1["id"];


}
	


function write_admin_log($sql,$page,$modus)
{
$db=mysql_connect("localhost","portal","psacln");
$sql1="INSERT INTO admin_log (sqlcmd,userid,page,modus,datum,uhrzeit,ip,hostname,proxy) VALUES (
'".filter($sql)."',
'".get_user_id()."',
'".$page."',
'".$modus."',
'".date("Y-m-d")."',
'".date("H:i:s")."',
'".$_SERVER["REMOTE_ADDR"]."',
 '".gethostbyaddr($_SERVER["REMOTE_ADDR"])."',
'".$_SERVER["HTTP_X_FORWARDED_FOR"]."')";
$result1=mysql_db_query("portal",$sql1);
}

?>