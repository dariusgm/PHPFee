<?php
function show_bands()
{
 $sql1 ="SELECT id,name,kurztext FROM bands ORDER BY 'datum' ASC";
 $dbcon=mysql_connect("localhost","portal","psacln");
 $dbdb=mysql_select_db("portal");
 $result=mysql_query($sql1);
 echo '<table>';
 while($zeile1=mysql_fetch_array($result))
 {
	 echo '<tr><td><a href="band_'.$zeile1["id"].'.htm">   '.$zeile1["name"].'</a></td><td>'.$zeile1["kurztext"].'</td></tr>';
	
	
	
	
	}

 echo '</table>';
}


function show_band()
{

$sql="SELECT datum,uhrzeit,name,text,bild_gros,download_vorstellung,link FROM bands WHERE id=".filter($_GET["a"])."";
$db = mysql_connect("localhost", "portal", "psacln") or die("Verbindungsfehler");
$result=mysql_db_query("portal",$sql);
echo '<table summary="" frame="void" cellspacing="0" cellpadding="0">';
while($zeile=mysql_fetch_array($result))
{
echo '<tr>
<td class="justwhite"> 
<img src="./bands/'.$zeile["bild_gros"].'" vspace="10" hspace="20" align="left">
<b>'.$zeile["name"].'</b>';


echo '<br />'.nl2br($zeile["text"]).'</td>
</tr>
<tr><td>&nbsp;</td></tr>';
if (!empty($zeile["download_vorstellung"]))
{ echo '<tr><td class="justwhite"><a href="./bands/'.$zeile["download_vorstellung"].'"> >> Vorstellung als MP3</a></td></tr>'; }
echo '<tr><td>Letztes Update am: '.substr($zeile["datum"],8,2).'.'.substr($zeile["datum"],5,2).'.'.substr($zeile["datum"],0,4).' um ';
	  if (strlen($zeile["uhrzeit"])=="8")
	  { echo substr($zeile["uhrzeit"],0,5); }
	  else
	  { echo substr($zeile["uhrzeit"],0,4); }


echo '</td></tr>
<tr><td><hr></td></tr>';	

}
echo '</table>';

$sql2="SELECT id FROM bands WHERE id<".filter($_GET["a"])." ORDER BY id DESC LIMIT 1";	 
	 $sql3="SELECT id FROM bands WHERE id>".filter($_GET["a"])." ORDER BY id ASC  LIMIT 1";

	 $result2=mysql_db_query("portal",$sql2);
	 $zeile2=mysql_fetch_array($result2); 
	 
	 $result3=mysql_db_query("portal",$sql3);
	 $zeile3=mysql_fetch_array($result3);
	 
	 echo '<br /><br /><br /><table><tr><td width="50%">';
	 if ($zeile2["id"]!=NULL) echo '<a href="artikel_'.$zeile2["id"].'.htm">Vorherige Band anschauen</a>';
	 echo '</td><td width="50%">';
	 if ($zeile3["id"]!=NULL) echo '<a href="artikel_'.$zeile3["id"].'.htm">N&auml;chste Band anschauen</a>';
	 
	 echo '</td></tr></table>';	
	 
	 echo '<br /><br /><a href="bands.htm"><span style="margin:auto;">Zur&uuml;ck zur &Uuml;bersicht</span></a>';
	 

}


?>