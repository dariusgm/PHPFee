<?php
include("./lib/anti-spam.php");
function show_email() {

echo '<form method="post" action="email.htm"><table border="1">
<tr><td>An:</td><td><input type="text" name="nick" value="'; 
echo $_GET["nick"]; 
echo '" /></td><td><a href="suchen.htm">User Suchen</a></td></tr>
<tr><td>Betreff:</td><td colspan="2">Nachricht von '.$_SESSION["nick"].'</td></tr>
<tr><td colspan="3"><textarea name="text" cols="30" rows="10">Gebe hier deine Nachricht ein</textarea></td></tr>
<tr><td colspan="3">'.gen_aufgabe().'</td></tr>
<tr><td colspan="2"><button type="submit">Versenden</button></td></tr>
</table></form>';
}



function send_email()
{
	if (!empty($_POST["nick"]) && !empty($_POST["text"]))
	{
		if (check_aufgabe(1))#Pr&uuml;fe aufagabe
		{
			# Hole E-mail, ID, kommunikation des Users
			$db = mysql_connect("localhost", "portal", "psacln") or die("Verbindungsfehler");
	        $sql1="SELECT id,email,kommunikation FROM user WHERE nick='".filter($_POST["nick"])."'";
			$result1=mysql_db_query("portal",$sql1);
			if (mysql_num_rows($result1)==1)
			{ $zeile1=mysql_fetch_array($result1);
			
			
				 $sql0="SELECT grund FROM blocklist WHERE userid='".$zeile1["id"]."' AND geblockt='".filter($_SESSION["id"])."'";
	             $result0=mysql_db_query("portal",$sql0);
	             $zeile0=mysql_fetch_array($result0);
	             if (mysql_num_rows($result0)==1)
	             { echo 'Du wurdest von diesem User blockiert.<br />';
	                 if (empty($zeile0["grund"]))
	                 { echo 'Der User hat allerdings keine Begr&uuml;ndung angegeben<br />';}
	                  else
	                 { echo 'Dir wurde folgende Begr&uuml;ndung hinterlassen: '.htmlspecialchars($zeile0["grund"]).'<br />'; }
     
                 }
                 else
                 {
	                 	# Pr&uuml;fe ob versand deaktiviert
	                 
	                 	# Email senden
	                 		$extra    = "From: system@discollection-radio.eu\n";
                            $extra   .= "Content-Type: text/text\nContent-Transfer-Encoding: 8bit\n";
	                 	
	                  	if (mail($zeile1["email"], "Nachricht von ".$_SESSION["nick"]."", htmlspecialchars($_POST["text"]), $extra))
	                  	{echo '<b><u> Die E-mail wurde versendet.</u><b>';}
	                  	
	                  	if ($zeile1["kommunikation"]==0)
	                  	{ echo ' Hinwei&szlig;: Dieser Benutzer bevorzugt die Kommunikation &uuml;ber die Internen Mitteilungen. Eine Antwort k&ouml;nnte etwas mehr Zeit in Anspruch nehmen. '; }
	                 	
	                 	
	                 	
	                 	 
	             }
			
			
			
			
		}
		else
		{ echo 'Der von dir eingegebene Benutzer wurde nicht gefunden. Falls du der Meinung bist das es sich um einen Softwarefehler handelt, schreibe bitte kurz eine Nachricht &uuml;ber das <a href="kontakt.htm"> Kontaktformular</a>.'; }
		
		
		
		
		
		
	}
	else
	{ echo '<b><u>Gib bitte einen Benutzernamen und einen Text ein, um eine Nachricht zu senden.</u></b>';}
		
		
}

	
	
	
	
	
	
	
	
}




?>