<?php

function show_notiz()
{
   $sql1="SELECT notizblock FROM user WHERE id='".filter($_SESSION["id"])."'";
   $db = mysql_connect("localhost", "portal", "psacln") or die("Verbindungsfehler");
   $result1=mysql_db_query("portal",$sql1);
   $zeile1=mysql_fetch_array($result1);

   
  echo '<form method="post" action="index.php?x=notiz"><textarea name="notiz" cols="70" rows="30">'.$zeile1["notizblock"].'</textarea><button type="submit">Speichern</button></form>';
  
}

function do_notiz()
{    
	if (isset($_POST["notiz"]))
	{
	$sql1="UPDATE user SET notizblock='".filter($_POST["notiz"])."' WHERE id='".filter($_SESSION["id"])."'";
	write_user_log($sql1,"notiz","edit");
	$db = mysql_connect("localhost", "portal", "psacln") or die("Verbindungsfehler");
    $result1=mysql_db_query("portal",$sql1);
    if ($result1)
    { echo '<b>&Auml;nderungen gespeichert</b>'; }
	}
}