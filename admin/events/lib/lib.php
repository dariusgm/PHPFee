<?php
$db=mysql_connect("localhost","portal","psacln");
function userandpass()
{
echo '<input type="hidden" name="userinput" value="'.$_POST["userinput"].'" />
<input type="hidden" name="passinput" value="'.$_POST["passinput"].'" />';
}



function show_events()
{
$eventpfad="../../events/";
$sql="SELECT * FROM events ORDER BY 'datum' ASC";
$query=mysql_db_query("portal",$sql);
if (mysql_num_rows($query)=="0")
{ echo "Keine Events in der Datenbank."; }
while($zeile=mysql_fetch_array($query))
{
extract($zeile);
echo '<table border="1"><form method="post" action="index.php?x=show">';
echo '<tr><td><input type="text" name="datum" value="'.$datum.'" /></td>
<td><input type="text" name="uhrzeit" value="'.$uhrzeit.'" /></td></tr>
<tr><td colspan="2"><input type="text" name="titel" value="'.$titel.'"  size="100" maxlenght="150"/></td></tr>
<tr><td colspan="2"><img src="'.$eventpfad.$banner.'" /></td></tr>
<tr><td colspan="2"><textarea cols="50" rows="5" name="text">'.$text.'</textarea></td></tr>
<tr><td><input type="hidden" name="do" value="edit" />
<input type="hidden" name="id" value="'.$id.'" /><button type="submit">Speichern</button></td></tr>';
userandpass();
echo '</form></table>
<table border="1">
<form method="post" action="index.php?x=show"><input type="hidden" name="do" value="del" />';
userandpass();
echo '<input type="hidden" name="id" value="'.$id.'" /><tr><td><button type="submit">L&ouml;schen</button></tr></td></table></form><hr />';
}

}


function added_events()
{
if ($_POST["do"]=="added")
{
$downloadpfad="../../events/";
$tmp_file_size = $_FILES['datei']['size'];
$tmp_file_name = $_FILES['datei']['tmp_name'];
$tmp_file_orgname = $_FILES['datei']['name'];

$error="0";
if (!empty($_POST["datum"])) // Pruefe ob das Formular bereits abgeschickt wurde ob es ein Erstes &ouml;ffnen ist
{
 if ($tmp_file_size > (1*1024*1024))//Gr&ouml;sser als 1 MB, 1 MB = 1024 KB * 1024 Bit
 { echo "Datei ist zu gro&szlig;. Bitte &uuml;ber FTP hochladen. Accounts richtet der Webmaster ein.<br />" ;
 $error ="1";
 }
  // Datei Bereits vorhanden ?
 if (file_exists($downloadpfad.$tmp_file_orgname))
 {
 echo "Datei ist bereits auf dem Server vorhanden. Bitte l&ouml;schen Sie zun&auml;chst die vorhandene Datei.<br />"; 
 $error="1";	
 }
 if ($error=="0")
 { echo $tmp_file_orgname;
	 copy($tmp_file_name, $downloadpfad.$tmp_file_orgname);
 $sql="INSERT INTO events (datum, uhrzeit, titel, banner, text) VALUES (
 '".filter($_POST["datum"])."',
 '".filter($_POST["uhrzeit"])."',
 '".filter($_POST["titel"])."',
 '".filter($tmp_file_orgname)."',
 '".filter($_POST["text"])."')";
 write_admin_log($sql,"events","added");
 $result = mysql_db_query("portal",$sql);
 if ($result=="1")
 {
 echo "&Uuml;bertragung erfolgreich abgeschlossen.<br />";
 }
 else
 { echo "Fehler beim &Uuml;bertragen.<br />"; }
 }
}

}
}

function del_events()
{
$downloadpfad="../../events/";
if ($_POST["do"]=="del")
{
$sql1="SELECT banner FROM events WHERE id='".filter($_POST["id"])."'";
$query1=mysql_db_query("portal",$sql1);
$zeile=mysql_fetch_array($query1);
unlink($downloadpfad.$zeile["banner"]);	

$sql2="DELETE FROM events WHERE id='".filter($_POST["id"])."'";
 write_admin_log($sql2,"events","del");
$query2=mysql_db_query("portal",$sql2);
if ($query=="1")
{ 
	
	echo "<br />Datensatz gel&ouml;scht<br />"; }

}
}

function edit_events()
{
	if ($_POST["do"]=="edit")
{

$sql="UPDATE events SET datum='".filter($_POST["datum"])."',
uhrzeit='".filter($_POST["uhrzeit"])."',
titel='".filter($_POST["titel"])."',
text='".filter($_POST["text"])."' WHERE id='".filter($_POST["id"])."' ";
 write_admin_log($sql,"events","edit");
$query=mysql_db_query("portal",$sql);
if ($query=="1")
{echo "Event bearbeitet.<br />";}


}
}

?>