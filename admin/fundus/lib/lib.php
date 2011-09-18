<?php

function userandpass()
{
echo '<input type="hidden" name="userinput" value="'.$_POST["userinput"].'" />
<input type="hidden" name="passinput" value="'.$_POST["passinput"].'" />';
}


function get_nick_by_id($id)
{
	$db=mysql_connect("localhost","portal","psacln");
    $sql1="SELECT nick FROM user WHERE id='".$id."'";
    $result1=mysql_db_query("portal",$sql1);
    $zeile1=mysql_fetch_array($result1);
    return $zeile1["nick"];	
}

function get_id_by_nick($nick)
{
	$db=mysql_connect("localhost","portal","psacln");
	$sql1="SELECT id FROM user WHERE nick='".filter($nick)."'";
	$result1=mysql_db_query("portal",$sql1);
	$zeile1=mysql_fetch_array($result1);
	return $zeile1["id"];
}


function get_my_id()
{   
	$db=mysql_connect("localhost","portal","psacln");
	$sql1="SELECT id FROM user WHERE nick='".filter($_POST["userinput"])."' AND pw='".filter($_POST["passinput"])."'";
	$result1=mysql_db_query("portal",$sql1);
	$zeile1=mysql_fetch_array($result1);
	return $zeile1["id"];
}


function get_mod()
{
	// Generiere Mod Drop-Down
    $sql1="SELECT id,nick FROM user WHERE portal_level<10 AND portal_level>4 ORDER BY 'nick'";
    $db = mysql_connect("localhost", "portal", "psacln") or die("Verbindungsfehler");
    $result1=mysql_db_query("portal",$sql1);
    
    
    
   $drop="";
    while($zeile1=mysql_fetch_array($result1))
    {
	    $drop.='<option value="'.$zeile1["id"].'">'.$zeile1["nick"].'</option>';
    } 
   
    
    $sql2="SELECT id,nick FROM user WHERE portal_level>10 ORDER BY 'nick'";
    $result2=mysql_db_query("portal",$sql2);
    
    // Generiere Admin Drop-Down
    $drop.='<option value="0">----Admins----</option>';
   
    while($zeile2=mysql_fetch_array($result2))
    {
	    $drop.='<option value="'.$zeile2["id"].'">'.$zeile2["nick"].'</option>';
    } 
// Drop Ende

return $drop;
}


function get_geschenke()
{
	$db=mysql_connect("localhost","portal","psacln");	
	$sql1="SELECT id,name FROM fundus_geschenke WHERE anzahl>0";
	$result1=mysql_db_query("portal",$sql1);
	$drop="";
	while($zeile1=mysql_fetch_array($result1))
	{
		$drop.='<option value="'.$zeile1["id"].'">'.$zeile1["name"].'</option>';
    }
return $drop;
}
	   

function get_geschenk_by_id($id)
{
	$db=mysql_connect("localhost","portal","psacln");
	$sql1="SELECT name FROM fundus_geschenke WHERE id='".filter($id)."'";
	$result1=mysql_db_query("portal",$sql1);
	$zeile1=mysql_fetch_array($result1);
	return $zeile1["name"];
}	

function show_geschenke()
{
	$db=mysql_connect("localhost","portal","psacln");
    $sql1="SELECT * FROM fundus_geschenke ORDER BY 'name'";
    $result1=mysql_db_query("portal",$sql1);
    echo '<table><tr><td>Name</td><td>Beschreibung</td><td>Anzahl</td><td>Sponsor</td><td>Spon. URL</td><td>Spon. User</td><td>Kosten</td></tr>';
    while($zeile1=mysql_fetch_array($result1))
    {	
	    echo '<form method="post" action="index.php?x=geschenke"><tr><td><input type="hidden" name="editid" value="'.$zeile1["id"].'" />';
	    echo '<input type="text" name="name" value="'.$zeile1["name"].'" /></td>';
	    echo '<td><input type="text" name="beschreibung" value="'.$zeile1["beschreibung"].'" /></td>
        <td><input type="text" name="anzahl" value="'.$zeile1["anzahl"].'" /></td>
        
        <td><input type="text" name="sponsor_name" value="'.$zeile1["sponsor_name"].'" /></td>        
        <td><input type="text" name="sponsor_url" value="'.$zeile1["sponsor_url"].'" /></td><td>';   
        echo get_nick_by_id($zeile1["sponsor_userid"]);
	    echo '</td><td><input type="text" name="kosten" value="'.$zeile1["kosten"].'" /></td>';
	    userandpass();
	    echo '<td><button type="submit">Speichern</button></tr></form>';
	  
    }
    echo '</table>';
}









function show_adressen()
{
	$db=mysql_connect("localhost","portal","psacln");
    $sql1="SELECT * FROM fundus_adressen ORDER BY 'userid'";
    $result1=mysql_db_query("portal",$sql1);
    echo '<table><tr><td>Nick</td><td>Vorname</td><td>Nachname</td><td>Stra&szlig;e</td><td>Haus Nr.</td><td>PLZ</td><td>Ort</td><td>Land</td><td>Diverses</td><td></td></tr>';
    while($zeile1=mysql_fetch_array($result1))
    {	
	    echo '<form method="post" action="index.php?x=adressen"><tr><td><input type="hidden" name="edituser" value="'.$zeile1["userid"].'" />';
	    echo get_nick_by_id($zeile1["userid"]);
	    echo '</td><td><input type="text" name="vorname" value="'.$zeile1["vorname"].'" /></td>';
	    echo '<td><input type="text" name="nachname" value="'.$zeile1["nachname"].'" /></td>
	    <td><input type="text" name="strasse" value="'.$zeile1["strasse"].'" /></td>
	    <td><input type="text" name="hausnr" value="'.$zeile1["hausnr"].'" /></td>
	    <td><input type="text" name="plz" value="'.$zeile1["plz"].'" /></td>
	    <td><input type="text" name="ort" value="'.$zeile1["ort"].'" /></td>
	    <td><input type="text" name="land" value="'.$zeile1["land"].'" /></td>
	    <td><input type="text" name="diverses" value="'.$zeile1["diverses"].'" /></td>';
	    userandpass();
	    echo '<td><button type="submit">Speichern</button></tr></form>';
	  
    }
    echo '</table>';
}




function show_uebersicht()
{   
	$db=mysql_connect("localhost","portal","psacln");	
	$sql1="SELECT * FROM fundus ORDER BY 'status'";
	$result1=mysql_db_query("portal",$sql1);
	echo '<table border="1" cellspacing="3"><tr><td>ID</td><td>S</td><td>Gewinner/<br />Mod</td><td>Gewinn</td><td>Verlost von</td><td>...am</td><td>...um</td><td>Versendet von</td><td>...am</td><td>...um</td><td>...Kosten</td><td>Ge&auml;ndert von:</td></tr>';
		while($zeile1=mysql_fetch_array($result1))
	{
		echo '<tr><td>'.$zeile1["id"].'</td>
		<td style="background-color:';
				
		if ($zeile1["status"]==1)
		{ 
		echo '#00FFFF';		
		echo '">'.$zeile1["status"].'</td>';
		echo '<td style="background-color:#00FFFF">'.get_nick_by_id($zeile1["userid"]).'</td>';
		echo '<td style="background-color:#00FFFF">'.get_geschenk_by_id($zeile1["itemid"]).'</td><td colspan="8" style="background-color:#00FFFF"></td>'; 
		echo '<td style="background-color:#00FFFF"><form method="post" action="index.php?x=uebersicht"><button type="submit" style="background-color:#00FFFF">Freigeben</button>';
		userandpass();
		echo '<input type="hidden" name="freeid" value="'.$zeile1["id"].'" /></form></td></tr>';
		}
		
		if ($zeile1["status"]==2)
		{
			
		echo '#FF00FF';		
		echo '">'.$zeile1["status"].'</td>';
		echo '<td style="background-color:#FF00FF">'.get_nick_by_id($zeile1["userid"]).'</td>';
		echo '<td style="background-color:#FF00FF">'.get_geschenk_by_id($zeile1["itemid"]).'</td>'; 
		echo '<td style="background-color:#FF00FF">'.get_nick_by_id($zeile1["verlosung_userid"]).'</td>';
		echo '<td style="background-color:#FF00FF">'.$zeile1["verlosung_am"].'</td>';
		echo '<td style="background-color:#FF00FF">'.$zeile1["verlosung_um"].'</td>';
		echo '<form method="post" action="index.php?x=uebersicht"><td colspan="3" style="background-color:#FF00FF"><select name="versendet_userid">'.get_mod().'</select></td>';	
		echo '<td style="background-color:#FF00FF"><input type="text" name="versendet_kosten" value="" /></td>';	
		echo '<td style="background-color:#FF00FF">'.get_nick_by_id($zeile1["edit_userid"]).'</td>';
		echo '<td style="background-color:#FF00FF"><button type="submit" style="background-color:#FF00FF">Versenden</button>';
		userandpass();
		echo '<input type="hidden" name="sendid" value="'.$zeile1["id"].'" /></form></td></tr>';
		}
			
			
		if ($zeile1["status"]==3)
		{
		echo '#FFF00F';		
		echo '">'.$zeile1["status"].'</td>';
		echo '<td style="background-color:#FFF00F">'.get_nick_by_id($zeile1["userid"]).'</td>';
		echo '<td style="background-color:#FFF00F">'.get_geschenk_by_id($zeile1["itemid"]).'</td>'; 
		echo '<td style="background-color:#FFF00F">'.get_nick_by_id($zeile1["verlosung_userid"]).'</td>';
		echo '<td style="background-color:#FFF00F">'.$zeile1["verlosung_am"].'</td>';
		echo '<td style="background-color:#FFF00F">'.$zeile1["verlosung_um"].'</td>';
		echo '<td style="background-color:#FFF00F">'.get_nick_by_id($zeile1["versendet_userid"]).'</td>';		
		echo '<td style="background-color:#FFF00F">'.$zeile1["versendet_am"].'</td>';			
		echo '<td style="background-color:#FFF00F">'.$zeile1["versendet_um"].'</td>';	
		echo '<td style="background-color:#FFF00F">'.$zeile1["versendet_kosten"].'</td>';		
		echo '<td style="background-color:#FFF00F">'.get_nick_by_id($zeile1["edit_userid"]).'</td>';		
				
	}
	  	
		
		
		

		
		
		
	}
	
	
	echo '</table>';			
}




function send_email($an,$betreff,$text)
{
              
        
  @mail($an, $betreff, $text,"From: SYSTEM <system@discollection-radio.eu>");

}       
       
       
function send_im ($von,$an,$betreff,$text)
{
	
	 
	 $sql2="INSERT INTO im (vonid,anid,datum,uhrzeit,betreff,text) VALUES (
	 '".$von."',
	 '".$an."',
	 '".date("Y-m-d")."',
	 '".date("H:i:s")."',
	 '".$betreff."',
	 '".$text."')";
  	 
	 $result=mysql_db_query("portal",$sql2);

}




function show_zuweisen()
{
	
echo '<form method="post" action="index.php?x=zuweisen"><table><tr><td>Geschenk:</td><td><select name="geschenkid">'.get_geschenke().'</select></td></tr>
<tr><td colspan="2">...Zuweisen an:</td></tr>
<tr><td>User:</td><td><select name="userid">'.get_mod().'</select></td></tr>
<tr><td><button type="submit">Zuweisen</button>';
userandpass();
echo '</td></tr></table></form>';
	
}



function do_zuweisen()
{
	if (isset($_POST["userid"]) && isset($_POST["geschenkid"]))
	{
	$sql1="UPDATE fundus_geschenke SET anzahl=anzahl-1 WHERE id='".filter($_POST["geschenkid"])."'";
	$sql2="INSERT INTO fundus (userid,edit_userid,itemid) VALUES (
	'".filter($_POST["userid"])."',
	'".get_my_id()."',
	'".filter($_POST["geschenkid"])."')";
	$db=mysql_connect("localhost","portal","psacln");
    $result1=mysql_db_query("portal",$sql1);
    $result2=mysql_db_query("portal",$sql2);
    
        if ($result1)
        {
	        if ($result2)
	        { echo '<u>Zuweisung erfolgreich abgeschlossen.</u>'; }
        }
	}
	
}	

	
function do_uebersicht()
{
	$db=mysql_connect("localhost","portal","psacln");	
	if (isset($_POST["freeid"]))
	{
		$sql1="SELECT itemid FROM fundus WHERE id='".filter($_POST["freeid"])."'";
		$result1=mysql_db_query("portal",$sql1);
		$zeile1=mysql_fetch_array($result1);
		$sql2="UPDATE SET anzahl=anzahl+1 WHERE id='".$zeile1["itemid"]."'";
		$result2=mysql_db_query("portal",$sql1);
		$sql3="DELETE FROM fundus WHERE id='".filter($_POST["freeid"])."'";
		$result3=mysql_db_query("portal",$sql3);
   }
   if (isset($_POST["sendid"]))
   {    
	    // Hole Geschenk_id, Gewinner_id
		$sql1="SELECT itemid,verlosung_userid FROM fundus WHERE id='".filter($_POST["sendid"])."'";
		$result1=mysql_db_query("portal",$sql1);
		$zeile1=mysql_fetch_array($result1);
		
		// Setzte Status auf "Versendet", Datum, Uhrzeit und Kosten Setzen
		$sql2="UPDATE fundus SET status=3,
		edit_userid='".get_my_id()."',
		versendet_userid='".filter($_POST["versendet_userid"])."', 
		versendet_am='".date("Y-m-d")."',
		versendet_um='".date("H:i:s")."' ,
		versendet_kosten='".filter($_POST["versendet_kosten"])."' 
		WHERE id='".filter($_POST["sendid"])."'";
		$result2=mysql_db_query("portal",$sql2);
		
		// Hole Nick und Email adresse des Gewinners
		$sql3="SELECT nick,email FROM user WHERE id='".$zeile1["verlosung_userid"]."'";
		$result3=mysql_db_query("portal",$sql3);
		$zeile3=mysql_fetch_array($result3);
		
		$sql4="SELECT name FROM fundus_geschenke WHERE id='".$zeile1["itemid"]."'";
		$result4=mysql_db_query("portal",$sql4);
		$zeile4=mysql_fetch_array($result4);
		
		$text="Liebe/r ".$zeile3["nick"]. ",
		Dein Preis: \"".$zeile4["name"]."\"
		wurde soeben per Post versendet. Sollte er innerhalb von 7 Werktagen nicht ankommen, melde dich bitte bei einem Fundus-Admin.
		Diesen Findest du Links in der \"Mitwirkende\" Liste. Viel Spa&szlig; noch weiterhin bei Discollection Radio!
		
		Hinwei&szlig;: Dies ist eine Automatisch generierte Nachricht. F&uuml;r R&uuml;ckfragen stehen dir die Fundus Admins zur verf&uuml;gung. E-Mail auf diese Adresse werden nicht beantwortet.";
		
		send_im(get_my_id(),$zeile1["verlosung_userid"],"Dein Preis wurde versendet",$text);
		send_email($zeile3["email"],"Dein Preis wurde versendet",$text);
       	   
    
			
   }
		
}

function do_edit_adressen()
{
$db=mysql_connect("localhost","portal","psacln");
$sql1="UPDATE fundus_adressen SET 
vorname='".filter($_POST["vorname"])."',
nachname='".filter($_POST["nachname"])."',
strasse='".filter($_POST["strasse"])."',
hausnr='".filter($_POST["hausnr"])."',
plz='".filter($_POST["plz"])."',
ort='".filter($_POST["ort"])."',
land='".filter($_POST["land"])."',
diverses='".filter($_POST["diverses"])."' 
WHERE userid='".filter($_POST["edituser"])."'";
$result1=mysql_db_query("portal",$sql1);
if ($result1)
{ echo '&Auml;nderungen &uuml;bernommen.<br />'; }
}





function do_edit_geschenke()
{
$db=mysql_connect("localhost","portal","psacln");
$sql1="UPDATE fundus_geschenke SET 
name='".filter($_POST["name"])."',
beschreibung='".filter($_POST["beschreibung"])."',
anzahl='".filter($_POST["anzahl"])."',
sponsor_name='".filter($_POST["sponsor_name"])."',
sponsor_url='".filter($_POST["sponsor_url"])."',
kosten='".filter($_POST["kosten"])."' 
WHERE id='".filter($_POST["editid"])."'";
$result1=mysql_db_query("portal",$sql1);
if ($result1)
{ echo '&Auml;nderungen &uuml;bernommen.<br />'; }
}






function do_added_adressen()
{
if (isset($_POST["nick"]))
{
	$sql1="INSERT INTO fundus_adressen (userid, vorname, nachname, strasse, hausnr, plz, ort, land, diverses) VALUES (
	'".get_id_by_nick($_POST["nick"])."',
	'".filter($_POST["vorname"])."',
	'".filter($_POST["nachname"])."',
	'".filter($_POST["strasse"])."',
	'".filter($_POST["hausnr"])."',
	'".filter($_POST["plz"])."',
	'".filter($_POST["ort"])."',
	'".filter($_POST["land"])."',
	'".filter($_POST["diverses"])."')";
	$result1=mysql_db_query("portal",$sql1);
	if ($result1)
	{ echo 'Adresse hinzugef&uuml;gt.<br />'; }
}

}

function do_added_geschenke()
{
if (isset($_POST["name"]))
{
	$sql1="INSERT INTO fundus_geschenke (name, beschreibung, anzahl, sponsor_name, sponsor_url, sponsor_userid,kosten) VALUES (
	'".filter($_POST["name"])."',
	'".filter($_POST["beschreibung"])."',
	'".filter($_POST["anzahl"])."',
	'".filter($_POST["sponsor_name"])."',
	'".filter($_POST["sponsor_url"])."',
	'".get_id_by_nick($_POST["sponsor_user"])."',
	'".filter($_POST["kosten"])."')";
	$result1=mysql_db_query("portal",$sql1);
	if ($result1)
	{ echo 'Geschenke hinzugef&uuml;gt.<br />'; }
}

}
?>