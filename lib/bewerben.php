<?php
function show_bewerbung() 
{


	if (isset($_POST["ziele"]) && isset($_POST["mo"]) && isset($_POST["di"]) && isset($_POST["mi"]) && isset($_POST["do"]) && isset($_POST["fr"]) && isset($_POST["sa"]) && isset($_POST["so"]) && isset($_POST["referrer"]))
	{
	 $text="Du hast soeben eine Bewerbung von ".$_SESSION["nick"]." erhalten.<br />
	 Was sind deine Zeile?<br />
	 ".filter($_POST["ziele"])."<br />
	 Woher kennst du uns?<br />
	 ".filter($_POST["referrer"])."	 <br />
	 Mo : ".filter($_POST["mo"])."<br />
	 Di : ".filter($_POST["di"])."<br />
	 Mi : ".filter($_POST["mi"])."<br />
	 Do : ".filter($_POST["do"])."<br /> 	 
	 Fr : ".filter($_POST["fr"])."<br />
	 Sa : ".filter($_POST["sa"])."<br />
	 So : ".filter($_POST["so"])."<br /> Dies ist eine automatisch generierte Email, <br /><br /><i>PHP-FEE</i>";	 	 
	 
	$extra    = "From: test@test.com\n";
    $extra   .= "Content-Type: text/html\nContent-Transfer-Encoding: 8bit\n";
    
	$sql1="SELECT email FROM user WHERE bewerbung_level>9";
	$db = mysql_connect("localhost", "portal", "psacln") or die("Verbindungsfehler");
	$result1=mysql_db_query("portal",$sql1);
	while($zeile1=mysql_fetch_array($result1))
	{
		mail($zeile1["email"], "Eine neue Bewerbung ist soeben eingetroffen", $text, $extra);
				
    }
	echo '<u><b><span style="color:red;">Deine Bewerbung wurde &Uuml;bermittelt und wird binnen 48h von uns bearbeitet.</span></b></u><br /><br />';
    }
    else {
	
	
    echo '<span style="font-size:2em;">Du:</span>    
    
    <ul type="circle">
<li>bist offen und aufgeschlossen f&uuml;r verschiedene Musikrichtungen  </li>
<li>hast schon Erfahrung oder m&ouml;chtest es ausprobieren  </li>
<li>hast es schon immer gemocht Menschen zu unterhalten  </li>
<li>hast Spa&szlig; daran Menschen mit deiner Musik und Unterhaltung zu fesseln  </li>
<li>bist teamf&auml;hig und motiviert     </li>
<li>hast Lust, Deine eigenen Ideen einzubringen und zu entwickeln   </li>
<li>besitzt die ben&ouml;tigte Technik zum Streamen </li>
<li>DSL Anschluss mit mindestens 2000 kb</li> 
<li>Streamprogramm wie BPM Studio, DSP, SAM, etc. </li>
<li>Computer mit einer Leistung von mindestens 1200 MHZ und mindestens 512 MB Arbeitsspeicher</li> 
<li>ausgepr&auml;gtes Musikarchiv </li>
<li>Software TeamSpeak und einen installierten MSN Messenger </li>
<li>Mikrofon bzw. Headset der besseren Klasse</li> </ul>
   Wenn du dich angsprochen f&uuml;hlst..nur Mut...bewirb Dich. Wir bieten erfahrenen Moderatoren Raum zur Entfaltung, 

ebenso "Greenhorns" die M&ouml;glichkeit sich auszuprobieren...und zu entwickeln.

Bewerbungsbogen vollst&auml;ndig ausf&uuml;llen und abschicken, wir werden uns schnellst m&ouml;glich bei Dir melden.
<br /><br />
<span style="font-size:2em;">Wir:</span>
    <ul>
      <li>sind ein motiviertes Team, das gemeinsam an  einem Strang zieht</li>
      <li>bieten Dir h&ouml;chst m&ouml;gliche  Integrationsm&ouml;glichkeit</li>
      <li>wollen neben der Arbeit den Spa&szlig; nicht vergessen</li>
      <li>verf&uuml;gen &uuml;ber einen treuen H&ouml;rerstamm, den wir  erweitern m&ouml;chten</li>
      <li>stehen neuen Ideen aufgeschlossen gegen&uuml;ber</li>
      <li>haben nur EIN Motto!</li></ul><br />';
      
      
if (isset($_SESSION["id"]))
{  echo '<b>Alle Felder m&uuml;ssen ausgef&uuml;lt sein !</b><form method="post" action="bewerben.htm"><table><tr><td>Was sind deine Ziele bei DCR ?</td><td><textarea name="ziele" cols="25" rows="5"></textarea></td></tr>
  <tr><td>Woher kennst du uns ?</td><td><textarea name="referrer" cols="25" rows="5"></textarea></td></tr>
  <tr><td colspan="2">Wann kannst du am besten Senden ? (Bitte Zeitspanne in Stunden eintragen)</td></tr>

 <tr><td>Montag</td><td><input type="text" name="mo" value="von 00 bis 23" /></td></tr>
 <tr><td>Dienstag</td><td><input type="text" name="di" value="von 00 bis 23" /></td></tr>
 <tr><td>Mittwoch</td><td><input type="text" name="mi" value="von 00 bis 23" /></td></tr> 
 <tr><td>Donnerstag</td><td><input type="text" name="do" value="von 00 bis 23" /></td></tr>  
 <tr><td>Freitag</td><td><input type="text" name="fr" value="von 00 bis 23" /></td></tr>  
 <tr><td>Samstag</td><td><input type="text" name="sa" value="von 00 bis 23" /></td></tr> 
 <tr><td>Sonntag</td><td><input type="text" name="so" value="von 00 bis 23" /></td></tr>
 <tr><td><button type="submit">Abschicken  </button></td></tr></table>';
}
else
{ echo 'Leider bist du zur Zeit nicht <u><a href="registrieren.htm">registriert</a></u> oder nicht eingeloggt, um uns vor Spam zu sch&uuml;tzen ist dies jedoch erforderlich.'; }

}

	
	
}


?>

