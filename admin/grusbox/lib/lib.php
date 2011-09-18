<?php
function userandpass()
{
echo '<input type="hidden" name="userinput" value="'.$_POST["userinput"].'" />
<input type="hidden" name="passinput" value="'.$_POST["passinput"].'" />';
}

function get_nick_by_id($id)
{
	if ($id!=0)
	{
	$db=mysql_connect("localhost","portal","psacln");
    $sql1="SELECT nick FROM user WHERE id='".$id."'";
    $result1=mysql_db_query("portal",$sql1);
    $zeile1=mysql_fetch_array($result1);
    return $zeile1["nick"];	
    }
    else
    { return "Gast"; }
}

function get_id_by_nick($nick)
{
	$db=mysql_connect("localhost","portal","psacln");
	$sql1="SELECT id FROM user WHERE nick='".filter($nick)."'";
	$result1=mysql_db_query("portal",$sql1);
	$zeile1=mysql_fetch_array($result1);
	return $zeile1["id"];
}




function show_gb($stream)
{  
	if (isset($_POST["seite"]))
    { $seite=filter($_POST["seite"]); }
    else
    { $seite=0; }
	    
	    
	echo '<table width="655"><tr><td width="100">Nick</td><td>ART</td><td width="100">Input</td><td>Output</td><td>Text</td><td>IP</td></tr>';
	$sql1="SELECT * FROM grusbox_live WHERE stream=".$stream." ORDER BY 'id'  LIMIT ".($seite*20).",20";
	$db=mysql_connect("localhost","portal","psacln");
	$result1=mysql_db_query("portal",$sql1);
	while($zeile1=mysql_fetch_array($result1))
	{
		echo '<tr><td>'.get_nick_by_id($zeile1["userid"]).'</td>
		<td>'.$zeile1["art"].'</td>
		<td>'.date("d.m.Y H:i:s",$zeile1["in_time"]).'</td>
		<td>'.date("d.m.Y H:i:s",$zeile1["out_time"]).'</td>
		<td>'.$zeile1["in_text"].'</td>
		<td>'.$zeile1["ip"].'</td></tr>';
	}
	echo '</table>';

}	

function show_log()
{  
	if (isset($_POST["user"]))
    { $user="WHERE userid='".get_id_by_nick(filter($_POST["user"]))."'"; }
    else
    { $user=""; }
	    
  	if (isset($_POST["seite"]))
    { $seite=filter($_POST["seite"]); }
    else
    { $seite=0; }  
	    
	echo '<table><tr><td>Nick</td><td>Stream</td><td width="200">Login</td><td width="200">Logout</td><td>Multi1</td><td>Multi2</td><td>Multi3</td><td>Multi4</td><td>Multi5</td></tr>';
	$sql1="SELECT * FROM grusbox_stats ".$user." ORDER BY 'id'  LIMIT ".($seite*20).",20";
	$db=mysql_connect("localhost","portal","psacln");
	$result1=mysql_db_query("portal",$sql1);
	while($zeile1=mysql_fetch_array($result1))
	{
		echo '<tr><td>'.get_nick_by_id($zeile1["userid"]).'</td>
		<td>'.$zeile1["stream"].'</td>
		<td>'.date("d.m.Y H:i:s",$zeile1["login"]).'</td>
		<td>'.date("d.m.Y H:i:s",$zeile1["logout"]).'</td>
		<td>'.get_nick_by_id($zeile1["multi1"]).'</td>
		<td>'.get_nick_by_id($zeile1["multi2"]).'</td>	
		<td>'.get_nick_by_id($zeile1["multi3"]).'</td>	
		<td>'.get_nick_by_id($zeile1["multi4"]).'</td>		
		<td>'.get_nick_by_id($zeile1["multi5"]).'</td>';
	}
	echo '</table>';

}


function kick_mod()
{
	if (isset($_POST["streamid"]))
	{
	$db=mysql_connect("localhost","portal","psacln");
	//Loginzeit,user,multiuser holen
	$sql0="SELECT userid,in_time,multi1,multi2,multi3,multi4,multi5 FROM grusbox_config WHERE stream='".filter($_POST["streamid"])."'";

	
	$result0=mysql_db_query("portal",$sql0);
	$zeile0=mysql_fetch_array($result0);
	if ($zeile0["userid"]!=0)
	{
	
	// GB stats Speichern
	$sql1="INSERT INTO grusbox_stats (userid,stream,login,logout,multi1,multi2,multi3,multi4,multi5) VALUES(
	'".$zeile0["userid"]."',
	'".filter($_POST["streamid"])."',
	'".$zeile0["in_time"]."',
	'".time()."',
	'".$zeile0["multi1"]."',
	'".$zeile0["multi2"]."',	
	'".$zeile0["multi3"]."',	
    '".$zeile0["multi4"]."',
    '".$zeile0["multi5"]."')";
	$result1=mysql_db_query("portal",$sql1);

	
    
	// GB schlieﬂen
	$sql2="UPDATE grusbox_config SET ";
     	if ($_POST["_user"]=="nonstop")
	    { $sql2.="status=0,userid=0,";
	    
	    
	    
	    
	     //  Exportieren
      	 $pfad_link="http://www.discollection-radio.eu/stream";
      	 $pfad_bilder="http://www.discollection-radio.eu/onair/"; 
      	 $pfad_lokal="../../onair/";
      	 	   
	       // HTML Export (Baukasten)
	       $banner_html="<a href=\"".$pfad_link.filter($_POST["streamid"]).".htm\" target=\"_self\" class=\"stream".$_POST["streamid"]."\"><img src=\"" . $pfad_bilder . $status_banner. "\" border=\"0\" alt=\"".$modname."\"  /></a>";
	       $bannertext_html="<a href=\"".$pfad_link.filter($_POST["streamid"]).".htm\" target=\"_self\" class=\"stream".$_POST["streamid"]."\">".$sendetitel."</a>";
	       $onair_html="<a href=\"".$pfad_link.filter($_POST["streamid"]).".htm\" target=\"_self\" class=\"stream".$_POST["streamid"]."\"><img src=\"" . $pfad_bilder . $status_onair. "\" border=\"0\" alt=\"".$modname."\"  /></a></a>";
	       $onairtext_html ="<a href=\"".$pfad_link.filter($_POST["streamid"]).".htm\" target=\"_self\" class=\"stream".$_POST["streamid"]."\">".$modname."</a>";
	      
	       
	        // JavaScript Export (Baukasten)
	       $banner_js = "document.write('<a href=\"".$pfad_link.filter($_POST["streamid"]).".htm\" target=\"_self\"><img src=\"" . $pfad_bilder . $status_banner. "\" border=\"0\" alt=\"".$modname."\" /></a>');";
	       $bannertext_js = "document.write('<a href=\"".$pfad_link.filter($_POST["streamid"]).".htm\" target=\"_self\">".$sendetitel."</a>');";
	       $onair_js = "document.write('<a href=\"".$pfad_link.filter($_POST["streamid"]).".htm\" target=\"_self\"><img src=\"" . $pfad_bilder . $status_onair. "\" border=\"0\" alt=\"".$modname."\" /></a>');";
	       $onairtext_js = "document.write('<a href=\"".$pfad_link.filter($_POST["streamid"]).".htm\" target=\"_self\">".$modname."</a>');";
	       
	    
	       // HTML Export (Schreiben)
	       $file_1 = fopen($pfad_lokal."banner".filter($_POST["streamid"]).".htm", "w");
	       fwrite($file_1, $banner_html);	
           fclose($file_1);
	       
	       $file_2 = fopen($pfad_lokal."banner_text".filter($_POST["streamid"]).".htm", "w");   
	       fwrite($file_2, $bannertext_html);	
           fclose($file_2);	       
	       
	       $file_3 = fopen($pfad_lokal."onair".filter($_POST["streamid"]).".htm", "w");	               
	       fwrite($file_3, $onair_html);	
           fclose($file_3);	       
	       
	       $file_4 = fopen($pfad_lokal."onair_text".filter($_POST["streamid"]).".htm", "w"); 	
	       fwrite($file_4, $onairtext_html);	
           fclose($file_4);		       
	       
	       // JavaScript Export (Schreiben)       
	       $file_5 = fopen($pfad_lokal."banner".filter($_POST["streamid"]).".js", "w");
	       fwrite($file_5, $banner_js);	
           fclose($file_5);	       
	       
	       $file_6 = fopen($pfad_lokal."banner_text".filter($_POST["streamid"]).".js", "w"); 
	       fwrite($file_6, $bannertext_js);	
           fclose($file_6);		       
	         
	       $file_7 = fopen($pfad_lokal."onair".filter($_POST["streamid"]).".js", "w");	      
	       fwrite($file_7, $onair_js);	
           fclose($file_7);	       
	                
	       $file_8 = fopen($pfad_lokal."onair_text".filter($_POST["streamid"]).".js", "w"); 
	       fwrite($file_8, $onairtext_js);	
           fclose($file_8);	       	 	       
	       
	    // Export Ende  
	    
	    
	    
	    
	    
	    
	    
	    }
        $sql2.="session='',in_time='',multi1='',multi2='',multi3='',multi4='',multi5='' WHERE stream='".filter($_POST["streamid"])."'";
        $result2=mysql_db_query("portal",$sql2);


        
    
    // Ban's entfernen
    $sql3="DELETE FROM grusbox_ban WHERE userid='".$zeile0["userid"]."'";
   $result3=mysql_db_query("portal",$sql3);
   echo 'Mod wurde gekickt';

    }
     else
     {
	     echo 'Die Gruﬂbox ist bereits frei !.<br />'; 
	 }
  }
	
	
}

	
?>