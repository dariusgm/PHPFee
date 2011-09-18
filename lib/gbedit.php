<?php
// visible : 1= Public, 3= Privat, (6=Admin Melden)

function do_gb() 
{
 if (is_numeric(filter($_POST["editid"])) && filter($_POST["editid"])!=0)
 {	
   $sql1="SELECT anid FROM gb WHERE id='".filter($_POST["editid"])."'";
   $db = mysql_connect("localhost", "portal", "psacln") or die("Verbindungsfehler");
   $result1=mysql_db_query("portal",$sql1);
   $zeile1=mysql_fetch_array($result1);
   if ($zeile1["anid"]!=$_SESSION["id"])
   {
   	   echo 'Sie sind nicht Berechtigt Operationen mit dieser Eintrag auszuf&uuml;hren.'; 
   }
   else
   {
	   
	    if (filter($_POST["do"])=="10")
	    $sql2="DELETE FROM gb WHERE id='".filter($_POST["editid"])."'";
	    	write_user_log($sql2,"gbedit","do_gb");
	    $db = mysql_connect("localhost", "portal", "psacln") or die("Verbindungsfehler");
	    $result2=mysql_db_query("portal",$sql2);
		if ($result2)
		{ echo 'Dein Eintrag wurde gel&ouml;scht<br />'; }	   
		elseif (filter($_POST["do"])==1 || filter($_POST["do"])==3) 
	    {
		$sql2="UPDATE gb SET visible='".filter($_POST["do"])."' WHERE id='".filter($_POST["editid"])."'";
		$db = mysql_connect("localhost", "portal", "psacln") or die("Verbindungsfehler");
		$result2=mysql_db_query("portal",$sql2);
		if ($result2)
		{ echo 'Dein Eintrag wurde bearbeitet<br />'; }
		
        }
   }
 }


}



function show_gb_edit()
{
$sql1="SELECT id,userid,anid,datum,uhrzeit,itemid,text,visible FROM gb WHERE anid='".filter($_SESSION["id"])."' ORDER BY 'datum' AND 'uhrzeit'";
$db = mysql_connect("localhost", "portal", "psacln") or die("Verbindungsfehler");
$result1=mysql_db_query("portal",$sql1);
 if (mysql_num_rows($result1)=="0")
 { echo "Unter diesem Men&uuml;punkt kannst du deine G&auml;stebuch eintr&auml;ge Verwalten. Allerdings sind keine Eintr&auml;ge vorhanden. Je l&auml;nger du bei uns aktiv bist, desto wahrscheinlicher ist es das dir jemand etwas in deinem G&auml;stebuch hinterl&auml;&szlig;"; }
 else
 {
	 echo '<table cellpadding="2"><tr><td></td><td></td></tr>';
	 
	while($zeile1=mysql_fetch_array($result1))
	{
		
		$sql2="SELECT nick FROM user WHERE id='".$zeile1["userid"]."'";
		$db = mysql_connect("localhost", "portal", "psacln") or die("Verbindungsfehler");
		$result2=mysql_db_query("portal",$sql2);
		$zeile2=mysql_fetch_array($result2);
		
		
		if ($zeile1["itemid"]=="0")
		{ $item="-"; }
		else
		{ $sql3="SELECT beschreibung FROM item WHERE id='".$zeile1["itemid"]."'";
		$db = mysql_connect("localhost", "portal", "psacln") or die("Verbindungsfehler");
		  $result3=mysql_db_query("portal",$sql3);
		  $zeile3=mysql_fetch_array($result3);
		  $item=get_utf($zeile3["beschreibung"]); 
		}
		  
		
		echo '<form method="post" action="index.php?x=gbedit"><tr><td width="320">';
		if ($zeile1["visible"]=="1")
		{ echo '&Ouml;ffentliche Eintrag'; }
		if ($zeile1["visible"]=="3")
		{ echo 'Privater Eintrag'; }		
		
		echo '<br />'.$zeile1["text"].'</td><td>Von: '.$zeile2["nick"].'<br />Geschenk: '.$item.'<br />Versendet: '.substr($zeile1["datum"],8,2).'.'.substr($zeile1["datum"],5,2).'.'.substr($zeile1["datum"],0,4).' '.$zeile1["uhrzeit"].'
		<br /><select name="do">';
		
		if ($zeile1["visible"]==1)
		{ echo '<option value="1">&Ouml;ffentlich</option><option value="3">Privat</option><option value="10">L&ouml;schen</option>'; }
		
		if ($zeile1["visible"]==3)
		{ echo '<option value="3">Privat</option><option value="1">&Ouml;ffentlich</option><option value="10">L&ouml;schen</option>'; }
				 		
		
		
		echo '</select><button type="submit">Ausf&uuml;hren</button><input type="hidden" name="editid" value="'.$zeile1["id"].'" /></td>
        </tr></form>
        <tr><td colspan="2"><hr /></td></tr>';
		
    }

    echo '</table>';
    
    
 }
    
}


?>