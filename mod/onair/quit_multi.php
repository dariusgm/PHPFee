<?php
session_start();
if (isset($_SESSION["id"]) && isset($_SESSION["stream"]))
     include("../lib.php");
	{$db=mysql_connect("localhost","portal","psacln");
	$sql1="UPDATE grusbox_user_config SET 
	refresh='".filter($_SESSION["refresh"])."', 
	sort='".filter($_SESSION["sort"])."'
	WHERE userid=".filter($_SESSION["id"])."";
	$result1=mysql_db_query("portal",$sql1);
	session_destroy();
	echo 'Deine Enstellungen wurden gespeichert. 
	Beachte bitte das Multiusersitzungen NICHT Statistisch angerechnet werden (als Sendezeit), 
	um Betrug zu vermeiden.';
	
}
?>