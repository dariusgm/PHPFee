<?php

function filter($var)
{
$temp_var= mysql_escape_string(htmlspecialchars($var)); 

return $temp_var; 
}

function unfilter($var)
{
$temp_var= stripslashes(htmlspecialchars($var)); 

return $temp_var; }

function get_utf($text)
{
$suchmuster[0] = '.&auml;.';
$suchmuster[1] = '.&Auml;.';
$suchmuster[2] = '.&ouml;.';
$suchmuster[3] = '.&Ouml;.';
$suchmuster[4] = '.&uuml;.';
$suchmuster[5] = '.&Uuml;.';
$suchmuster[6] = '.&szlig;.';
$suchmuster[7] = ".'.";

$ersetzungen[0] = '&auml;';
$ersetzungen[1] = '&Auml;';
$ersetzungen[2] = '&ouml;';
$ersetzungen[3] = '&Ouml;';
$ersetzungen[4] = '&uuml;';
$ersetzungen[5] = '&Uuml;';
$ersetzungen[6] = '&szlig;';
$ersetzungen[7] = '&#x60;';

return preg_replace($suchmuster, $ersetzungen, $text);
		
}


//Berechtigung f&uuml;r die Einzelnen Bereiche
function checkstatus($p)
{
     
	  if (isset($_SESSION["nick"]))
  { $nickname = $_SESSION["nick"]; }
  
  elseif (isset($_POST["userinput"]))
  { $nickname = $_POST["userinput"]; }
  
  //PW Pr&uuml;fen
  if (isset($_SESSION["pw"]))
  { $pw = $_SESSION["pw"]; }
  
  elseif (isset($_POST["passinput"]))
  { $pw = $_POST["passinput"]; }
  
	   @$db=mysql_connect("localhost","portal","psacln");
	   @$sql="SELECT ".$p." AS status FROM user WHERE nick='".$nickname."' AND pw='".$pw."'";
  @$result=mysql_db_query("portal",$sql);
   if (mysql_num_rows($result)!="1")
  { echo 'Es ist ein Unbekannter Fehler aufgetreten. Bitte benachrichtigen sie den Webmaster falls das Problem h&auml;ufiger auftritt.'; exit();}
   else
   {
   $zeile=mysql_fetch_array($result);
   extract($zeile);
	 return $status;
  } 

     

}




function get_user_id()
{
if (isset($_POST["userinput"]))
{ $nick=filter($_POST["userinput"]);}
else
{ $nick=$_SESSION["nick"]; }


if (isset($_POST["passinput"]))
{ $pw=filter($_POST["passinput"]);}
else
{ $pw=$_SESSION["pw"]; }

$sql1="SELECT id FROM user WHERE nick='".$nick."' AND pw='".$pw."' ";
$db=mysql_connect("localhost","portal","psacln");
$result1=mysql_db_query("portal",$sql1);
$zeile1=mysql_fetch_array($result1);
return $zeile1["id"];


}
	


function write_mod_log($sql,$page,$modus)
{
$sql1="INSERT INTO mod_log (sqlcmd,userid,page,modus,datum,uhrzeit,ip,hostname,proxy) VALUES (
'".filter($sql)."',
'".get_userid()."',
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