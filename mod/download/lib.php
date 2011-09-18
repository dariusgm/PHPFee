<?php
$db=mysql_connect("localhost","portal","psacln");


//zeigt alle Downloads die in der Datenbank gespeichert sind.
function show_mod_download()
{
$downloadpfad="http://discollection-radio.eu/download/";
$sql="SELECT * FROM download WHERE level=3 ORDER BY 'id' ASC";
$result=mysql_db_query("portal",$sql);
echo '<table border="1">';
while($zeile=mysql_fetch_array($result))
{
extract($zeile);
echo '<tr><td>'.$datum.'</b></td><td>'.$titel.'</td><td><a href="'.$downloadpfad.$dateiname.'"><img src="download.gif" border="0" /></a></td></tr>
<tr><td>'.$count.'</td><td colspan="2" rowspan="2">'.$beschreibung.'</td></tr>';

}
echo '</table>';
}

function show_mod_download_musik()
{
$sql="SELECT name,download_vorstellung,download_musik1,download_musik2,download_musik3,download_musik4,download_musik5 FROM bands ORDER BY 'id' ASC";
$result=mysql_db_query("portal",$sql);
echo '<table border="1" width="300">';
while($zeile=mysql_fetch_array($result))
{
extract($zeile);
echo '<tr><td><b>'.$name.'</b></td></tr>';

$i=false;
if (!empty($download_vorstellung))
{ echo '<tr><td><a href="../bands/'.$download_vorstellung.'">Vorstellung</td></tr>';$i=true;}

if (!empty($download_musik1))
{ echo '<tr><td><a href="../bands/'.$download_musik1.'>'.$download_musik1.'</td></tr>';$i=true;}

if (!empty($download_musik2))
{ echo '<tr><td><a href="../bands/'.$download_musik2.'>'.$download_musik2.'</td></tr>';$i=true;}

if (!empty($download_musik3))
{ echo '<tr><td><a href="../bands/'.$download_musik3.'>'.$download_musik3.'</td></tr>';$i=true;}

if (!empty($download_musik4))
{ echo '<tr><td><a href="../bands/'.$download_musik4.'>'.$download_musik4.'</td></tr>';$i=true;}

if (!empty($download_musik5))
{ echo '<tr><td><a href="../bands/'.$download_musik5.'>'.$download_musik5.'</td></tr>';$i=true;}

if ($i==false)
{echo "<tr><td>Keine Medien Vorhanden</td></tr>"; }

echo "<tr><td><hr /></td></tr>";

 
}
echo '</table>';
}