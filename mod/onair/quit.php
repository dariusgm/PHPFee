<?php
session_start();
?>
<?php require_once("../lib.php");?>

<?php
function save_config()
{
	$db=mysql_connect("localhost","portal","psacln");
	$sql1="UPDATE grusbox_user_config SET 
	refresh='".filter($_SESSION["refresh"])."', 
	sort='".filter($_SESSION["sort"])."'
	WHERE userid=".filter($_SESSION["id"])."";
	$result1=mysql_db_query("portal",$sql1);
	
}

function write_nonstop()
{
	  //  Exportieren
      	 $pfad_link="http://www.discollection-radio.eu/stream";
      	 $pfad_bilder="http://www.discollection-radio.eu/onair/"; 
      	 $pfad_lokal="../../onair/";
  
      	 	   
	       // HTML Export (Baukasten)
	       $banner_html="<a href=\"".$pfad_link.filter($_SESSION["stream"]).".htm\" target=\"_self\" class=\"stream".$_SESSION["stream"]."\"><img src=\"" . $pfad_bilder ."0_".$_SESSION["stream"].".png\" border=\"0\" alt=\"DJ NONSTOP\"  /></a>";
	       $bannertext_html="<a href=\"".$pfad_link.filter($_SESSION["stream"]).".htm\" target=\"_self\" class=\"stream".$_SESSION["stream"]."\">Playlist</a>";
	       $onair_html="<a href=\"".$pfad_link.filter($_SESSION["stream"]).".htm\" target=\"_self\" class=\"stream".$_SESSION["stream"]."\"><img src=\"" . $pfad_bilder . "onair_nonstop".$_SESSION["stream"]. ".png\" border=\"0\" alt=\"DJ NONSTOP\"  /></a></a>";
	       $onairtext_html ="<a href=\"".$pfad_link.filter($_SESSION["stream"]).".htm\" target=\"_self\" class=\"stream".$_SESSION["stream"]."\">DJ NONSTOP</a>";
	      
	       
	        // JavaScript Export (Baukasten)
	       $banner_js = "document.write('<a href=\"".$pfad_link.filter($_SESSION["stream"]).".htm\" target=\"_self\"><img src=\"" . $pfad_bilder . "0_".$_SESSION["stream"]."\" border=\"0\" alt=\"DJ NONSTOP\" /></a>');";
	       $bannertext_js = "document.write('<a href=\"".$pfad_link.filter($_SESSION["stream"]).".htm\" target=\"_self\">".$sendetitel."</a>');";
	       $onair_js = "document.write('<a href=\"".$pfad_link.filter($_SESSION["stream"]).".htm\" target=\"_self\"><img src=\"" . $pfad_bilder ."onair_nonstop".$_SESSION["stream"].".png\" border=\"0\" alt=\"DJ NONSTOP\" /></a>');";
	       $onairtext_js = "document.write('<a href=\"".$pfad_link.filter($_SESSION["stream"]).".htm\" target=\"_self\">DJ NONSTOP</a>');";
	       
	    
	       // HTML Export (Schreiben)
	       $file_1 = fopen($pfad_lokal."banner".filter($_SESSION["stream"]).".htm", "w");
	       fwrite($file_1, $banner_html);	
           fclose($file_1);
	       
	       $file_2 = fopen($pfad_lokal."banner_text".filter($_SESSION["stream"]).".htm", "w");   
	       fwrite($file_2, $bannertext_html);	
           fclose($file_2);	       
	       
	       $file_3 = fopen($pfad_lokal."onair".filter($_SESSION["stream"]).".htm", "w");	               
	       fwrite($file_3, $onair_html);	
           fclose($file_3);	       
	       
	       $file_4 = fopen($pfad_lokal."onair_text".filter($_SESSION["stream"]).".htm", "w"); 	
	       fwrite($file_4, $onairtext_html);	
           fclose($file_4);		       
	       
	       // JavaScript Export (Schreiben)       
	       $file_5 = fopen($pfad_lokal."banner".filter($_SESSION["stream"]).".js", "w");
	       fwrite($file_5, $banner_js);	
           fclose($file_5);	       
	       
	       $file_6 = fopen($pfad_lokal."banner_text".filter($_SESSION["stream"]).".js", "w"); 
	       fwrite($file_6, $bannertext_js);	
           fclose($file_6);		       
	         
	       $file_7 = fopen($pfad_lokal."onair".filter($_SESSION["stream"]).".js", "w");	      
	       fwrite($file_7, $onair_js);	
           fclose($file_7);	       
	                
	       $file_8 = fopen($pfad_lokal."onair_text".filter($_SESSION["stream"]).".js", "w"); 
	       fwrite($file_8, $onairtext_js);	
           fclose($file_8);	       	 	       
	       
	    // Export Ende  

}



function log_out($opt)
{
	$db=mysql_connect("localhost","portal","psacln");
	//Loginzeit holen
	$sql0="SELECT in_time FROM grusbox_config WHERE stream='".filter($_SESSION["stream"])."'";
	$result0=mysql_db_query("portal",$sql0);
	$zeile0=mysql_fetch_array($result0);
	
	
	// GB stats Speichern
	$sql1="INSERT INTO grusbox_stats (userid,stream,login,logout,multi1,multi2,multi3,multi4,multi5) VALUES(
	'".$_SESSION["id"]."',
	'".$_SESSION["stream"]."',
	'".$zeile0["in_time"]."',
	'".time()."',
	'".$_SESSION["multi1"]."',
	'".$_SESSION["multi2"]."',	
	'".$_SESSION["multi3"]."',	
    '".$_SESSION["multi4"]."',
    '".$_SESSION["multi5"]."')";
	$result1=mysql_db_query("portal",$sql1);
    
	// GB schlie&szlig;en
	$sql1="UPDATE grusbox_config SET ";
	if ($_POST["_user"]=="nonstop")
	{ $sql1.="status=0,userid=0,";}
    $sql1.="session='',in_time='',multi1='',multi2='',multi3='',multi4='',multi5='' WHERE stream='".filter($_SESSION["stream"])."'";
    $result1=mysql_db_query("portal",$sql1);

    
    // Ban's entfernen
    $sql2="DELETE FROM grusbox_ban WHERE userid='".filter($_SESSION["id"])."'";
    $result2=mysql_db_query("portal",$sql2);
    echo '<br /><br /><b>Danke für deine Sendung du Doofsack {(c) by Neo}</b>';
  
    }	
?>


<?php 
if (isset($_SESSION["id"]) && isset($_SESSION["stream"]) && isset($_SESSION["modus"]))
{
include("./lib/lib.php");   
save_config();

if ($_POST["logoutmode"]=="nonstop")
{
   
   write_nonstop();
   log_out(1);
 }
else
{log_out(0);}
}
else
{ echo '<h1>Zugriff verweigert!</h1>';}
?>