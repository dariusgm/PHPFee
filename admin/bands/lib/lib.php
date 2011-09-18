<?php



function userandpass()
{
echo '<input type="hidden" name="userinput" value="'.$_POST["userinput"].'" />
<input type="hidden" name="passinput" value="'.$_POST["passinput"].'" />';
}


function showedit_bands()
{
	
$downloadpfad="../../bands/";
$db=mysql_connect("localhost","portal","psacln");

$sql="SELECT * FROM bands ORDER BY 'datum' ASC";
$query=mysql_db_query("portal",$sql);
while($zeile=mysql_fetch_array($query))
{
 echo '
	<form method="post" action="index.php?x=edit" enctype="multipart/form-data">
<table width="500" border="1"><tbody><tr><td rowspan="2" width="80"><img src="'.$downloadpfad.$zeile["bild_klein"].'" /></td><td>Bandname: <input type="text" name="name" value="'.$zeile["name"].'" /></td></tr>
<tr><td>Link: <input type="text" name="link" value="'.$zeile["link"].'" /></td></tr></tbody></table>
<table width="500" border="1"><tr><td colspan="2">

<center>Vollbild:<br /><img src="'.$downloadpfad.$zeile["bild_gros"].'" /></center></td></tr>
<tr><td><br />KURZBESCHREIBUNG: <br /><textarea name="kurztext" cols="50" rows="7">'.$zeile["kurztext"].'</textarea></td></tr>
<tr><td><br />BESCHREIBUNG: <br /><textarea name="text" cols="50" rows="20">'.$zeile["text"].'</textarea>
</td></tr></tbody></table>
<br />
<table width="500"><tbody>
<tr><td width="300">';
if (!empty($_POST["download_vorstellung"]))
{
echo '<a href="'.$downloadpfad.$zeile["download_vorstellung"].'">Vorstellung</a>'; }
else
{ echo 'Vorstellung'; }
echo '</td><td width="200"><input type="file" name="comment" /></td><td><select name="comment_drop">
 <option value="1">Behalten</option>
 <option value="2">Ersetzen oder L&ouml;schen</option>
</select></td></tr>
<tr><td>';
if (!empty($_POST["download_musik1"]))
{
echo '<a href="'.$downloadpfad.$zeile["download_musik1"].'">Musik 1</a>'; }
else
{ echo 'Musik 1'; }
echo '</td><td width="200"><input type="file" name="musik1" /></td><td><select name="musik1_drop">
 <option value="1">Behalten</option>
 <option value="2">Ersetzen oder L&ouml;schen</option>
</select></td></tr>

<tr><td>';
if (!empty($_POST["download_musik2"]))
{
echo '<a href="'.$downloadpfad.$zeile["download_musik2"].'">Musik 2</a>'; }
else
{ echo 'Musik 2'; }
echo '</td><td width="200"><input type="file" name="musik2" /></td><td><select name="musik2_drop">
 <option value="1">Behalten</option>
 <option value="2">Ersetzen oder L&ouml;schen</option>
</select></td></tr>

<tr><td>';
if (!empty($_POST["download_musik3"]))
{
echo '<a href="'.$downloadpfad.$zeile["download_musik3"].'">Musik 3</a>'; }
else
{ echo 'Musik 3'; }
echo '</td><td width="200"><input type="file" name="musik3" /></td><td><select name="musik3_drop">
 <option value="1">Behalten</option>
 <option value="2">Ersetzen oder L&ouml;schen</option>
</select></td></tr>

<tr><td>';
if (!empty($_POST["download_musik4"]))
{
echo '<a href="'.$downloadpfad.$zeile["download_musik4"].'">Musik 4</a>'; }
else
{ echo 'Musik 4'; }
echo '</td><td width="200"><input type="file" name="musik4" /></td><td><select name="musik4_drop">
 <option value="1">Behalten</option>
 <option value="2">Ersetzen oder L&ouml;schen</option>
</select></td></tr>

<tr><td>';
if (!empty($_POST["download_musik5"]))
{
echo '<a href="'.$downloadpfad.$zeile["download_musik5"].'">Musik 5</a>'; }
else
{ echo 'Musik 5'; }
echo '</td><td width="200"><input type="file" name="musik5" /></td><td><select name="musik5_drop">
 <option value="1">Behalten</option>
 <option value="2">Ersetzen oder L&ouml;schen</option>
</select></td></tr>

<tr><td>Vorschau-Bild: </td><td><input type="file" name="vorschau" /></td><td><select name="vorschau_drop">
 <option value="1">Behalten</option>
 <option value="2">Ersetzen oder L&ouml;schen</option>
</select></td></tr>

<tr><td>Vollbild: </td><td><input type="file" name="vollbild" /></td><td><select name="vollbild_drop">
 <option value="1">Behalten</option>
 <option value="2">Ersetzen oder L&ouml;schen</option>
</select></td></tr>
</tbody></table>
<input type="hidden" name="do" value="edit" />
<input type="hidden" name="id" value="'. $zeile["id"].'" />';
userandpass();
echo '<table><tr><td><button type="submit">Speichern</button></td></tr></table></form>
<form method="post" action="index.php?x=edit"><table><tr><td><button type="submit">Alles L&ouml;schen</button></td></tr></table>
<input type="hidden" name="do" value="del" />
<input type="hidden" name="id" value="'. $zeile["id"].'" />';
userandpass();
echo '</form>';
	
}
	
}



function do_edit()
{  
	
	if ($_POST["do"]=="edit")
	{
	// Hole Aktuelle Dateinamen
	$db=mysql_connect("localhost","portal","psacln");
	$sql_select="SELECT * FROM bands WHERE id=".$_POST["id"]."";
	
	$result=mysql_db_query("portal",$sql_select);
	$zeile=mysql_fetch_array($result);
		
	
$downloadpfad="../../bands/";	
$sql="UPDATE bands SET ";

if ($_POST["musik1_drop"]=="2")
{ //Alte Datei l&ouml;schen
  @unlink($downloadpfad.$zeile["download_musik1"]);
  
	$sql.="download_musik1='".$_FILES["musik1"]["name"]."',"; 
	
	//Datei Verschieben
	copy($_FILES["musik1"]["tmp_name"],$downloadpfad.$_FILES["musik1"]["name"]);
	
	}


	if ($_POST["musik2_drop"]=="2")
{ //Alte Datei l&ouml;schen
  @unlink($downloadpfad.$zeile["download_musik2"]);
  
	$sql.="download_musik2='".$_FILES["musik2"]["name"]."',"; 
	
	//Datei Verschieben
	copy($_FILES["musik2"]["tmp_name"],$downloadpfad.$_FILES["musik2"]["name"]);
	
	}
	
	if ($_POST["musik3_drop"]=="2")
{ //Alte Datei l&ouml;schen
  @unlink($downloadpfad.$zeile["download_musik3"]);
  
	$sql.="download_musik3='".$_FILES["musik3"]["name"]."',"; 
	
	//Datei Verschieben
	copy($_FILES["musik3"]["tmp_name"],$downloadpfad.$_FILES["musik3"]["name"]);
	
	}

	if ($_POST["musik4_drop"]=="2")
{ //Alte Datei l&ouml;schen
  @unlink($downloadpfad.$zeile["download_musik4"]);
  
	$sql.="download_musik4='".$_FILES["musik4"]["name"]."',"; 
	
	//Datei Verschieben
	copy($_FILES["musik4"]["tmp_name"],$downloadpfad.$_FILES["musik4"]["name"]);
	
	}		
	
	
	if ($_POST["musik5_drop"]=="2")
{ //Alte Datei l&ouml;schen
  @unlink($downloadpfad.$zeile["download_musik5"]);
  
	$sql.="download_musik5='".$_FILES["musik5"]["name"]."',"; 
	
	//Datei Verschieben
	copy($_FILES["musik5"]["tmp_name"],$downloadpfad.$_FILES["musik5"]["name"]);
	
	}
		
if ($_POST["comment_drop"]=="2")
{  
	unlink($downloadpfad.$zeile["download_vorstellung"]);
	$sql.="download_vorstellung='".$_FILES["comment"]["name"]."',"; 
	copy($_FILES["comment"]["tmp_name"],$downloadpfad.$_FILES["comment"]["name"]);
	}

if ($_POST["vorschau_drop"]=="2")
{	
	unlink($downloadpfad.$zeile["bild_klein"]); 
	$sql.="bild_klein='".$_FILES["vorschau"]["name"]."',"; 
	copy($_FILES["vorschau"]["tmp_name"],$downloadpfad.$_FILES["vorschau"]["name"]);
	}

	
if ($_POST["vollbild_drop"]=="2")
{	unlink($downloadpfad.$zeile["bild_gros"]);  
	$sql.="bild_gros='".$_FILES["vollbild"]["name"]."',"; 
	copy($_FILES["vollbild"]["tmp_name"],$downloadpfad.$_FILES["vollbild"]["name"]);
  }

$sql.=" name='".filter($_POST["name"])."',
link='".filter($_POST["link"])."',
uhrzeit='".date("H:i:s")."',
kurztext='".filter($_POST["kurztext"])."',
text='".filter($_POST["text"])."' WHERE id='".filter($_POST["id"])."'";
 write_admin_log($sql,"bands","edit");
if (mysql_db_query("portal",$sql))
{ echo "Datensatz aktualisiert.<br />"; }


}
	
	
}







function added_bands()
{
	if ($_POST["do"]=="added")
	{  
	  $error=false;
		$downloadpfad="../../bands/";
		
		//Pr&uuml;fe alle Wichtigen Felder auf eingaben
		
		if (empty($_POST["name"]))
		{ echo "<br />Kein Bandname eingegeben. "; 
		$error=true;}
		
		if (empty($_POST["kurztext"]))
		{ echo "<br />Kein Kurztext eingegeben. "; 
		$error=true;}
		
		if (empty($_POST["text"]))
		{ echo "<br />Keine Beschreibung eingegeben. "; 
		$error=true;}		
		
		if (empty($_FILES['vollbild']['name']))
		{ echo "<br />Kein Vorschaubild ausgew&auml;hlt. "; 
		$error=true;}						
		
		if ($error==true)
		{ echo "<br />Der Vorgang wurde abgebrochen.";}
		else
	 	{
		 	
//Thumbnail		   
   		   copy($_FILES["vorschau"]["tmp_name"],$downloadpfad.$_FILES["vorschau"]["name"]);
//Vollbild		 	
			   copy($_FILES["vollbild"]["tmp_name"],$downloadpfad.$_FILES["vollbild"]["name"]);		 	
		 	
//1		   
       if (!empty($_FILES["musik1"]["name"]))
		   { 
		   			   
			   copy($_FILES["musik1"]["tmp_name"],$downloadpfad.$_FILES["musik1"]["name"]);
		   }
//2
		   if (!empty($_FILES["musik2"]["name"]))
		   { 
	   			   
			   copy($_FILES["musik2"]["tmp_name"],$downloadpfad.$_FILES["musik2"]["name"]);
		   }			 
//3			   
		   if (!empty($_FILES["musik3"]["name"]))
		   { 
		   			   
			   copy($_FILES["musik3"]["tmp_name"],$downloadpfad.$_FILES["musik3"]["name"]);
		   }	
//4		   
		   if (!empty($_FILES["musik4"]["name"]))
		   { 
		   			   
			   copy($_FILES["musik4"]["tmp_name"],$downloadpfad.$_FILES["musik4"]["name"]);
		   }	

//5		   
		   if (!empty($_FILES["musik5"]["name"]))
		   { 
		   			   
			   copy($_FILES["musik5"]["tmp_name"],$downloadpfad.$_FILES["musik5"]["name"]);
		   }			   		
		   
//Vorstellung
		   if (!empty($_FILES["vorstellung"]["name"]))
		   { 
		   			   
			   copy($_FILES["musik5"]["tmp_name"],$downloadpfad.$_FILES["musik5"]["name"]);
		   }			   
		   
		   
		   $db=mysql_connect("localhost","portal","psacln");
       $sql="INSERT INTO bands (datum,uhrzeit,name,kurztext,text,bild_gros,bild_klein,download_vorstellung,download_musik1,download_musik2,download_musik3,download_musik4,download_musik5,link) 
       VALUES (
       '".date("Y-m-d")."',
       '".date("H-i-s")."',
       '".$_POST["name"]."',
       '".$_POST["kurztext"]."',       
       '".$_POST["text"]."',         
       '".$_FILES["vollbild"]["name"]."',
       '".$_FILES["vorschau"]["name"]."',
       '".$_FILES["vorstellung"]["name"]."',
       '".$_FILES["musik1"]["name"]."',  
       '".$_FILES["musik2"]["name"]."',        
       '".$_FILES["musik3"]["name"]."',        
       '".$_FILES["musik4"]["name"]."',       
       '".$_FILES["musik5"]["name"]."',  
       '".$_POST["link"]."')";
       if (mysql_db_query("portal",$sql))
       { echo "Band erfolgreich eingetragen.<br />"; }
       
       
                                        
       
	  
    
    }	
  }
	
}





function del_bands()
{
	if ($_POST["do"]=="del")
	{
	  $downloadpfad="../../bands/";
		//Vorbereiten f&uuml;r das physikalische L&ouml;schen der Datein
		$sql_select="SELECT bild_gros,bild_klein,download_vorstellung,download_musik1,download_musik2,download_musik3,download_musik4,download_musik5 FROM bands WHERE id='".$_POST["id"]."'";
		$result=mysql_db_query("portal",$sql_select);
    if ($result)
    { 
      $zeile=mysql_fetch_array($result);	
      
      
      @unlink($downloadpfad.$zeile["bild_gros"]);
      @unlink($downloadpfad.$zeile["bild_klein"]);
        
	    if (file_exists($downloadpfad.$zeile["download_vorstellung"]))
	    { @unlink($downloadpfad.$zeile["download_vorstellung"]); }
	    
	    if (file_exists($downloadpfad.$zeile["download_musik1"]))
	    { @unlink($downloadpfad.$zeile["download_musik1"]); }	    

	    if (file_exists($downloadpfad.$zeile["download_musik2"]))
	    { @unlink($downloadpfad.$zeile["download_musik2"]); }	  	    

	    if (file_exists($downloadpfad.$zeile["download_musik3"]))
	    { @unlink($downloadpfad.$zeile["download_musik3"]); }	    

	    if (file_exists($downloadpfad.$zeile["download_musik4"]))
	    { @unlink($downloadpfad.$zeile["download_musik4"]); }		    
	    
	    if (file_exists($downloadpfad.$zeile["download_musik5"]))
	    { @unlink($downloadpfad.$zeile["download_musik5"]); }	      
	  
	    $sql="DELETE FROM bands WHERE id='".$_POST["id"]."'";
		
	    if (mysql_db_query("portal",$sql))
       { echo "Band erfolgreich gel&ouml;scht.<br />"; }
	  }
		
		
		
			
  }	
	
	
}


?>