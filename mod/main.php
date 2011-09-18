  <?php
if (checkstatus("portal_level")<"5")
{ echo "<h1>Zugriff verweigert!</h1>"; }?>

<b>Willkommen...</b>
...im Moderatorenbereich!<br />
Hier findet Ihr eine &Uuml;bersicht aller f&uuml;r Euch eingerichteten Funktionen mit Untermen&uuml;s.<br />
Weitere Informationen und die Anleitungen entnehmt bitte den Beschreibungen in den einzelnen Men&uuml;s.<br />

<?php
if (checkstatus("portal_level")<"4")
{ echo "<h1>Zugriff verweigert!</h1>"; }?>
<br /><hr />News: </hr /><br />
<?php

$sql="SELECT * FROM news_intern ORDER BY 'datum' DESC";
$query=mysql_db_query("portal",$sql);

while($zeile=mysql_fetch_array($query))
{
extract($zeile);
echo '<table border="1">';
echo '<tr><td>'.$titel.'</td></tr>
<tr><td>'.$news.'</td></tr>
<tr><td>'.$author.', geschrieben: '.substr($datum,8,2).'.'.substr($datum,5,2).'.'.substr($datum,0,4).'</td></td></tr>
<tr></tr></table><hr />';
} echo "</table>"; ?>