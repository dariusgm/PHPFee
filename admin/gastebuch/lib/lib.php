<?php
//

function userandpass()
{
echo '<input type="hidden" name="userinput" value="'.$_POST["userinput"].'" />
<input type="hidden" name="passinput" value="'.$_POST["passinput"].'" />';
}


function do_gbook()
{
 if (isset($_POST["do"]))
 {
	if ($_POST["do"]=="10")
	{
	$sql1="DELETE FROM gb WHERE id='".filter($_POST["editid"])."'";
	write_admin_log($sql1,"gastebuch","del");
	$result1=mysql_db_query("portal",$sql1);
    }
    else
    {
	   $sql1="UPDATE gb SET visible='".filter($_POST["do"])."' WHERE id='".filter($_POST["editid"])."'";
	   $result1=mysql_db_query("portal",$sql1);
	   	write_admin_log($sql1,"gastebuch","update");
    }
    
 }
}

function show_gbook()
{
	$sql1="SELECT * FROM gb WHERE anid='0' ORDER BY 'datum' AND 'uhrzeit' LIMIT 25";
	$result1=mysql_db_query("portal",$sql1);  
	echo '<table><tr><td>Datum</td><td>Uhrzeit</td><td>Text</td><td>Status</td><td>IP</td><td>Host</td><td>Proxy</td><td></td></tr>';
	while($zeile1=mysql_fetch_array($result1))
	{
		
		echo '<form method="post" action="index.php?x=show"><tr>
		<td>'.$zeile1["datum"].'</td>
		<td>'.$zeile1["uhrzeit"].'</td>
		<td>'.$zeile1["text"].'</td>
		<td>'.$zeile1["visible"].'</td>
		<td>'.$zeile1["ip"].'</td>
		<td>'.$zeile1["host"].'</td>
		<td>'.$zeile1["proxy"].'</td><td><select name="do">';
		
		if ($zeile1["visible"]==1)
		{ echo '<option value="1">&Ouml;ffentlich</option><option value="3">Privat</option><option value="10">L&ouml;schen</option>'; }
		
		if ($zeile1["visible"]==3)
		{ echo '<option value="3">Privat</option><option value="1">&Ouml;ffentlich</option><option value="10">L&ouml;schen</option>'; }
			
		
		echo '</select></td><td><button type="submit">Ausf&uuml;hren</button><input type="hidden" name="editid" value="'.$zeile1["id"].'" />';
		userandpass();
		echo '</td></tr></form>';
	}
	
}?>