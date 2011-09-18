<?php
session_start();

// Prüfe ob er "das" überhaupt darf
if (isset($_SESSION["id"]))
{
	include("./lib/lib.php");
	include("../lib.php");
	
	$pretag_error='<span style="font-size:28px;color:red;">';
	$pretag_ok='<span style="font-size:18px;color:green;">';
	$pretag_warning='<span style="font-size:18px;color:#584BFC;">';	
	$aftertag='</span><br />';
	$error="";
	
	
	
	$sql1="SELECT portal_level FROM user WHERE id='".$_SESSION["id"]."'";
	$db=mysql_connect("localhost","portal","psacln"); 
	$result1=mysql_db_query("portal",$sql1);
	$zeile1=mysql_fetch_array($result1);
	if (($zeile1["portal_level"]<9 && $zeile1["portal_level"]>=5) || $zeile1["portal_level"]>10)
	{ 
		
		echo $pretag_ok . " User ist berechtigt diesen Bereich zu betreten. " . $aftertag;
		
		// Prüfe ob Multiuser status gegeben ist
		
		$sql2="SELECT multi1,multi2,multi3,multi4,multi5 FROM grusbox_config WHERE stream='".filter($_POST["streamid"])."'";
		$result2=mysql_db_query("portal",$sql2);
		$zeile2=mysql_fetch_array($result2);
		$ok=false;
		if ($zeile2["multi1"]==$_SESSION["id"])
		{ echo $pretag_ok . " Identifiziert als Mulituser 1 " . $aftertag; $ok=true;}
		if ($zeile2["multi2"]==$_SESSION["id"])
		{ echo $pretag_ok . " Identifiziert als Mulituser 2 " . $aftertag;$ok=true;}		
		if ($zeile2["multi3"]==$_SESSION["id"])
		{ echo $pretag_ok . " Identifiziert als Mulituser 3 " . $aftertag;$ok=true;}			
		if ($zeile2["multi4"]==$_SESSION["id"])
		{ echo $pretag_ok . " Identifiziert als Mulituser 4 " . $aftertag;$ok=true;}				
		if ($zeile2["multi5"]==$_SESSION["id"])
		{ echo $pretag_ok . " Identifiziert als Mulituser 5 " . $aftertag;$ok=true;}	
				
		 }
	else
	{ echo $pretag_error . "Syntaxfehler in der Anwendung." . $aftertag; exit(); }
	
	
	if ($ok==false)
	{ echo $pretag_error . " Sie sind auf diesem Stream nicht als Multiuser zugeordnet. " . $aftertag; exit(); }
	else
	{
		$_SESSION["stream"]=filter($_POST["streamid"]);
		$ok=true;
		// Prüfe Refresh und Sortierreinfolge
		//Pr&uuml;fe Refresh
	$refresh=strip_tags(filter($_POST["refresh"]));

	if ($refresh>=1 && $refresh<=9)
	{ echo $pretag_ok." Refresh OK ".$aftertag; 	
	$_SESSION["refresh"]=$refresh;
	 }
	else
	{ $error.=$pretag_error." Der Refreshbereich ist au&szlig;erhalb des Vorgesehenen Bereiches! ".$aftertag; $ok=false;}
	
	
	$sort=strip_tags(filter($_POST["sort"]));
	if ($sort==1 || $sort==0)
	{
		echo $pretag_ok." Sortierreinfolge OK ".$aftertag; 
		$_SESSION["sort"]=$sort;
	}
	else
	{ $error.=$pretag_error." Sortierreinfolge hat den falschen Wert! ".$aftertag; $ok=false;}	
	
	
	
	
	
	
	}
	
	
	if ($ok==false)
	{ echo $pretag_error . "Wertefehler in der Anwendung." . $aftertag; exit(); }
	else
	{ echo '<form method="post" action="multiuser.php"><button type="submit">Multiuser Menü betreten</button></form>'; }
	
}

?>
