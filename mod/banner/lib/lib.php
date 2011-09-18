<?php
function userandpass()
{
echo '<input type="hidden" name="userinput" value="'.$_POST["userinput"].'" />
<input type="hidden" name="passinput" value="'.$_POST["passinput"].'" />';
}


function get_my_id()
{
	$db=mysql_connect("localhost","portal","psacln");
	$sql1="SELECT id FROM user WHERE nick='".$_POST["userinput"]."' AND pw='".$_POST["passinput"]."'";
	$result1=mysql_db_query("portal",$sql1);
	$zeile1=mysql_fetch_array($result1);
	return $zeile1["id"];
}

function check_banner($bannerid)
{   $myid=get_my_id();  
	$str="";
	if (file_exists("../../onair/".$myid."_".$bannerid.".jpg"))
	{ $str=''.$myid.'_'.$bannerid.'.jpg'; }
	
	if (file_exists("../../onair/".$myid."_".$bannerid.".gif"))
	{ $str=''.$myid.'_'.$bannerid.'.gif'; }

	if (file_exists("../../onair/".$myid."_".$bannerid.".png"))
	{ $str=''.$myid.'_'.$bannerid.'.png'; }	
	
	if ($str=="")
	{ return false; }
	else
	{ return $str; }
}

function check_onair($bannerid)
{   $myid=get_my_id();  
	$str="";
	if (file_exists("../../onair/onair".$myid."_".$bannerid.".jpg"))
	{ $str=''.$myid.'_'.$bannerid.'.jpg'; }
	
	if (file_exists("../../onair/onair".$myid."_".$bannerid.".gif"))
	{ $str=''.$myid.'_'.$bannerid.'.gif'; }

	if (file_exists("../../onair/onair".$myid."_".$bannerid.".png"))
	{ $str=''.$myid.'_'.$bannerid.'.png'; }	
	
	if ($str=="")
	{ return false; }
	else
	{ return $str; }
}

function check_file_banner($id)
{
	$banner="banner".$id;
	if (isset($_FILES[$banner]["name"]))
	{
	// Prüfe Dateigröße
		$size=$_FILES[$banner]["size"];
;
		if ($size>500*1024)
		{ echo 'Banner '.$id.' ist zu Groß. 512000 bytes (500 kb) sind nur erlaubt. Der Banner ist '.$size.' kb Groß.<br />';}
		elseif($size==0)
		{ return; }
		else
		{   // Prüfe Mime Type
		     $ext="";
			$mime=$_FILES[$banner]["type"];
			if ($mime=="image/gif")
			{ $ext=".gif"; }
			if($mime=="image/png")
			{ $ext=".png"; }
			if($mime=="image/jpeg" || $mime=="image/pjpeg")
			{ $ext=".jpg"; }
			
			if ($ext!="")
			{
			$image=getimagesize($_FILES[$banner]["tmp_name"]);
			$breite=$image[0];
			$hoehe=$image[1];
			// Prüfe Auflösung
			   if ($hoehe>309 || $breite>500)
			   { echo 'Der Banner ist leider zu Groß. Erlaubs sind nur 500x309 ( Goldener Schnitt)<br />'; }
			   else
			   {
				   if ($_POST["do_banner".$id]=="replace")
				   {   $myid=get_my_id();
					   @unlink("../../onair/".$myid."_".$id.".jpg");
				       @unlink("../../onair/".$myid."_".$id.".gif");
				       @unlink("../../onair/".$myid."_".$id.".png");
				      copy($_FILES[$banner]["tmp_name"],"../../onair/".$myid."_".$id.$ext);
			         echo 'Banner '.$id.' akzeptiert. Sollte er in der nachfolgenden Tabelle der neue Banner nicht drinne sein, besteht kein Grund Zur Sorge. Dein browser möchte dann den neuen Banner nicht anzeigen, er IST aber hochgeladen.<br />'; }
			         else
			         { echo 'Bitte wählen sie "Ersetzen oder Hochladen" um einen Banner hochzuladen.<br />'; }
			         
		       }

			
				
	        }
	        else
			{ echo 'Dateityp konnte nicht festgestellt werden. Akzeptierte Formate sind Gif,Jpg,Png, dein Format ist:'. $mime . '<br />';}
			
	
		
	    } 
    }
	
}

function check_file_onair($id)
{
	$banner="onair".$id;
	if (isset($_FILES[$banner]["name"]))
	{
	// Prüfe Dateigröße
		$size=$_FILES[$banner]["size"];

		if ($size>10*1024)
		{ echo 'On Air '.$id.' ist zu Groß. 10240 byte (10 kb) sind nur erlaubt. Das Bild ist '.$size.' kb Groß.<br />';}
		elseif($size==0)
		{ return; }
		else
		{   // Prüfe Mime Type
		     $ext="";
			$mime=$_FILES[$banner]["type"];
			if ($mime=="image/gif")
			{ $ext=".gif"; }
			if($mime=="image/png")
			{ $ext=".png"; }
			if($mime=="image/jpeg" || $mime=="image/pjpeg")
			{ $ext=".jpg"; }
			
			if ($ext!="")
			{
			$image=getimagesize($_FILES[$banner]["tmp_name"]);
			$breite=$image[0];
			$hoehe=$image[1];
			// Prüfe Auflösung
			   if ($hoehe!=75 || $breite!=75)
			   { echo 'Der On Air Bild hat leider die nicht akzeptierte Größe. Bitte korrigere sie auf GENAU 75x75. '; }
			   else
			   {
				   if ($_POST["do_onair".$id]=="replace")
				   {   $myid=get_my_id();
					   @unlink("../../onair/onair".$myid."_".$id.".jpg");
				       @unlink("../../onair/onair".$myid."_".$id.".gif");
				       @unlink("../../onair/onair".$myid."_".$id.".png");
				       copy($_FILES[$banner]["tmp_name"],"../../onair/onair".$myid."_".$id.$ext);
			         echo 'On Air'.$id.' akzeptiert. Sollte er in der nachfolgenden Tabelle der neue Banner nicht drinne sein, besteht kein Grund Zur Sorge. Dein browser möchte dann den neuen Banner nicht anzeigen, er IST aber hochgeladen.<br />'; }
			         else
			         { echo 'Bitte wählen sie "Ersetzen oder Hochladen" um einen On Air Bild hochzuladen.<br />'; }
			         
		       }

			
				
	        }
	        else
			{ echo 'Dateityp konnte nicht festgestellt werden. Akzeptierte Formate sind Gif,Jpg,Png, dein Format ist:'. $mime .'<br />';}
			
	
		
	    } 
    }
	
}

?>