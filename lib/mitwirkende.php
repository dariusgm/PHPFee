<?php
$db=mysql_connect("localhost","portal","psacln");

function crypt_email($text)
{
$suchmuster[0] = '.@.';
$suchmuster[1] = '.-.';
$suchmuster[2] = ".\..";


$ersetzungen[0] = '&#64;';
$ersetzungen[1] = '&#45;';
$ersetzungen[2] = '&#46;';


return preg_replace($suchmuster, $ersetzungen, $text);
		
}

function show_mitwirkende()
{
    // Group by entfernt Doppelte User
	$sql1="SELECT userid FROM mitwirkende GROUP BY 'userid'";
	
	$db = mysql_connect("localhost", "portal", "psacln") or die("Verbindungsfehler");
	$result1=mysql_db_query("portal",$sql1);
	
	echo '<table cellspacing="10"><tr><td>Nick</td><td>Bereiche</td><td>E-Mail</td></tr><tr><td colspan="3">&nbsp</td></tr>';
	
	while($zeile1=mysql_fetch_array($result1))
	{	
	$sql2="SELECT nick,email FROM user WHERE id='".$zeile1["userid"]."'";
	$result2=mysql_db_query("portal",$sql2);
	$zeile2=mysql_fetch_array($result2);
	
	
	
	

		
		echo '<tr><td valign="top"><a href="index.php?x=show&nick='.$zeile2["nick"].'"><b>'.$zeile2["nick"].'</b></a></td><td>';
		
		$sql4="SELECT bereich FROM mitwirkende WHERE userid='".$zeile1["userid"]."' ORDER BY 'bereich'";
		$result4=mysql_db_query("portal",$sql4);
		
		while($zeile4=mysql_fetch_array($result4))
		{
			echo get_utf($zeile4["bereich"]) . '<br />';
			
		}
		echo '</td><td valign="top">'.crypt_email($zeile2["email"]).'</td></tr>';
		
		
    }
    
    echo '</table>';
}?>