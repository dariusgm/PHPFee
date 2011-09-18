<?php


function get_id () {
	
$sql1="SELECT id FROM user WHERE nick='".filter($_POST["userinput"])."' AND pw='".filter($_POST["passinput"])."'";
$db=mysql_connect("localhost","portal","psacln");
$result1=mysql_db_query("portal",$sql1);
$zeile1=mysql_fetch_array($result1);
return $zeile1["id"];
}

function get_userid() {
$sql1="SELECT userid FROM foto WHERE id='".filter($_POST["id"])."'";
$db=mysql_connect("localhost","portal","psacln");
$result1=mysql_db_query("portal",$sql1);
$zeile1=mysql_fetch_array($result1);
return $zeile1["userid"];
}

function send_im ($von,$an,$text)
{
	
	 
	 $sql2="INSERT INTO im (vonid,anid,datum,uhrzeit,betreff,text) VALUES (
	 '".$von."',
	 '".$an."',
	 '".date("Y-m-d")."',
	 '".date("H:i")."',
	 'Foto Freischaltung',
	 '".$text."')";
  	 $db=mysql_connect("localhost","portal","psacln");
	 $result=mysql_db_query("portal",$sql2);

	
	
}


function set_verify () 
{

$sql2="UPDATE foto SET verifyid='".get_id()."' WHERE id='".filter($_POST["id"])."'";
	write_admin_log($sql2,"foto","verify");
	$db=mysql_connect("localhost","portal","psacln");
$result2=mysql_db_query("portal",$sql2);	

}


function set_ok ($a) 
{
$sql1="SELECT id,userid,fotoid FROM foto WHERE id='".filter($_POST["id"])."'";
$db=mysql_connect("localhost","portal","psacln");
$result1=mysql_db_query("portal",$sql1);
$zeile1=mysql_fetch_array($result1);

$sql2="UPDATE user SET foto".$zeile1["fotoid"]."=";
if ($a==false)
{ 
	$sql2.="'-1'";
    $sql3="UPDATE foto SET status='0' WHERE id='".filter($_POST["id"])."'";
 
}
else
{ 
	$sql2.="'".$zeile1["id"]."'"; 
    $sql3="UPDATE foto SET status='1' WHERE id='".filter($_POST["id"])."'";


}
$sql2.=" WHERE id='".$zeile1["userid"]."'";
write_admin_log($sql2,"foto","ok");



$db=mysql_connect("localhost","portal","psacln");
$result2=mysql_db_query("portal",$sql2);	
$result3=mysql_db_query("portal",$sql3);
	
}




function do_foto($id)
{

	if ($_POST["check"]=="0")
	{ echo "Bitte w&auml;hle aus dem Drop-Down Men&uuml; die Zutreffendste aus"; }
	if ($_POST["check"]=="1")
	{ send_im(get_id(),get_userid(),". Dein Foto verst&ouml;&szlig;t gegen ein Gesetz der Bundesrepublik Deutschland oder der Europ&auml;ischen Union.");
	set_verify(); 
	set_ok(false);}
	
	if ($_POST["check"]=="2")
	{ send_im(get_id(),get_userid(),"Dein Foto beinhaltet eine Nacktaufnahme und wurde aus diesem Grund abgelehnt.");
	set_verify(); 
	set_ok(false);}	
	
	if ($_POST["check"]=="3")
	{ send_im(get_id(),get_userid(),"Dein Foto beinhaltet ein provozierendes Motiv und wurde aus diesem Grund abgelehnt.");
	set_verify(); 
	set_ok(false);}	
	
	if ($_POST["check"]=="4")
	{ send_im(get_id(),get_userid(),"Dein Foto ist urheberrechtlich gesch&uuml;tzt und wurde aus diesem Grund abgelehnt.");
	set_verify(); 
	set_ok(false);}		
	
	if ($_POST["check"]=="5")
	{ send_im(get_id(),get_userid(),"Dein Foto wurde soeben freigeschaltet. Viel Spa&szlig; weiterhin bei uns.");
	set_verify(); 
	set_ok(true);}		
		
	if ($_POST["check"]=="6")
	{ send_im(get_id(),get_userid(),"Es werden nur Fotos zugelassen auf denen reale Personen abgelichtet sind, freigegeben");
	set_verify(); 
	set_ok(false);}			
		
}




function show_all_foto()
{

echo '<table border="1"><tr><td>Foto</td><td>User</td><td>Fotoid</td><td>Datum</td><td>Uhrzeit</td></tr>';
	
		
$sql1="SELECT * FROM foto WHERE verifyid='0' ORDER BY 'datum' AND 'uhrzeit';";	
$db=mysql_connect("localhost","portal","psacln");
$result1=mysql_db_query("portal",$sql1);
while($zeile1=mysql_fetch_array($result1))
{

$sql2="SELECT nick FROM user WHERE id='".$zeile1["userid"]."'";
$db=mysql_connect("localhost","portal","psacln");
$result2=mysql_db_query("portal",$sql2);	
$zeile2=mysql_fetch_array($result2);
		
echo '<form method="post" action="index.php?x=free"><input type="hidden" name="id" value="'.$zeile1["id"].'" /><tr><td><img src="../../foto/';

if (file_exists("../../foto/".$zeile1["id"].".jpg"))
{ echo $zeile1["id"].".jpg"; }

if (file_exists("../../foto/".$zeile1["id"].".gif"))
{ echo $zeile1["id"].".gif"; }

if (file_exists("../../foto/".$zeile1["id"].".png"))
{ echo $zeile1["id"].".png"; }




echo '" /></td><td>'.$zeile2["nick"].'</td><td>'.$zeile1["fotoid"].'</td><td>'.$zeile1["datum"].'</td><td>'.$zeile1["uhrzeit"].'</td><td><select name="check">
 <option value="0">---Ausw&auml;hlen</option>
 <option value="1">---Verst&ouml;st gegen geltendes Recht</option>
 <option value="2">---Nacktaufname</option>
 <option value="3">---Provozierend</option>
 <option value="4">---Urheberrecht</option>
 <option value="6">---Kein Reales Bild</option>
 <option value="5">---Freigegeben</option>
</select></td><td><button type="submit">Ausf&uuml;hren</button>
<input type="hidden" name="userinput" value="'.$_POST["userinput"].'" />
<input type="hidden" name="passinput" value="'.$_POST["passinput"].'" />
</td></tr></form>';
	
	
}	

echo "</table>";

	
}


function show_last_foto()
{
$db=mysql_connect("localhost","portal","psacln");
	
		
$sql1="SELECT * FROM foto WHERE verifyid!='0' ORDER BY 'id' DESC LIMIT 0,20 ;";	
$db=mysql_connect("localhost","portal","psacln");
$result1=mysql_db_query("portal",$sql1);

echo '<table border="1"><tr><td>Foto</td><td>User</td><td>Pr&uuml;fer/in</td><td>Fotoid</td><td>Datum</td><td>Uhrzeit</td><td>Status</td></tr>';

     while($zeile1=mysql_fetch_array($result1))
     {
     
     $sql2="SELECT nick FROM user WHERE id='".$zeile1["userid"]."'";
     $db=mysql_connect("localhost","portal","psacln");
     $result2=mysql_db_query("portal",$sql2);	
     $zeile2=mysql_fetch_array($result2);

     $sql3="SELECT nick FROM user WHERE id='".$zeile1["verifyid"]."'";
     $db=mysql_connect("localhost","portal","psacln");
     $result3=mysql_db_query("portal",$sql3);	
     $zeile3=mysql_fetch_array($result3);

     echo '<tr><td><img src="../../foto/';

     if (file_exists("../../foto/".$zeile1["id"].".jpg"))
     { echo $zeile1["id"].".jpg"; }

     if (file_exists("../../foto/".$zeile1["id"].".gif"))
     { echo $zeile1["id"].".gif"; }

     if (file_exists("../../foto/".$zeile1["id"].".png"))
     { echo $zeile1["id"].".png"; }




     echo '" /></td><td>'.$zeile2["nick"].'</td><td>'.$zeile3["nick"].'</td><td>'.$zeile1["fotoid"].'</td><td>'.$zeile1["datum"].'</td><td>'.$zeile1["uhrzeit"].'</td><td>';
	if ($zeile1["status"]==1)
	{ echo '<font color="green">OK</font>';}
	else
	{ echo '<font color="red"><b>Nicht OK</b></font>';}
	echo '</td></tr>';
	
   }	
	
	
	
}



?>