<?php
$db=mysql_connect("localhost","portal","psacln");
function userandpass()
{
echo '<input type="hidden" name="userinput" value="'.$_POST["userinput"].'" />
<input type="hidden" name="passinput" value="'.$_POST["passinput"].'" />';
}



function show_news()
{
$sql="SELECT * FROM news_intern ORDER BY 'datum' DESC";
$query=mysql_db_query("portal",$sql);

while($zeile=mysql_fetch_array($query))
{
extract($zeile);
echo '<table border="1">';
echo '<tr><td>'.$datum.'</td><td>'.$titel.'</td><td><form method="post" action="index.php?x=show">';
userandpass();
echo '<input type="hidden" name="do" value="del" />
<input type="hidden" name="id" value="'.$id.'" />';
echo '<button type="submit">L&ouml;schen</button></form></td></tr>
<tr><td colspan="3">Von: '.$author.'</td></tr>
<tr><td colspan="3">'.$news.'</td></tr></table><hr />';
}

}


function added_news()
{
if ($_POST["do"]=="added")
{
$uhrzeit=date("H:i:s");
$sql="INSERT INTO news_intern (datum,uhrzeit,titel,author,news) VALUES (
'".filter($_POST["datum"])."',
'".$uhrzeit."',
'".filter($_POST["titel"])."',
'".filter($_POST["userinput"])."',
'".filter($_POST["news"])."' )";

write_admin_log($sql,"news_intern","added");
$query=mysql_db_query("portal",$sql);
if ($query=="1")
{echo "News hinzugef&uuml;gt";}


}
}

function del_news()
{
if ($_POST["do"]=="del")
{
$sql="DELETE FROM news_intern WHERE id='".filter($_POST["id"])."'";
write_admin_log($sql,"news_intern","del");
$query=mysql_db_query("portal",$sql);
if ($query=="1")
{ echo "Datensatz gel&ouml;scht"; }
}
}
?>