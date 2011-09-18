<?php

function do_akti()
{
 if ($_POST["do"]=="akti" || $_GET["code"]!="")
 {
   if (isset($_POST["do"]))
   { $code=filter($_POST["code"]); }
   
   elseif (isset($_GET["code"]))
   { $code=filter($_GET["code"]); }
   
   else
   { $code="";}
	 
	$db = mysql_connect("localhost", "portal", "psacln") or die("Verbindungsfehler");
	
	//
	$sql1="SELECT * FROM akti WHERE akti='".$code."'";
	$result1=mysql_db_query("portal",$sql1);
	$zeile=mysql_fetch_array($result1);
	
	#BEGINN VBULLETIN PLUG-IN
	include("./lib/vb.php");
	added_vb_user($zeile["nick"],$zeile["pw"],$zeile["email"],$zeile["sex"]);
	#END VBULLETIN PLUG-IN
		
	$sql2="INSERT INTO user (nick,pw,seit,email,sex) VALUES (
	'".$zeile["nick"]."',
	'".$zeile["pw"]."',
	'".date("Y-m-d")."',
	'".$zeile["email"]."',
	'".$zeile["sex"]."')";
	$result2=mysql_db_query("portal",$sql2);	
	
	$sql3="DELETE FROM akti WHERE akti='".$code."'";
	$result3=mysql_db_query("portal",$sql3);	
	

	

  if ($result2+$result3=="2")
   {   echo "Ihr Nick ist nun aktiviert. Viel Spa&szlig; bei uns. <br /> Ihr Discollection-Team."; }
   else
   { echo "Ihr Aktivierungscode war leider ung&uuml;ltig. Bitte achten Sie auf die genaue Schreibweise. Kopieren Sie ihn am besten aus der E-Mail."; }    
 }
 else
 {
	 echo '<form method="post" action="index.php?x=akti"><center>
	 Tragen Sie bitte einfach Ihren Aktvierungscode, den Sie per E-Mail erhalten haben, ein und schon sind Sie dabei!
 <table><tr><td><input type="text" name="code" size="15" maxlenght="15" /></td></tr>
 <tr><td><input type="hidden" name="do" value="akti" /><button type="submit">Aktivieren</button></td></tr>
 </table></center></form>';
 }
}

?>