<?php
// -1 = Kein Foto (default); -2 = Foto muss geprueft werden durch Admins; sonst= Foto freigegeben, id= dateiname


function send_im ($von,$an,$text)
{
	
	 
	 $sql2="INSERT INTO im (vonid,anid,datum,uhrzeit,betreff,text) VALUES (
	 '".$von."',
	 '".$an."',
	 '".date("Y-m-d")."',
	 '".date("H:i")."',
	 'Foto Freischaltung',
	 '".$text."')";
  	 $db = mysql_connect("localhost", "portal", "psacln") or die("Verbindungsfehler");
	 $result=mysql_db_query("portal",$sql2);

	
	
}


function show_foto($id)
{   $fotoid="foto".$id;
	$sql1="SELECT $fotoid FROM user WHERE id='".$_SESSION["id"]."'";
	$db = mysql_connect("localhost", "portal", "psacln") or die("Verbindungsfehler");
	$result1=mysql_db_query("portal",$sql1);
	$zeile1=mysql_fetch_array($result1);
	if ($zeile1[$fotoid]=="-1")
	{ echo '<b>'.$id.'.</b><br /><img src="./sample/nopic.gif" />'; 
	show_upload($id); }
	elseif ($zeile1[$fotoid]=="-2")
	{ echo '<b>'.$id.'.</b><br /><img src="./sample/edit.gif" />'; 
	}
	else
   	{    if(file_exists("./foto/".$zeile1[$fotoid].".jpg"))
    	 { echo '<b>'.$id.'.</b><br /><img src="./foto/'.$zeile1[$fotoid].'.jpg" />';
    	 show_edit($id); }
    	 elseif(file_exists("./foto/".$zeile1[$fotoid].".gif"))
   	 	 { echo '<b>'.$id.'.</b><br /><img src="./foto/'.$zeile1[$fotoid].'.gif" />'; 
   	 	 show_edit($id); }
   	 	 else
   	 	 { echo '<b>'.$id.'.</b><br /><img src="./foto/'.$zeile1[$fotoid].'.png" />'; 
   	 	 show_edit($id); }
   }
   
   

	
	
}


// Loescht oder verschiebt die Fotos
function do_foto($id) 
{
	
 	
 $fotoid="bild".$id;
 $tmp_file_size = $_FILES[$fotoid]['size'];	
 $tmp_file_type = $_FILES[$fotoid]['type'];
 $tmp_file_name = $_FILES[$fotoid]['tmp_name'];
 $groese= getimagesize($tmp_file_name);
 $breite=$groese[0];
 $hoehe=$groese[1];
 
 // Ueberpruefe groese
  if ($tmp_file_size>(100*1024))
 { echo "Die Datei ist leider zu gro&slig;. Im Forum finden Sie Informationen wie Sie Ihr Foto in die richtige Gr&ouml;&szlig;e umwandeln."; }
  else
   {
  // Pruefe Dateityp
  	if (($tmp_file_type) == "image/jpeg" || ($tmp_file_type) == "image/pjpeg")
  	{ $type=".jpg"; }
  	elseif (($tmp_file_type) == "image/gif")
  	{ $type=".gif"; }
  	elseif (($tmp_file_type) == "image/png")
  	{ $type=".png"; }  	
  	else
  	{ 
	  	if ($tmp_file_name!="")
	  	{
	  	echo "<b><u>Das Bild muss im JPG, GIF oder PNG Format vorliegen.</u></b> "; 
	  	}
  	    $type=false;}
  
  	if (($breite>200) || ($hoehe>200))
  	{ echo "<b><u>Das von Ihnen hochgeladene Foto ist leider zu gro&szlig;, 
  	erlaubt sind 200 Pixel hoch und 200 Pixel breit. 
  	Ihr Foto ist jedoch ".$breite." Pixel breit und ".$hoehe." Pixel hoch. Hilfe zum Verkleinern des Bildes finden Sie im Forum.<br /></u></b>";
	$type=false;}
  	
  	
  	
  	if($type)
  	{ 
	$db = mysql_connect("localhost", "portal", "psacln") or die("Verbindungsfehler");
	// In Foto DB EIntrage
	$sql1="INSERT INTO foto (userid,fotoid,datum,uhrzeit) VALUES (
  	'".filter($_SESSION["id"])."',
  	'".$id."',
  	'".date("Y-m-d")."',	
  	'".date("H:i:s")."')";
  	
  	// ID holen, um die datei wegzukopieren
  	$sql2="SELECT LAST_INSERT_ID() AS id"; 
  	
  	
  	// Foto Status aendern auf=> Foto wird bearbeitet
  	$sql3="UPDATE user SET foto".$id."='-2' WHERE id='".filter($_SESSION["id"])."'";
 	
  	
  	// Hole alle Foto Admins und benachrichtige sie per IM das was neues da is
  	$sql4="SELECT id FROM user WHERE foto_level=10";
  	
  	
  	$db = mysql_connect("localhost", "portal", "psacln") or die("Verbindungsfehler");
  	$result1=mysql_db_query("portal",$sql1);
  	$result2=mysql_db_query("portal",$sql2);
  	$zeile2=mysql_fetch_array($result2);
  	
  	$result3=mysql_db_query("portal",$sql3);  	  	
  	$result4=mysql_db_query("portal",$sql4);
  	
  	// Sende die IM's
  	while($zeile4=mysql_fetch_array($result4))
  	{
	  	send_im($_SESSION["id"],$zeile4["id"]," Soeben wurde ein neues Foto hochgeladen.");
	 	  	
  	}	
	copy($tmp_file_name,"./foto/".$zeile2["id"].$type);
	echo "Ihr Foto wurde erfolgreich &uuml;bertragen. Es wird demn&auml;chst von einem Foto-Admin bepr&uuml;ft und dann freigeschaltet.<br />";
    
	
	
	}
 

  }	
}

function show_upload($id) 
{
	echo '<form action="index.php?x=foto" method="post" enctype="multipart/form-data"><table><tr><td>W&auml;hle das Bild, das Du ver&ouml;ffentlichen m&ouml;chtest:</td></tr>
	<tr><td><input type="file" name="bild'.$id.'"></td></tr><tr><td><button type="submit">Hochladen</button></td></tr></table></form>';

}


function show_edit($id)
{

	echo '<form action="index.php?x=foto" method="post" enctype="multipart/form-data"><table><tr><td>Um dieses Bild zu l&ouml;schen, klicke unten auf den Knopf "L&ouml;schen":</td></tr>
	<tr><td><input type="hidden" name="del" value="'.$id.'"></td></tr><tr><td><button type="submit">L&ouml;schen</button></td></tr></table></form>';

		
}

function do_del () {

	 if (isset($_POST["del"]))
	 {
		 $id=filter($_POST["del"]);
		 $sql1="SELECT userid,fotoid FROM foto WHERE id='".$id."'";
		 $db = mysql_connect("localhost", "portal", "psacln") or die("Verbindungsfehler");
		 $result1=mysql_db_query("portal",$sql1);
		 if (mysql_num_rows($result1)=="0")
		 { echo 'Du bist nicht berechtigt dieses Bild zu l&ouml;schen<br />'; }
		 else
		 {
		 $zeile1=mysql_fetch_array($result1);
		 $sql2="UPDATE user SET foto".$zeile1["fotoid"]."='-1' WHERE id='".$zeile1["userid"]."'";
		 $db = mysql_connect("localhost", "portal", "psacln") or die("Verbindungsfehler");
         $result2=mysql_db_query("portal",$sql2);
		 @unlink("./foto/".$id.".jpg");
		 @unlink("./foto/".$id.".gif");		 
		 @unlink("./foto/".$id.".png");		 
	     }
	 }
	
		
}

	?>