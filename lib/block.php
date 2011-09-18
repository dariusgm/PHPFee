<?php


function do_unblock()
{
  if (isset($_POST["del"]))
   {	
   $sql1="SELECT userid FROM blocklist WHERE id='".filter($_POST["del"])."'";
   $db = mysql_connect("localhost", "portal", "psacln") or die("Verbindungsfehler");
   $result1=mysql_db_query("portal",$sql1);
   $zeile1=mysql_fetch_array($result1);
   if ($zeile1["userid"]!=$_SESSION["id"])
   { echo 'Du bist nich berechtigt diesen User zu Entblocken.<br />'; }
   else
   { $sql2="DELETE FROM blocklist WHERE id='".filter($_POST["del"])."'";
   	write_user_log($sql2,"block","del");
     $result2=mysql_db_query("portal",$sql2);
     if ($result2)
     { echo 'Der User wurde erfolgreich entblockiert.<br />'; }	

   }

  }
}

function do_block()
{

 if (isset($_POST["user"]))
 {
	 $sql1="SELECT id FROM user WHERE nick ='".filter($_POST["user"])."'";
	 $db = mysql_connect("localhost", "portal", "psacln") or die("Verbindungsfehler");
	 $result1=mysql_db_query("portal",$sql1);
	 $zeile1=mysql_fetch_array($result1);
	 if (mysql_num_rows($result1)==1)
	 {
	 $sql2="INSERT INTO blocklist (userid,geblockt,datum,uhrzeit,grund) VALUES (
	 '".$_SESSION["id"]."',
	 '".$zeile1["id"]."',
	 '".date("Y-m-d")."',
	 '".date("H:i:s")."',
	 '".filter($_POST["grund"])."')";
	 
	 $result2=mysql_db_query("portal",$sql2);
      }
	 else
	 { echo 'Der von dir eingegebene User konnte nicht gefunden werden.<br />'; }
	 
     
 }

}



function show_block()
{
$sql1="SELECT id,geblockt,datum,uhrzeit,grund FROM blocklist WHERE userid='".$_SESSION["id"]."' ORDER BY 'datum' AND 'uhrzeit'";
$db = mysql_connect("localhost", "portal", "psacln") or die("Verbindungsfehler");
$result1=mysql_db_query("portal",$sql1);
 if (mysql_num_rows($result1)==0)
 { echo 'Du hast keine User auf deiner Blockliste.<br />'; }
 else
 {
  echo '<table><tr><td>Nick</td><td>Datum</td><td>Uhrzeit</td><td>Grund</td></tr>';
  while($zeile1=mysql_fetch_array($result1))
   {
	   
	 $sql2="SELECT nick FROM user WHERE id='".$zeile1["geblockt"]."'";
	 $result2=mysql_db_query("portal",$sql2);
	 $zeile2=mysql_fetch_array($result2);
	 
	 
     echo '<form method="post" action="index.php?x=block"><tr><td>'.$zeile2["nick"].'</td>
     <td>'.$zeile1["datum"].'</td>
     <td>'.$zeile1["uhrzeit"].'</td>
     <td>'.$zeile1["grund"].'</td></tr><tr><td colspan="4"><button type="submit">Entblocken</button><input type="hidden" name="del" value="'.$zeile1["id"].'" /></td></tr></form>';
   }	
  echo '</table>';   	
 }	
}



function show_block_added()
{
 $text='Um einen User zu blockieren, schreiben Sie in das Feld den Usernamen. Wenn Sie m&ouml;chten k&ouml;nnen Sie optional einen Grund eingeben. Dieser Grund wird dann dem geblockten User angezeigt. Ein geblockter User kann Ihnen weder private Mitteilungen zukommen lassen noch Eintr&auml;ge in Ihr pers&ouml;nliches G&auml;stebuch vornehmen.';
 echo get_utf($text);
 echo '
<form method="post" action="index.php?x=block">
<table><tr><td>Username:</td><td><input type="text" name="user" /></td></tr>
<tr><td>Grund</td><td><input type="text" name="grund" /></td></tr>
<tr><td colspan="2"><button type="submit">Blockieren</button></td></tr></table></form>';	
	
	
}
?>