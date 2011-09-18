<?php
$db=mysql_connect("localhost","portal","psacln");
function do_edit()
{

		
$sql="UPDATE user SET gb='". filter($_POST["gb"])."',
gb_ort='". filter($_POST["gb_ort"])."',
plz='". filter($_POST["plz"])."',
land='". filter($_POST["land"])."',
sig='". filter($_POST["sig"])."',
autochat='".filter($_POST["autochat"])."',
kommunikation='".filter($_POST["kommunikation"])."',
show_nick='". filter($_POST["show_nick"])."',
show_gb='". filter($_POST["show_gb"])."',
show_ort='". filter($_POST["show_ort"])."',
show_sex='". filter($_POST["show_sex"])."',
show_plz='". filter($_POST["show_plz"])."',
show_seit='". filter($_POST["show_seit"])."',
show_email='". filter($_POST["show_email"])."',
show_foto='". filter($_POST["show_foto"])."',
show_msn='". filter($_POST["show_msn"])."',
show_icq='". filter($_POST["show_icq"])."',
show_aim='". filter($_POST["show_aim"])."',
show_yahoo='". filter($_POST["show_yahoo"])."',
show_skype='". filter($_POST["show_skype"])."',
show_gbook='". filter($_POST["show_gbook"])."',
icq='". filter($_POST["icq"])."',
msn='". filter($_POST["msn"])."',
aim='". filter($_POST["aim"])."',
yahoo='". filter($_POST["yahoo"])."',
skype='". filter($_POST["skype"])."' 
WHERE id='".filter($_SESSION["id"])."' AND nick='".filter($_SESSION["nick"])."' AND pw='".filter($_SESSION["pw"])."'";
$db = mysql_connect("localhost", "portal", "psacln") or die("Verbindungsfehler");
write_user_log($sql,"profil","edit");
$result=mysql_db_query("portal",$sql);
if($result)
{
echo "<br />Ihre &Auml;nderungen wurden gespeichert.<br />"; }
}


function show_edit()
{ 
$sql="SELECT * FROM user WHERE id='".$_SESSION["id"]."' AND nick='".$_SESSION["nick"]."'AND pw='".$_SESSION["pw"]."'";
$db = mysql_connect("localhost", "portal", "psacln") or die("Verbindungsfehler");
$result=mysql_db_query("portal",$sql);
if(mysql_num_rows($result)!="1")
{
echo "Der Datensatz konnte nicht gelesen werden. Bitte loggen Sie sich ein, um diesen Fehler zu vermeiden.<br />";
}
else
{
$zeile=mysql_fetch_array($result);
extract($zeile);
?>

Die E-Mail Adresse kann im <a href="index.php?x=email">E-Mail Men&uuml;punkt</a> ge&auml;ndert werden.
<br />
<form method="post" action="index.php?x=edit">
<input type="hidden" name="do" value="edit" />
<table border="1"><tr><td width="300">Dein Nick:</td><td><?php echo $nick; ?></td></tr>
<tr><td>Geburtsdatum:</td><td><input type="text" name="gb" value="<?php echo get_utf($gb); ?>" /></td></tr>
<tr><td>Geburtsort:</td><td><input type="text" name="gb_ort"value="<?php echo get_utf($gb_ort); ?>" /></td></tr>
<tr><td>Postleitzahl:</td><td><input type="text" name="plz" value="<?php 
// 0 Hinzuf&uuml;gen wenn nur 4 stellen vorhanden sind. 
//Anfanggsnull in der datenbank wird abgeschnitten, da als zahl gespeichert
if (strlen($plz)=="4")
{echo "0"; }
echo get_utf($plz); ?>"


 /></td></tr>
<tr><td>Land:</td><td><select name="land">
 <?php 
 
 switch ($land)
{
case "DE":  echo '<option value="DE">Deutschland</option>';
            echo '<option value="CH">Schweiz</option>';
            echo '<option value="A">&Ouml;sterreich</option>'; 
            echo '<option value="EU">Eurpoa</option>'; 
            echo '<option value="WW">Rest der Welt</option>';  
            break;

case "CH":  echo '<option value="CH">Schweiz</option>';
            echo '<option value="DE">Deutschland</option>';
            echo '<option value="A">&Ouml;sterreich</option>'; 
            echo '<option value="EU">Eurpoa</option>'; 
            echo '<option value="WW">Rest der Welt</option>';  
            break;            
            

case "A":   echo '<option value="A">&Ouml;sterreich</option>';
            echo '<option value="DE">Deutschland</option>';
            echo '<option value="CH">Schweiz</option>';
            echo '<option value="EU">Eurpoa</option>'; 
            echo '<option value="WW">Rest der Welt</option>';  
            break;                     

case "EU":  echo '<option value="EU">Eurpoa</option>'; 
            echo '<option value="DE">Deutschland</option>';
            echo '<option value="CH">Schweiz</option>';
            echo '<option value="A">&Ouml;sterreich</option>'; 
            echo '<option value="EU">Eurpoa</option>'; 
            echo '<option value="WW">Rest der Welt</option>';  
            break;            

case "WW":  echo '<option value="WW">Rest der Welt</option>';  
            echo '<option value="DE">Deutschland</option>';
            echo '<option value="CH">Schweiz</option>';
            echo '<option value="A">&Ouml;sterreich</option>'; 
            echo '<option value="EU">Eurpoa</option>'; 
            break;    
            
            
default: echo '<option value="WW">Rest der Welt</option>';  
            echo '<option value="DE">Deutschland</option>';
            echo '<option value="CH">Schweiz</option>';
            echo '<option value="A">&Ouml;sterreich</option>'; 
            echo '<option value="EU">Eurpoa</option>'; 
            break;    
                                             
 }
?>
</select></td></tr>

<?php
if ($land=="DE")
{
     echo "<tr><td>Bundesland:</td><td>";
     // Variable wird kopiert um einen Zus&auml;tzlichen Query zu sparen 
     $bundesland = get_bundesland($plz);
     if ($bundesland)
     {echo $bundesland;}
     else
     { echo "PLZ nicht gefunden"; }

     echo '</td></tr>';
          
     $bezirk = get_bezirk($plz);
     if ($bezirk!="-" && $bezirk!=false)
     { echo '<tr><td>Bezirk:</td><td>'.$bezirk.'</td></tr>'; } 

     $kreis = get_kreis($plz);
     if ($kreis!="-" && $kreis!=false)
     { echo '<tr><td>Kreis:</td><td>'.$kreis.'</td></tr>'; } 

     $ort = get_ort($plz);
     if ($ort!="-" && $ort!=false)
     { echo '<tr><td>Ort:</td><td>'.$ort.'</td></tr>'; } 
}
else
{ echo '<tr><td colspan="2">Eine genaue Bestimmmung des Wohnortes Ist Zur zeit noch nicht m&ouml;glich</td></tr>'; }

?>

<tr><td colspan="2"><hr /></td></tr>
<tr><td>Dabei Seit:</td><td><?php echo get_utf($seit); ?></td></tr>
<tr><td>E-Mail:</td><td><input type="text" name="email" value="<?php echo get_utf($email); ?>" /></td></tr>
<tr><td>Discollis:</td><td><?php echo get_utf($discollis); ?></td></tr>
<tr><td colspan="2">&Uuml;ber dich:</td></tr><tr><td colspan="2"><textarea name="sig" cols="55" rows="5"><?php echo get_utf($sig); ?></textarea></td></tr>
<tr><td colspan="2"><hr /></td></tr>
<tr><td>ICQ:</td><td><input type="text" name="icq" value="<?php echo get_utf($icq); ?>" /></td></tr>
<tr><td>MSN:</td><td><input type="text" name="msn" value="<?php echo get_utf($msn); ?>" /></td></tr>
<tr><td>AIM:</td><td><input type="text" name="aim" value="<?php echo get_utf($aim); ?>" /></td></tr>
<tr><td>Yahoo:</td><td><input type="text" name="yahoo" value="<?php echo get_utf($yahoo); ?>" /></td></tr>
<tr><td>Skype:</td><td><input type="text" name="skype" value="<?php echo get_utf($skype); ?>" /></td></tr>
<tr><td colspan="2"><hr /></td></tr>
<tr><td>Profil anzeigen?<br />Wir diese Option auf "NEIN" gestellt, ist das Profil &ouml;ffentlich nicht mehr vorhanden. Auch eine Suche nach diesem Benutzernamen ist nicht mehr m&ouml;glich</td><td><select name="show_nick">
 <?php if($show_nick==0)
 { 
 echo '<option value="0">Nein</option><option value="1">Ja</option>';
 }
 else
 {
 echo '<option value="1">Ja</option><option value="0">Nein</option>';
 }
?>
</select>
</td></tr>
<tr><td>Geburstag / Alter anzeigen?</td><td><select name="show_gb">
 <?php if($show_gb==0)
 { 
 echo '<option value="0">Nein</option><option value="1">Ja</option>';
 }
 else
 {
 echo '<option value="1">Ja</option><option value="0">Nein</option>';
 }
?>
</select></td></tr>

<tr><td>G&auml;stebuch anzeigen?</td><td><select name="show_gbook">
 <?php if($show_gbook==0)
 { 
 echo '<option value=0>Nein</option><option value="1">Ja</option>';
 }
 else
 {
 echo '<option value=1>Ja</option><option value="0">Nein</option>';
 }
?>
</select></td></tr>

<tr><td>Geburtsort anzeigen?</td><td><select name="show_gb_ort">
 <?php if($show_gb_ort==0)
 { 
 echo '<option value=0>Nein</option><option value="1">Ja</option>';
 }
 else
 {
 echo '<option value=1>Ja</option><option value="0">Nein</option>';
 }
?>
</select></td></tr>

<tr><td>Wohnort anzeigen?</td><td><select name="show_ort">
 <?php 
 switch($show_ort)
 {
  case 0:
 echo '<option value="0">Nein</option>';
 echo '<option value="1">Nur Land</option>';
 echo '<option value="2">Nur Land, Bundesland</option>'; 
 echo '<option value="3">Nur Land, Bundesland, Bezirk</option>'; 
 echo '<option value="4">Nur Land, Bundesland, Bezirk, Kreis</option>'; 
 echo '<option value="5">Alles</option>'; 
 break;
 
  case 1:
 echo '<option value="1">Nur Land</option>';
 echo '<option value="0">Nein</option>';
 echo '<option value="2">Nur Land, Bundesland</option>'; 
 echo '<option value="3">Nur Land, Bundesland, Bezirk</option>'; 
 echo '<option value="4">Nur Land, Bundesland, Bezirk, Kreis</option>';
 echo '<option value="5">Alles</option>';   
 break;
 
  case 2:
 echo '<option value="2">Nur Land, Bundesland</option>';
 echo '<option value="0">Nein</option>';
 echo '<option value="1">Nur Land</option>'; 
 echo '<option value="3">Nur Land, Bundesland, Bezirk</option>'; 
 echo '<option value="4">Nur Land, Bundesland, Bezirk, Kreis</option>';  
 echo '<option value="5">Alles</option>'; 
 break;
 
   case 3:
 echo '<option value="3">Nur Land, Bundesland, Bezirk</option>';
 echo '<option value="0">Nein</option>';
 echo '<option value="1">Nur Land</option>';
 echo '<option value="2">Nur Land, Bundesland</option>'; 
 echo '<option value="4">Nur Land, Bundesland, Bezirk, Kreis</option>';
 echo '<option value="5">Alles</option>';  
 break;
 
   case 4:
 echo '<option value="4">Nur Land, Bundesland, Bezirk, Kreis</option>'; 
 echo '<option value="0">Nein</option>';
 echo '<option value="1">Nur Land</option>';
 echo '<option value="2">Nur Land, Bundesland</option>'; 
 echo '<option value="3">Nur Land, Bundesland, Bezirk</option>';  
 echo '<option value="5">Alles</option>'; 
 break;
 
 case 5:
 echo '<option value="5">Alles</option>'; 
 echo '<option value="0">Nein</option>';
 echo '<option value="1">Nur Land</option>';
 echo '<option value="2">Nur Land, Bundesland</option>'; 
 echo '<option value="3">Nur Land, Bundesland, Bezirk</option>';   
 echo '<option value="4">Nur Land, Bundesland, Bezirk, Kreis</option>';
 break; 
 }


 
  
?>
</select></td></tr>

<tr><td>Geschlecht anzeigen?</td><td><select name="show_sex">
 <?php if($show_sex==0)
 { 
 echo '<option value="0">Nein</option><option value="1">Ja</option>';
 }
 else
 {
 echo '<option value="1">Ja</option><option value="0">Nein</option>';
 }
?>
</select></td></tr>

<tr><td>PLZ anzeigen?</td><td><select name="show_plz">
 <?php if($show_plz==0)
 { 
 echo '<option value="0">Nein</option><option value="1">Ja</option>';
 }
 else
 {
 echo '<option value="1">Ja</option><option value="0">Nein</option>';
 }
?>
</select></td></tr>

<tr><td>Autochat?*</td><td><select name="autochat">
 <?php if($autochat==0)
 { 
 echo '<option value="0">Nein</option><option value="1">Ja</option>';
 }
 else
 {
 echo '<option value="1">Ja</option><option value="0">Nein</option>';
 }
?>
</select></td></tr>

<tr><td>Bevorzugte Kommunikation?</td><td><select name="kommunikation">
 <?php if($kommunikation==0)
 { 
 echo '<option value="0">IM</option><option value="5">E-mail</option><option value="10">Beides</option>';
 }
 elseif ($kommunikation==5)
 {
 echo '<option value="5">E-mail</option><option value="10">Beides</option><option value="0">IM</option>';
 }
 else
 {
	 echo '<option value="10">Beides</option><option value="0">IM</option><option value="5">E-mail</option>';
 } 
?>
</select></td></tr>

<tr><td>Seit anzeigen?</td><td><select name="show_seit">
 <?php if($show_seit==0)
 { 
 echo '<option value="0">Nein</option><option value="1">Ja</option>';
 }
 else
 {
 echo '<option value="1">Ja</option><option value="0">Nein</option>';
 }
?>
</select></td></tr>

<tr><td>E-Mail anzeigen?</td><td><select name="show_email">
 <?php if($show_email==0)
 { 
 echo '<option value="0">Nein</option><option value="1">Ja</option>';
 }
 else
 {
 echo '<option value="1">Ja</option><option value="0">Nein</option>';
 }
?>
</select></td></tr>

<tr><td>Foto anzeigen?</td><td><select name="show_foto">
 <?php if($show_foto==0)
 { 
 echo '<option value="0">Nein</option><option value="1">Ja</option>';
 }
 else
 {
 echo '<option value="1">Ja</option><option value="0">Nein</option>';
 }
?>
</select></td></tr>

<tr><td>ICQ anzeigen?</td><td><select name="show_icq">
 <?php if($show_icq==0)
 { 
 echo '<option value="0">Nein</option><option value="1">Ja</option>';
 }
 else
 {
 echo '<option value="1">Ja</option><option value="0">Nein</option>';
 }
?>
</select></td></tr>

<tr><td>MSN anzeigen?</td><td><select name="show_msn">
 <?php if($show_msn==0)
 { 
 echo '<option value="0">Nein</option><option value="1">Ja</option>';
 }
 else
 {
 echo '<option value="1">Ja</option><option value="0">Nein</option>';
 }
?>
</select></td></tr>

<tr><td>AIM anzeigen?</td><td><select name="show_aim">
 <?php if($show_aim==0)
 { 
 echo '<option value="0">Nein</option><option value="1">Ja</option>';
 }
 else
 {
 echo '<option value="1">Ja</option><option value="0">Nein</option>';
 }
?>
</select></td></tr>

<tr><td>Skype anzeigen?</td><td><select name="show_skype">
 <?php if($show_skype==0)
 { 
 echo '<option value="0">Nein</option><option value="1">Ja</option>';
 }
 else
 {
 echo '<option value="1">Ja</option><option value="0">Nein</option>';
 }
?>
</select></td></tr>

<tr><td><button type="submit">Speichern</button></td></tr>

</table>
	
<?php	} }
?>
