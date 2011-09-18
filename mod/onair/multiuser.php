<?php
session_start();
// Prüfe Ob Zugang
	include("./lib/lib.php");
	include("../lib.php");
	$db=mysql_connect("localhost","portal","psacln"); 
$sql2="SELECT multi1,multi2,multi3,multi4,multi5 FROM grusbox_config WHERE stream='".filter($_SESSION["stream"])."'";
		$result2=mysql_db_query("portal",$sql2);
		$zeile2=mysql_fetch_array($result2);
	
		
		$ok=false;
		if (($zeile2["multi1"]==$_SESSION["id"]) || ($zeile2["multi2"]==$_SESSION["id"]) || ($zeile2["multi3"]==$_SESSION["id"]) || ($zeile2["multi4"]==$_SESSION["id"]) || ($zeile2["multi5"]==$_SESSION["id"]))
		{ $ok=true;}

		
		if ($ok==false)
		{ echo ' User konnte nicht Identifiziert werden, oder Master User hat die On Air Box beendet. ';
			exit(); }
			

			
	
$sql1="SELECT * FROM grusbox_live WHERE stream='".$_SESSION["stream"]."' AND art!=0 ORDER BY 'id'";
	   if ($_SESSION["sort"]==1)
	   { $sql1.=" DESC"; }
	$result1=mysql_db_query("portal",$sql1);
	
    if(mysql_num_rows($result1)>0)
    {	   
	echo '<head><meta http-equiv="refresh" content="';
    echo $_SESSION["refresh"]*60;
    echo '"; url="grusbox.php"; /> <meta http-equiv="content-type" content="text/html; charset=UTF-8"><title>'.mysql_num_rows($result1).' Eintr&auml;ge Gru&szlig;box 4.0</title></head>
	
	
	<table border="0" cellspacing="0" cellpadding="0" style="background-color:#808080;"><tr><td width="50">ID</td><td width="100">User</td><td width="250">Text</td><td width="250">Eingangszeit</td><td width="75">IP</td><td></td></tr>';
    
	$color=0;
	$color1="#4169E1;";
	$color2="#6B8E23;";
	while($zeile1=mysql_fetch_array($result1))
    {
	    echo '<tr style="background-color:';
	    
	    if ($color==0) {echo $color1; $color=1;}
	    else {echo $color2; $color=0;}
	    
	    echo '"><td><span style="font-family:\'Arial Black\';font-size:12px;">'.$zeile1["id"].'</span></td><td><span style="font-family:\'Arial\';font-size:18px;">'.get_nick_by_id($zeile1["userid"]).'</span></td><td><span style="font-family:\'Arial Black\';font-size:14px;">'.get_utf(unfilter($zeile1["in_text"])).'</span></td><td><span style="font-family:\'Arial\';font-size:13px;">'.date("H:i:s d.m.Y",$zeile1["in_time"]).'</span></td><td><span style="font-family:\'Arial\';font-size:13px;">'.$zeile1["ip"].'</span></td><td></td></tr>';
	    	
	
    }
    
    echo '</table>';
	}
    else
    {   
	    echo '
	<html><head> 
    <meta http-equiv="refresh" content="';
   echo 60*$_SESSION["refresh"];
   echo '"; url="multiuser.php"; /> <meta http-equiv="content-type" content="text/html; charset=UTF-8"><title>0 Eintr&auml;ge - On Air Box 4.0</title></head><body>Es sind keine Eintr&auml;ge in der On Air Box vorhanden</body></html>'; 
   }

   echo '<form method="post" action="multiuser.php"><table><tr><td>Refreshrate(1...9):</td><td><input type="text" name="new_refresh" size="2" maxsize="2" value="'.$_SESSION["refresh"].'" /></td></tr>
   <tr><td>Sortieren:</td><td><select name="new_sort">';
   
     if ($_SESSION["sort"]==1)
    { echo '<option value="1">Oben NEUE Eintr&auml;ge</option><option value="0">Oben <b>ALTE</b> Eintr&auml;ge</option>';}
    else
     { echo '<option value="0">Oben ALTE Eintr&auml;ge</option><option value="1">Oben <b>NEUE</b> Eintr&auml;ge</option>';}
   
     	echo '</select></td></tr>
   <tr><td colspan="2"><button type="submit">&Auml;ndern</button></td></tr></table></form><br /><hr /><br />
   
   <table><tr><td><form method="post" action="quit_multi.php"><button type="submit" style="font-family:\'Arial Black\';font-size:10px;color:red;">Gru&szlig;box verlassen (ausloggen)</button></form></td></tr></table>';
   			
			
			
			
			
			
			
			
