<?php

function userandpass()
{
echo '<input type="hidden" name="userinput" value="'.$_POST["userinput"].'" />
<input type="hidden" name="passinput" value="'.$_POST["passinput"].'" />';
}



function show_shift()
{
	$sql1="SELECT * FROM config ORDER BY 'beschreibung'";
	$db=mysql_connect("localhost","portal","psacln");
	$result1=mysql_db_query("portal",$sql1);
	write_admin_log($sql1,"webmaster","shift");
	echo '<table><tr><td width="100">Seite</td><td>Status</td><td>Grund</td><td>Datum</td><td>Uhrzeit</td><td></td></tr>';
	while($zeile1=mysql_fetch_array($result1))
	{
    	echo '<form method="post" action="index.php?x=shift"><tr><td><input type="hidden" name="id" value="'.$zeile1["id"].'" />'.$zeile1["beschreibung"].'</td>
    	<td>';
    	
    	
    	if ($zeile1["status"])
    	{ echo '<select name="status"><option value="1">ONLINE</option><option value="0">______OFFLINE</optionen></select>'; }
    	else
    	{ echo '<select name="status"><option value="0">______OFFLINE</optionen><option value="1">ONLINE</option></select>'; }
    	    	
    	
	    
    	echo '</td>
    	<td><input type="text" name="grund" value="'.$zeile1["grund"].'" /></td>
    	<td><input type="text" name="datum" value="'.$zeile1["datum"].'" /></td>
    	<td><input type="text" name="uhrzeit" value="'.$zeile1["uhrzeit"].'" /></td><td><button type="submit">Speichern</button>';
    	userandpass();
    	echo '</tr></form>';	

    }
    echo '</table>';
}  


function do_shift()
{ 
    if (isset($_POST["status"]) && isset($_POST["grund"]) && isset($_POST["datum"]) && isset($_POST["uhrzeit"]) && isset($_POST["id"]))
    {
	$sql1="UPDATE config SET status='".filter($_POST["status"])."',grund='".filter($_POST["grund"])."',datum='".filter($_POST["datum"])."',uhrzeit='".filter($_POST["uhrzeit"])."' WHERE id='".filter($_POST["id"])."'";
    $db=mysql_connect("localhost","portal","psacln");
	$result1=mysql_db_query("portal",$sql1);
    write_admin_log($sql1,"webmaster","shift");
    if ($result1)
    { echo '<u><b>&Auml;nderungen &uuml;bernommen</u></b>'; }
	
    }	
}



function do_sql()
{
	if (isset($_POST["sql"]))
	{
	$db=mysql_connect("localhost","portal","psacln");
	$result=mysql_db_query("portal",$_POST["sql"]);
	if ($result)
    { echo '<br /><b><u>Befehle ausgefuehrt.</u></b><br />'; }

    }
    
}



function do_server()
{
	if (isset($_POST["server"]))
	{ if (system($_POST["server"])==true)
	     {echo $_POST["server"] .'<br /><b><u>Befehle ausgefuehrt.</u></b><br />';}
	
    }
}


function do_mitwirkende()
{
	
	if (isset($_POST["editid"]) && isset($_POST["id"]))
	{
		$sql1="UPDATE mitwirkende SET userid='".filter($_POST["id"])."' WHERE id='".filter($_POST["editid"])."'";
		$db=mysql_connect("localhost","portal","psacln");
		$result1=mysql_db_query("portal",$sql1);
			write_admin_log($sql1,"webmaster","mitwirkende");
		if ($result1)
		{ echo '<b><u>Änderungen gespeichert.</u></b>';}
	}
	
	
}





function show_mitwirkende()
{
$sql3="SELECT * FROM mitwirkende ORDER BY 'bereich'";
$db=mysql_connect("localhost","portal","psacln");
$result3=mysql_db_query("portal",$sql3);
echo '<table border="1"><tr><td>Nickname:</td><td>Verantwortungsbereich</td><td></td></tr>';
	
	while($zeile3=mysql_fetch_array($result3))
	{
		
	// hole aktuellen verantwortlichen
		$sql3_1="SELECT id,nick FROM user WHERE id='".$zeile3["userid"]."'";
	$result3_1=mysql_db_query("portal",$sql3_1);
	$zeile3_1=mysql_fetch_array($result3_1);    

	echo '<tr><td><form method="post" action="index.php?x=mitwirkende"><select name="id"><option value="'.$zeile3_1["id"].'">->'.$zeile3_1["nick"].'</option>';	
	
	//hole alle moeglichen
	$sql4="SELECT id,nick FROM user WHERE ".$zeile3["level"].">9";
	$result4=mysql_db_query("portal",$sql4);
	while($zeile4=mysql_fetch_array($result4))
	{
		echo '<option value="'.$zeile4["id"].'">'.$zeile4["nick"].'</option>';
    }
	
	
	echo '</select></td><td>'.$zeile3["bereich"].'</td><td><button type="submit">Speichern</button></td>';
	userandpass();
	echo '<input type="hidden" name="editid" value="'.$zeile3["id"].'" /></form></tr>';

    }
    
    echo '</table>';
    	

	
}



function show_admin_log()
{
   

   if (isset($_POST["von"]) && isset($_POST["bis"]))
   { $von=filter($_POST["von"]);
     $bis=filter($_POST["bis"]);
   }
   else
   { $von=0;
     $bis=25;
   }
		
   $sql1="SELECT * FROM admin_log ORDER BY 'id' DESC LIMIT ".$von.",".$bis."";
   $db=mysql_connect("localhost","portal","psacln");
   $result1=mysql_db_query("portal",$sql1);
   echo '<table border="1"><tr><td>id</td><td>sql</td><td>userid</td><td>page</td><td>modus</td><td>datum</td><td>uhrzeit</td><td>ip</td><td>host</td><td>proxy</td></tr>';
      while($zeile1=mysql_fetch_array($result1))
      {
	   echo '<tr><td>'.$zeile1["id"].'</td><td>'.$zeile1["sqlcmd"].'</td><td>'.$zeile1["userid"].'</td><td>'.$zeile1["page"].'</td><td>'.$zeile1["modus"].'</td><td>'.$zeile1["datum"].'</td><td>'.$zeile1["uhrzeit"].'</td><td>'.$zeile1["ip"].'</td><td>'.$zeile1["hostname"].'</td><td>'.$zeile1["proxy"].'</td></tr>';
      }	
}



function show_mod_log()
{
   

   if (isset($_POST["von"]) && isset($_POST["bis"]))
   { $von=filter($_POST["von"]);
     $bis=filter($_POST["bis"]);
   }
   else
   { $von=0;
     $bis=25;
   }
		
   $sql1="SELECT * FROM mod_log ORDER BY 'id' DESC LIMIT ".$von.",".$bis."";
   $db=mysql_connect("localhost","portal","psacln");
   $result1=mysql_db_query("portal",$sql1);
   echo '<table border="1"><tr><td>id</td><td>sql</td><td>userid</td><td>page</td><td>modus</td><td>datum</td><td>uhrzeit</td><td>ip</td><td>host</td><td>proxy</td></tr>';
      while($zeile1=mysql_fetch_array($result1))
      {
	   echo '<tr><td>'.$zeile1["id"].'</td><td>'.$zeile1["sqlcmd"].'</td><td>'.$zeile1["userid"].'</td><td>'.$zeile1["page"].'</td><td>'.$zeile1["modus"].'</td><td>'.$zeile1["datum"].'</td><td>'.$zeile1["uhrzeit"].'</td><td>'.$zeile1["ip"].'</td><td>'.$zeile1["hostname"].'</td><td>'.$zeile1["proxy"].'</td></tr>';
      }	
}




    ?>