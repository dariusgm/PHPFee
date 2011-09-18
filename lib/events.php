<?php
function show_events()
{
$db = mysql_connect("localhost", "portal", "psacln") or die("Verbindungsfehler");
$sql="SELECT datum,uhrzeit,titel,text,banner FROM events WHERE datum>='".date("Y-m-d")."' ORDER BY 'datum' ASC";
$query=mysql_db_query("portal",$sql);
  if (mysql_num_rows($query)=="0")
  {
  echo 'Zur Zeit sind keine Events geplant.'; }
  else
  {
  while($zeile=mysql_fetch_array($query))
  {
	  echo '<table><tr><td width="150"><ul><li>'.substr($zeile["datum"],8,2).'.'.substr($zeile["datum"],5,2).'.'.substr($zeile["datum"],0,4).'</li></ul></td><td> Ab ';
	  if (strlen($zeile["uhrzeit"])=="8")
	  { echo substr($zeile["uhrzeit"],0,5); }
	  else
	  { echo substr($zeile["uhrzeit"],0,4); }
	  
	  
	  echo ' Uhr<td></tr>
    <tr><td colspan="2"><b>'.$zeile["titel"].'</b></tr>
    <tr><td colspan="2"><img src="./events/'.$zeile["banner"].'" /></td></tr>
   <tr><td colspan="2">'.nl2br($zeile["text"]).'</td></tr>
   </table>
   <hr />';
  }
 }
}
?>