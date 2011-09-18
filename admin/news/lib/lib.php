<?php
$db=mysql_connect("localhost","portal","psacln");
function userandpass()
{
echo '<input type="hidden" name="userinput" value="'.$_POST["userinput"].'" />
<input type="hidden" name="passinput" value="'.$_POST["passinput"].'" />';
}



function show_news()
{
$sql="SELECT * FROM news_global ORDER BY 'datum' DESC";
$query=mysql_db_query("portal",$sql);

while($zeile=mysql_fetch_array($query))
{
extract($zeile);
echo '<table border="1">';
echo '<form method="post" action="index.php?x=show">
<tr><td><input type="text" name="datum" value="'.$datum.'" /></td>
<td colspan="2"><input type="text" name="titel" value="'.$titel.'" /></td></tr>
<tr><td colspan="2"><input type="text" name="kurznews" value="'.$kurznews.'" /></td></tr>
<tr><td colspan="2"><textarea cols="50" rows="10" name="news">'.$news.'</textarea></td></tr><tr><td>';
userandpass();
echo '<input type="hidden" name="do" value="edit" />
<input type="hidden" name="id" value="'.$id.'" />';
echo '<button type="submit">Bearbeiten</button></td></tr>
</form>
<form method="post" action="index.php?x=show"><tr><td>';
userandpass();
echo '<input type="hidden" name="do" value="del" />
<input type="hidden" name="id" value="'.$id.'" />';
echo '<button type="submit">L&ouml;schen</button></form></td></tr></table><hr />';
}

}


function added_news()
{
if ($_POST["do"]=="added")
{
$uhrzeit=date("H:i:s");
$sql="INSERT INTO news_global (datum,uhrzeit,titel,kurznews,news) VALUES (
'".filter($_POST["datum"])."',
'".filter($uhrzeit)."',
'".filter($_POST["titel"])."',
'".filter($_POST["kurznews"])."',
'".filter($_POST["news"])."' )";
$query=mysql_db_query("portal",$sql);
write_admin_log($sql,"news","added");
if ($query=="1")
{echo "News hinzugef&uuml;gt.<br />";}


}
}

function del_news()
{
if ($_POST["do"]=="del")
{
$sql="DELETE FROM news_global WHERE id='".filter($_POST["id"])."'";
write_admin_log($sql,"news","del");
$query=mysql_db_query("portal",$sql);
if ($query=="1")
{ echo "Datensatz gel&ouml;scht.<br />"; }
}
}

function edit_news()
{
	if ($_POST["do"]=="edit")
	{
	$sql="UPDATE news_global SET 
	datum='".$_POST["datum"]."',
	titel='".$_POST["titel"]."',
	kurznews='".$_POST["kurznews"]."',
	news='".$_POST["news"]."' WHERE id='".filter($_POST["id"])."'";
	$result=mysql_db_query("portal",$sql);
	if ($result=="1")
{ echo "Datensatz aktualisiert.<br />"; }
}
	
}
	
	
	



?>