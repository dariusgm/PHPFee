<?php
function get_24h()
{   $diff=time()-(60*60*24);
	$db=mysql_connect("localhost","portal","psacln");
	$sql1="SELECT COUNT(userid) AS result FROM connection_log WHERE zeit>".$diff." GROUP BY 'userid'";
	$result1=mysql_db_query("portal",$sql1);
	$zeile1=mysql_fetch_array($result1);
	return $zeile1["result"];

}

function get_5min()
{   $db=mysql_connect("localhost","portal","psacln");
	$sql1="SELECT userid FROM connection_log GROUP BY 'userid' ORDER BY 'zeit' DESC LIMIT 30 ";
	$result1=mysql_db_query("portal",$sql1);
	if (mysql_num_rows($result1)==0)
	{ return 0; }
	else
	{
	while($zeile1=mysql_fetch_array($result1))
	 {
 		$sql2="SELECT nick FROM user WHERE id=".$zeile1["userid"]."";
		$result2=mysql_db_query("portal",$sql2);
		$zeile2=mysql_fetch_array($result2);
		echo $zeile2["nick"].', ';
     }
    }
}
?>