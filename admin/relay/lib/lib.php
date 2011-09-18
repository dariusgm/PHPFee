<?php
function show_relayserver()
{
$db=mysql_connect("localhost","portal","psacln");
$sql1="SELECT * FROM relay ORDER BY stream";
$result=mysql_db_query("portal",$sql1);
echo '<table><tr>
<td>ID</td>
<td>stream</td>
<td>IP</td>
<td>Host</td>
<td>port</td>
<td>pw</td>
<td></td></tr>';
while($zeile=mysql_fetch_array($result))
    {
	echo '<form method="post"><tr>
	<input type="hidden" name="userinput" value="'.$_POST[userinput].'" />
    <input type="hidden" name="passinput" value="'.$_POST[passinput].'" />
	<td><input type="hidden" name="id" value="'.$zeile[id].'" />'.$zeile[id].'</td>
	<td><input type="text" name="stream" value="'.$zeile[stream].'" size="2" /></td>
	<td><input type="text" name="ip" value="'.$zeile[ip].'" size="15" /></td>
	<td>'.gethostbyaddr($zeile[ip]).'</td>
	<td><input type="text" name="port" value="'.$zeile[port].'" size="4" /></td>
	<td><input type="text" name="pw" value="'.$zeile[pw].'" /></td>
	<td><button type="submit">&Auml;ndern</button></td></tr></form>';
	}

	echo '<form method="post"><tr>
	<input type="hidden" name="userinput" value="'.$_POST[userinput].'" />
    <input type="hidden" name="passinput" value="'.$_POST[passinput].'" />
	<td><input type="hidden" name="id" value="0" size="2" /></td>
	<td><input type="text" name="stream" value="0" size="2" /></td>
	<td><input type="text" name="ip" value="000.000.000.000" size="15" /></td>
	<td></td>
	<td><input type="text" name="port" value="00000" size="4" /></td>
	<td><input type="text" name="pw" value="" /></td>
	<td><button type="submit">Hinzuf&uuml;gen</button></td></tr></form>';

echo '</table>';

}


function edit_relayserver()
{   
    // Neuer Eintrag
	if ($_POST[id]==0)
	{
		$db=mysql_connect("localhost","portal","psacln");
		$sql="INSERT INTO relay (stream,ip,port,pw) VALUES (".$_POST[stream].",'".$_POST[ip]."',".$_POST[port].",'".$_POST[pw]."')";
		$result=mysql_db_query("portal",$sql);
		if(mysql_affected_rows()==1)
		{echo '<h3>Neuer Relayserver wurde erfolgreich hinzugefügt.</h3>';}
		mysql_close($db);
		echo $sql;
	
	}
	// Editieren
	if ($_POST[id]>0)
	{
		$db=mysql_connect("localhost","portal","psacln");
		$sql="UPDATE relay SET stream=".$_POST[stream].",ip='".$_POST[ip]."',port=".$_POST[port].",pw='".$_POST[pw]."' WHERE id=".$_POST[id];
		$result=mysql_db_query("portal",$sql);
		if(mysql_affected_rows()==1)
		{echo '<h3>Relayserver wurde aktualisiert</h3>';}
		mysql_close($db);
	}
	
	
	
	
}

	
		






?>