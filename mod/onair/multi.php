<?php
session_start();
?>

<?php require_once("../lib.php");?>

<?php if (function_exists("checkstatus"))
{
   $checkstatus=checkstatus("portal_level");
   if ($checkstatus=5 || $checkstatus>11)
   { include("./lib/lib.php");
	  
get_my_sessionid();
$sql1="SELECT * FROM grusbox_user_config WHERE userid='".$_SESSION["id"]."'";
$db=mysql_connect("localhost","portal","psacln"); 
$result1=mysql_db_query("portal",$sql1);	
// Wenn keine Konfiguration vorhanden ist, erstelle eine mit Standarteinstellungen
if (mysql_num_rows($result1)==0)
	{
	 $sql2="INSERT INTO grusbox_user_config (userid) VALUES ('".filter($_SESSION["id"])."')";
	 $result2=mysql_db_query("portal",$sql2);
	 $zeile1["banner"]=1;
	 $zeile1["onair"]=1;
	 $zeile1["refresh"]=2;
	 $zeile1["sort"]=1;
			
    }
    else {$zeile1=mysql_fetch_array($result1);}
    
    	    
	   
echo '
<form method="post" action="multiuser_check.php">
<table width="250">';
echo '<tr><td><span style="font-size:18px;color:black;">Refreshrate:</span></td><td><input type="text" name="refresh" value="'.$zeile1["refresh"].'" maxsize="2" size="2" />Minuten</td></tr>'; 	 
    echo '<tr><td><span style="font-size:18px;color:black;">Sortierreinfolge:</span></td><td><select name="sort">';
   
     if ($zeile1["sort"]==1)
    { echo '<option value="1">Oben <b>NEUE</b> Eintr&auml;ge</option><option value="0">Oben <b>ALTE</b> Eintr&auml;ge</option>';}
    else
     { echo '<option value="0">Oben <b>ALTE</b> Eintr&auml;ge</option><option value="1">Oben <b>NEUE</b> Eintr&auml;ge</option>';}
   
     	echo '</select></td></tr>';

echo '<tr><td><span style="font-size:18px;color:black;">Stream: </span></td><td><select name="streamid"><option value="1">Stream 1</option><option value="2">Stream 2</option><option value="3">Stream 3</option></select></td></tr>
<tr><td colspan="2"><button type="submit">Multiuser betreten</button></td></tr></table></form>';

  
   }
   else
   {
   echo '<h1>Zugriff verweigert.</h1> ';
   exit();
   }
}
else
{
echo '<h1>Zugriff verweigert.</h1> ';
exit();
}


?>


