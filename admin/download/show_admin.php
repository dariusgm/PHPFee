<?php 
if (function_exists("allcheck"))
{ allcheck("admin_download","download_level",10); }
else
{ require_once("../lib.php");
 allcheck("admin_download","download_level",10); }
?>

<?php include("./lib/lib.php");?>
<?php
$downloadpfad="http://discollection-radio.eu/download/";
$sql="SELECT * FROM download WHERE level>2 ORDER BY 'id' ASC";
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

?>