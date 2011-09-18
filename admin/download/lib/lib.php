<?php
$db=mysql_connect("localhost","portal","psacln");

function userandpass()
{
echo '<input type="hidden" name="userinput" value="'.$_POST["userinput"].'" />
<input type="hidden" name="passinput" value="'.$_POST["passinput"].'" />';
}

function del_download()
{
if (isset($_POST["dateiname"]))
{
$sql="DELETE FROM download WHERE dateiname='".filter($_POST["dateiname"])."'";
 write_admin_log($sql,"download","del");
$result=mysql_db_query("portal",$sql);	
if ($result=="1")
{ 
$datei = "../../download/".filter($_POST["dateiname"])."";
unlink($datei);
echo "Datei: ".filter($_POST["dateiname"])." gel&ouml;schet"; }
else
{ echo "Fehler beim L&ouml;schen.<br />"; }
} }

//zeigt alle Downloads die in der Datenbank gespeichert sind.
function show_download()
{
$downloadpfad="http://discollection-radio.eu/download/";
$sql="SELECT * FROM download ORDER BY 'id' ASC";
$result=mysql_db_query("portal",$sql);
echo '<table border="1">';
while($zeile=mysql_fetch_array($result))
{
extract($zeile);
echo '<tr><td>'.$datum.' <br /> <b>'.$level.'</b></td><td>'.$titel.'</td><td><a href="'.$downloadpfad.$dateiname.'"><img src="download.gif" border="0" /></a></td></tr>
<tr><td>'.$count.'</td><td colspan="2" rowspan="2">'.$beschreibung.'</td></tr>';
echo '<tr><td><form method="post" action="index.php?x=show"><button type="submit">L&ouml;schen</button>';
userandpass();
echo '<input type="hidden" name="do" value="del" /><input type="hidden" name="dateiname" value="'.$dateiname.'" /></td></tr></form>';
}
echo '</table>';
}

//Anzeigen der Downloads fuer das Editieren
function show_edit_download()
{
$downloadpfad="http://discollection-radio.eu/download/";
$sql="SELECT * FROM download ORDER BY 'id' ASC";
$result=mysql_db_query("portal",$sql);
echo '<table border="1">';
while($zeile=mysql_fetch_array($result))
{
extract($zeile);
echo '<form method="post" action="index.php?x=edit"><tr><td><input type="text" name="datum"  value="'.$datum.'" /><br /> <b>';
 switch ($level) 
 {
	case 1:
	echo '<select name="level"> <option value="1" checked="checked">G&auml;ste</option><option value="2">reg. User</option> <option value="3">Moderatoren</option> <option value="4">Admins</option></select>';
  break;
  case 2:
  echo '<select name="level"> <option value="1">G&auml;ste</option><option value="2" checked="checked">reg. User</option> <option value="3">Moderatoren</option> <option value="4">Admins</option></select>';
  break;
  case 3:
  echo '<select name="level"> <option value="1">G&auml;ste</option><option value="2">reg. User</option> <option value="3" checked="checked">Moderatoren</option> <option value="4">Admins</option></select>';
  break;
  case 4:
  echo '<select name="level"> <option value="1">G&auml;ste</option><option value="2">reg. User</option> <option value="3">Moderatoren</option> <option value="4" checked="checked">Admins</option></select>';
  break;
 }

echo '</b></td><td><input type="text" name="titel" value="'.unfilter($titel).'" /></td><td><input tpye="text" name="dateiname" value="'.$dateiname.'" /></td></tr>
<tr><td>Z&auml;hler: '.$count.'</td><td colspan="2" rowspan="2"><textarea name="beschreibung" rows="10" cols="50">'.unfilter($beschreibung).'</textarea></td></tr>';
echo '<tr><td><button type="submit">&Auml;ndern</button>';
userandpass();
echo '<input type="hidden" name="do" value="edit" /><input type="hidden" name="id" value="'.$id.'" /></td></tr></form>';
}
echo '</table>';
}


function edit_download()
{
 if ($_POST["do"]=="edit")
 {
 $sql="UPDATE download SET level=".filter($_POST["level"]).", 
 datum='".filter($_POST["datum"])."', 
 dateiname='".filter($_POST["dateiname"])."', 
 titel='".filter($_POST["titel"])."', 
 beschreibung='".filter($_POST["beschreibung"])."' WHERE id=".filter($_POST["id"])."";
  write_admin_log($sql,"download","edit");  
  $result = mysql_db_query("portal",$sql);
  if ($result=="1")
  {
  echo "&auml;nderung erfolgreich abgeschlossen.<br />";
  }
  else
  { echo "Fehler beim Uebertragen.<br />"; }
 }
 else
 {
 echo "Alle Felder muessen ausgefuellt sein. Die bearbeitung wurde abgebrochen.<br />";
 }	
}
	




//F&uuml;gt neue Downloads in die Datenbank und verschiebt die Datein in das Downloadverzeichnis
function added_download()
{
set_time_limit(0);
$downloadpfad="../../download/";
$tmp_file_size = $_FILES['datei']['size'];
$tmp_file_name = $_FILES['datei']['tmp_name'];
$tmp_file_orgname = $_FILES['datei']['name'];

$error="0";
if (!empty($_POST["datum"])) // Pruefe ob das Formular bereits abgeschickt wurde ob es ein Erstes &ouml;ffnen ist
{
 if ($tmp_file_size > (50*1024*1024))//Gr&ouml;sser als 50 MB, 1 MB = 1024 KB * 1024 Bit
 { echo "Datei ist zu gro&szlig;. Bitte &uuml;ber FTP Hochladen. Accounts richtet der Webmaster ein.<br />" ;
 $error ="1";
 }
  // Datei Bereits vorhanden ?
 if (file_exists($downloadpfad.$tmp_file_orgname))
 {
 echo "Datei ist bereits auf dem Server vorhanden. Bitte l&ouml;schen sie zun&auml;chst die vorhandene Datei.<br />"; 
 $error="1";	
 }
 if ($error=="0")
 {copy($tmp_file_name, $downloadpfad.$tmp_file_orgname);
 $sql="INSERT INTO download (level, datum, dateiname, titel, beschreibung) VALUES (
 '".filter($_POST["level"])."',
 '".filter($_POST["datum"])."',
 '".filter($tmp_file_orgname)."',
 '".filter($_POST["titel"])."',
 '".filter($_POST["beschreibung"])."')";
  write_admin_log($sql,"download","added");
 $result = mysql_db_query("portal",$sql);
 if ($result=="1")
 {
 echo "&Uuml;bertragung erfolgreich abgeschlossen.<br />";
 }
 else
 { echo "Fehler beim Uebertragen.<br />"; }
 }
}

}