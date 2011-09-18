<?php

function show_news()
{
	$db=mysql_connect("localhost","portal","psacln");
    $sql="SELECT * FROM news_global ORDER BY 'id' DESC LIMIT 20";
    $result=mysql_db_query("portal",$sql);	
  
    echo '<table summary="News &Uuml;bersicht" frame="void" cellspacing="10" cellpadding="0"><tr><td width="90%">Titel</td><td width="10%">Eingetragen am</td></tr>';
    
    while($zeile=mysql_fetch_array($result))
   {
	   echo '<tr><td style="background-color:white;"><a href="artikel_'.$zeile["id"].'.htm" name="'.$zeile["id"].'">'.$zeile["titel"].'</a></td><td>'.substr($zeile["datum"],8,2).'.'.substr($zeile["datum"],5,2).'.'.substr($zeile["datum"],0,4).' '.$zeile["uhrzeit"].'</td></tr>';
	   

		   echo '<tr><td colspan="2">'.get_utf(nl2br($zeile["news"])).'</td></tr>';
	   }
   echo '</table>';

}


function show_artikel()
{
	$sql1="SELECT * FROM news_global WHERE id=".filter($_GET["a"])."";
	$db=mysql_connect("localhost","portal","psacln");
	 $result=mysql_db_query("portal",$sql1);	
	
	 $zeile=mysql_fetch_array($result);
	 
	 echo '<table><tr><td width="90%"><b>'.$zeile["titel"].'</b></td><td>'.substr($zeile["datum"],8,2).'.'.substr($zeile["datum"],5,2).'.'.substr($zeile["datum"],0,4).'<br />'.$zeile["uhrzeit"].'</td></tr>
	 <tr><td colspan="2"><i>'.$zeile["kurznews"].'</i><br /><br /></td></tr>
	 <tr><td colspan="2"><span style="margin-left:5%;">'.$zeile["news"].'</td></tr>	 
	 
	 </table>';
	 
	 $sql2="SELECT id FROM news_global WHERE id<".filter($_GET["a"])." ORDER BY id DESC LIMIT 1";	 
	 $sql3="SELECT id FROM news_global WHERE id>".filter($_GET["a"])." ORDER BY id ASC  LIMIT 1";

	 $result2=mysql_db_query("portal",$sql2);
	 $zeile2=mysql_fetch_array($result2); 
	 
	 $result3=mysql_db_query("portal",$sql3);
	 $zeile3=mysql_fetch_array($result3);
	 
	 echo '<br /><br /><br /><table><tr><td width="50%">';
	 if ($zeile2["id"]!=NULL) echo '<a href="artikel_'.$zeile2["id"].'.htm">Vorherigen Artikel lesen</a>';
	 echo '</td><td width="50%">';
	 if ($zeile3["id"]!=NULL) echo '<a href="artikel_'.$zeile3["id"].'.htm">N&auml;chsten Artikel lesen</a>';
	 
	 echo '</td></tr></table>';	
	 
	 echo '<br /><br /><a href="news.htm"><span style="margin:auto;">Zur&uuml;ck zur &Uuml;bersicht</span></a>';
	 
	 
}

?>