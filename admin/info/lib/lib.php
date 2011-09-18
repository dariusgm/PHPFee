<?php
$db=mysql_connect("localhost","portal","psacln");

set_time_limit(0);
function send_email($an,$betreff,$text)
{
              
        
  @mail($an, $betreff, $text, "From: Discollection Radio - Systemnachricht <system@discollection-radio.eu>\nContent-Type: text/plain; charset=\"iso-8859-1\"\nContent-Transfer-Encoding: 8bit\nX-Mailer: PHP-FEE (c) Darius Murawski");
}       
       
       
function get_my_id()
{
	$sql1="SELECT id FROM user WHERE nick='".filter($_POST["userinput"])."' AND pw='".filter($_POST["passinput"])."'";
	$result1=mysql_db_query("portal",$sql1);
	$zeile1=mysql_fetch_array($result1);
	return $zeile1["id"];

}


function send_im ($von,$an,$betreff,$text)
{
	
	 
	 $sql2="INSERT INTO im (vonid,anid,datum,uhrzeit,betreff,text) VALUES (
	 '".$von."',
	 '".$an."',
	 '".date("Y-m-d")."',
	 '".date("H:i:s")."',
	 '".$betreff."',
	 '".filter($text)."')";
  	 
	 $result=mysql_db_query("portal",$sql2);

}

function userandpass()
{
	echo '<input type="hidden" name="userinput" value="'.$_POST["userinput"].'" />';
	echo '<input type="hidden" name="passinput" value="'.$_POST["passinput"].'" />';

}


function do_send_adminmod()
{
	if (isset($_POST["betreff"]) && isset($_POST["text"]))
	{
	$myid=get_my_id();
	$betreff=filter($_POST["betreff"]);
	$text=filter($_POST["text"]);
	$countim=0;
	$countemail=0;
	
	

	// Komunikation = 0 -> IM, 5 -> E-Mail, 10 -> Beides 
	if ($_POST["send_as"]=="user")
	{ 
    
        $sql1="SELECT id FROM user WHERE (portal_level=5 OR portal_level=12) AND (kommunikation='0' OR kommunikation='10') "; 
	    $result1=mysql_db_query("portal",$sql1);
	        
	        while($zeile1=mysql_fetch_array($result1))
	        {
	    	send_im($myid,$zeile1["id"],$betreff,$text);
	        $countim++;	
            }
	
    
        $sql1="SELECT email FROM user WHERE (portal_level=5 OR portal_level=12) AND (kommunikation='5' OR kommunikation='10') "; 
     	$result1=mysql_db_query("portal",$sql1);
	
         	while($zeile1=mysql_fetch_array($result1))
        	{
	        	if (!empty($zeile1["email"]))
	        	{
	    	    send_email($zeile1["email"],$betreff,$text);
             	$countemail++;	
         	    }
            }
    }
    
    
    
    
    if ($_POST["send_as"]=="im")
	{ 
    
        $sql1="SELECT id FROM user WHERE (portal_level=5 OR portal_level=12) "; 
	    $result1=mysql_db_query("portal",$sql1);
	        
	        while($zeile1=mysql_fetch_array($result1))
	        {
	    	send_im($myid,$zeile1["id"],$betreff,$text);
	        $countim++;	
            }
    }
    
    
    
    	if ($_POST["send_as"]=="email")
	{ 
    
        $sql1="SELECT email FROM user WHERE (portal_level=5 OR portal_level>10) "; 
     	$result1=mysql_db_query("portal",$sql1);
	
	        while($zeile1=mysql_fetch_array($result1))
	        {	        	
		        if (!empty($zeile1["email"]))
	        	{
	    	    send_email($zeile1["email"],$betreff,$text);
             	$countemail++;	
         	    }
           }
        }
    
        
// BOTH        
        
    if ($_POST["send_as"]=="both")
	{ 
    
        $sql1="SELECT id FROM user WHERE (portal_level=5 OR portal_level>10) "; 
	    $result1=mysql_db_query("portal",$sql1);
	        
	        while($zeile1=mysql_fetch_array($result1))
	        {
	    	send_im($myid,$zeile1["id"],$betreff,$text);
	        $countim++;	
            }
    
    
    
    
  
    
        $sql1="SELECT email FROM user WHERE (portal_level=5 OR portal_level>10) "; 
     	$result1=mysql_db_query("portal",$sql1);
	
	        while($zeile1=mysql_fetch_array($result1))
	        {	        	
		        if (!empty($zeile1["email"]))
	        	{
	    	    send_email($zeile1["email"],$betreff,$text);
             	$countemail++;	
         	    }
           }
     }   
        
// BOTH ENDE        
        
        
    
        
             echo 'Ihre Anfrage wurde ausgeführt. <br />Es wurden '.$countim.' IMs versendet. <br />Es wurden '.$countemail.' E-mails versendet. Eine Kopie der Nachricht wurde Ihnen als Mitteilung gesendet.';
 
             //Schicke an mich selber eine Kopie
             send_im($myid,$myid,$betreff,$text);
   }
    
 
  
}
    



	
	


function do_send_admin()
{
		if (isset($_POST["betreff"]) && isset($_POST["text"]))
	{
	$myid=get_my_id();
	$betreff=filter($_POST["betreff"]);
	$text=filter($_POST["text"]);
	$countim=0;
	$countemail=0;
	
	

	// Komunikation = 0 -> IM, 5 -> E-Mail, 10 -> Beides 
	if ($_POST["send_as"]=="user")
	{ 
    
        $sql1="SELECT id FROM user WHERE portal_level>9 AND (kommunikation='0' OR kommunikation='10') "; 
	    $result1=mysql_db_query("portal",$sql1);
	        
	        while($zeile1=mysql_fetch_array($result1))
	        {
	    	send_im($myid,$zeile1["id"],$betreff,$text);
	        $countim++;	
            }
	
    
        $sql1="SELECT email FROM user WHERE portal_level>9 AND (kommunikation='5' OR kommunikation='10') "; 
     	$result1=mysql_db_query("portal",$sql1);
	
         	while($zeile1=mysql_fetch_array($result1))
        	{
	        	if (!empty($zeile1["email"]))
	        	{
	    	    send_email($zeile1["email"],$betreff,$text);
             	$countemail++;	
         	    }
            }
    }
    
    
    
    
    if ($_POST["send_as"]=="im")
	{ 
    
        $sql1="SELECT id FROM user WHERE portal_level>9  "; 
	    $result1=mysql_db_query("portal",$sql1);
	        
	        while($zeile1=mysql_fetch_array($result1))
	        {
	    	send_im($myid,$zeile1["id"],$betreff,$text);
	        $countim++;	
            }
    }
    
    
    
    	if ($_POST["send_as"]=="email")
	{ 
    
        $sql1="SELECT email FROM user WHERE portal_level>9  "; 
     	$result1=mysql_db_query("portal",$sql1);
	
	        	if (!empty($zeile1["email"]))
	        	{
	    	    send_email($zeile1["email"],$betreff,$text);
             	$countemail++;	
         	    }
        }
    
        
// BOTH        
        
    if ($_POST["send_as"]=="both")
	{ 
    
        $sql1="SELECT id FROM user WHERE portal_level>9 "; 
	    $result1=mysql_db_query("portal",$sql1);
	        
	        while($zeile1=mysql_fetch_array($result1))
	        {
	    	send_im($myid,$zeile1["id"],$betreff,$text);
	        $countim++;	
            }
    
    
    
    
  
    
        $sql1="SELECT email FROM user WHERE portal_level>9 "; 
     	$result1=mysql_db_query("portal",$sql1);
	
	        while($zeile1=mysql_fetch_array($result1))
	        {	        	
		        if (!empty($zeile1["email"]))
	        	{
	    	    send_email($zeile1["email"],$betreff,$text);
             	$countemail++;	
         	    }
           }
            
     }   
        
// BOTH ENDE        
        
        
    
        
             echo 'Ihre Anfrage wurde ausgeführt. <br />Es wurden '.$countim.' IMs versendet. <br />Es wurden '.$countemail.' E-mails versendet. Eine Kopie der Nachricht wurde Ihnen als Mitteilung gesendet.';
 
             //Schicke an mich selber eine Kopie
             send_im($myid,$myid,$betreff,$text);
   }
}  




function do_send_group()

{
		if (isset($_POST["betreff"]) && isset($_POST["text"]))
	{
	$myid=get_my_id();
	$betreff=filter($_POST["betreff"]);
	$text=filter($_POST["text"]);
	
	$group1=get_group(filter($_POST["group1"]));
	$group2=get_group(filter($_POST["group2"]));
	$group3=get_group(filter($_POST["group3"]));
	$group4=get_group(filter($_POST["group4"]));	
	$group5=get_group(filter($_POST["group5"]));		
	
	$countim=0;
	$countemail=0;
		
	$groupquery="";
	
	if ($group1!=false)
	{ $groupquery=$group1; 
		if ($group2!=false)
		{ $groupquery.=" OR ".$group2.""; 
			if ($group3!=false)
			{ $groupquery.=" OR ".$group3."";
				if ($group4!=false)
				{ $groupquery.=" OR ".$group4."";
					if ($group5!=false)
					{ $groupquery.=" OR ".$group5."";
   					}
    			}
			}
        }
	
	
    

	
	

	// Komunikation = 0 -> IM, 5 -> E-Mail, 10 -> Beides 
	if ($_POST["send_as"]=="user")
	{ 
    
        $sql1="SELECT id FROM user WHERE ".$groupquery.""; 
	    $result1=mysql_db_query("portal",$sql1);
	        
	        while($zeile1=mysql_fetch_array($result1))
	        {
	    	send_im($myid,$zeile1["id"],$betreff,$text);
	        $countim++;	
            }
	
    
        $sql1="SELECT email FROM user WHERE ".$groupquery.""; 
     	$result1=mysql_db_query("portal",$sql1);
	
         	while($zeile1=mysql_fetch_array($result1))
        	{
	        	if (!empty($zeile1["email"]))
	        	{
	    	    send_email($zeile1["email"],$betreff,$text);
             	$countemail++;	
         	    }
            }
    }
    
    
    
    
    if ($_POST["send_as"]=="im")
	{ 
    
        $sql1="SELECT id FROM user WHERE ".$groupquery."";  
	    $result1=mysql_db_query("portal",$sql1);
	        
	        while($zeile1=mysql_fetch_array($result1))
	        {
	    	send_im($myid,$zeile1["id"],$betreff,$text);
	        $countim++;	
            }
    }
    
    
    
    	if ($_POST["send_as"]=="email")
	{ 
    
        $sql1="SELECT email FROM user WHERE ".$groupquery.""; 
     	$result1=mysql_db_query("portal",$sql1);
	
	        while($zeile1=mysql_fetch_array($result1))
	        {	        	
		        if (!empty($zeile1["email"]))
	        	{
	    	    send_email($zeile1["email"],$betreff,$text);
             	$countemail++;	
         	    }
           }
        }
    
        
// BOTH        
        
    if ($_POST["send_as"]=="both")
	{ 
    
        $sql1="SELECT id FROM user WHERE ".$groupquery."";  
	    $result1=mysql_db_query("portal",$sql1);
	        
	        while($zeile1=mysql_fetch_array($result1))
	        {
	    	send_im($myid,$zeile1["id"],$betreff,$text);
	        $countim++;	
            }
    
    
    
    
  
    
        $sql1="SELECT email FROM user WHERE ".$groupquery."";  
     	$result1=mysql_db_query("portal",$sql1);
	
	        while($zeile1=mysql_fetch_array($result1))
	        {	        	
		        if (!empty($zeile1["email"]))
	        	{
	    	    send_email($zeile1["email"],$betreff,$text);
             	$countemail++;	
         	    }
           }
            
     }   
        
// BOTH ENDE        
        
        
    
        
             echo 'Ihre Anfrage wurde ausgeführt. <br />Es wurden '.$countim.' IMs versendet. <br />Es wurden '.$countemail.' E-mails versendet. Eine Kopie der Nachricht wurde Ihnen als Mitteilung gesendet.';
 
             //Schicke an mich selber eine Kopie
             send_im($myid,$myid,$betreff,$text);
   }
   

  
    else
   {   echo 'Bitte wählen Sie die Gruppen von oben Nach unten. Es wurde nichts verschickt.'; } 
   
   
   
   } 
}  




function do_send_all()
{
		if (isset($_POST["betreff"]) && isset($_POST["text"]))
	{
	$myid=get_my_id();
	$betreff=filter($_POST["betreff"]);
	$text=filter($_POST["text"]);
	$countim=0;
	$countemail=0;
	
	

	// Komunikation = 0 -> IM, 5 -> E-Mail, 10 -> Beides 
	if ($_POST["send_as"]=="user")
	{ 
    
        $sql1="SELECT id FROM user"; 
	    $result1=mysql_db_query("portal",$sql1);
	        
	        while($zeile1=mysql_fetch_array($result1))
	        {
	    	send_im($myid,$zeile1["id"],$betreff,$text);
	        $countim++;	
            }
	
    
        $sql1="SELECT email FROM user"; 
     	$result1=mysql_db_query("portal",$sql1);
	
         	while($zeile1=mysql_fetch_array($result1))
        	{
	        	if (!empty($zeile1["email"]))
	        	{
	    	    send_email($zeile1["email"],$betreff,$text);
             	$countemail++;	
         	    }
            }
    }
    
    
    
    
    if ($_POST["send_as"]=="im")
	{ 
    
        $sql1="SELECT id FROM user"; 
	    $result1=mysql_db_query("portal",$sql1);
	        
	        while($zeile1=mysql_fetch_array($result1))
	        {
	    	send_im($myid,$zeile1["id"],$betreff,$text);
	        $countim++;	
            }
    }
    
    
    
    	if ($_POST["send_as"]=="email")
	{ 
    
        $sql1="SELECT email FROM user"; 
     	$result1=mysql_db_query("portal",$sql1);
	
	        	if (!empty($zeile1["email"]))
	        	{
	    	    send_email($zeile1["email"],$betreff,$text);
             	$countemail++;	
         	    }
        }
    
        
// BOTH        
        
    if ($_POST["send_as"]=="both")
	{ 
    
        $sql1="SELECT id,email FROM user"; 
	    $result1=mysql_db_query("portal",$sql1);
	        
	        while($zeile1=mysql_fetch_array($result1))
	        {
	    	send_im($myid,$zeile1["id"],$betreff,$text);
	        $countim++;	
	        	if (!empty($zeile1["email"]))
	        	{
	    	    send_email($zeile1["email"],$betreff,$text);
             	$countemail++;	 
             	}       
	        
	        
            }
 	    
            
     }   
        
// BOTH ENDE        
        
        
    
        
             echo 'Ihre Anfrage wurde ausgeführt. <br />Es wurden '.$countim.' IMs versendet. <br />Es wurden '.$countemail.' E-mails versendet. Eine Kopie der Nachricht wurde Ihnen als Mitteilung gesendet.';
 
             //Schicke an mich selber eine Kopie
             send_im($myid,$myid,$betreff,$text);
   }
} 	







function get_group($groupid)
{ 
	switch ($groupid) {
case 1: return "portal_level>='10'"; break;
case 2: return "news_level>='10'"; break;
case 3: return "sendeplan>='10'"; break;
case 4: return "chat_level>='10'"; break;
case 5: return "verwaltung_level>='10'"; break;
case 6: return "download_level>='10'"; break;
case 7: return "charts_level>='10'"; break;
case 8: return "gastebuch_level>='10'"; break;
case 9: return "info_level>='10'"; break;
case 10: return "playlist_level>='10'"; break;
case 11: return "grusbox_level>='10'"; break;
case 12: return "stats_level>='10'"; break;
case 13: return "forum_level>='10'"; break;
case 14: return "homepage_level>='10'"; break;
case 15: return "bands_level>='10'"; break;
case 16: return "podcast_level>='10'"; break;
case 17: return "foto_level>='10'"; break;
case 18: return "bewerbung_level>='10'"; break;
case 19: return "urlaub_level>='10'"; break;

case 51: return " (portal_level>'0' AND portal_level<'10') "; break;
case 52: return " (news_level>'0' AND news_level<'10') "; break; 
case 53: return " (sendeplan_level>'0' AND sendeplan_level<'10') "; break; 
case 54: return " (chat_level>'0' AND chat_level<'10') "; break; 
case 55: return " (verwaltung_level>'0' AND verwaltung_level<'10') "; break;
case 56: return " (download_level>'0' AND download_level<'10') "; break;
case 57: return " (charts_level>'0' AND charts_level<'10') "; break;
case 58: return " (gastebuch_level>'0' AND gastebuch_level<'10') "; break;
case 59: return " (info_level>'0' AND info_level<'10') "; break;
case 510: return " (playlist_level>'0' AND playlist_level<'10') "; break;
case 511: return " (grusbox_level>'0' AND grusbox_level<'10') "; break;
case 512: return " (stats_level>'0' AND stats_level<'10') "; break;
case 513: return " (forum_level>'0' AND forum_level<'10') "; break;
case 514: return " (homepage_level>'0' AND homepage_level<'10') "; break;
case 515: return " (bands_level>'0' AND bands_level<'10') "; break;
case 516: return " (podcast_level>'0' AND podcast_level<'10') "; break;
case 517: return " (foto_level>'0' AND foto_level<'10') "; break;
case 518: return " (bewerbung_level>'0' AND bewerbung_level<'10') "; break;
case 519: return " (urlaub_level>'0' AND urlaub_level<'10') "; break;

case 101: return "portal_level='0'"; break;
case 102: return "news_level='0'"; break;
case 103: return "sendeplan_level='0'"; break;
case 104: return "chat_level='0'"; break;
case 105: return "verwaltung_level='0'"; break;
case 106: return "download_level='0'"; break;
case 107: return "charts_level='0'"; break;
case 108: return "gastebuch_level='0'"; break;
case 109: return "info_level='0'"; break;
case 1010: return "playlist_level='0'"; break;
case 1011: return "grusbox_level='0'"; break;
case 1012: return "stats_level='0'"; break;
case 1013: return "forum_level='0'"; break;
case 1014: return "homepage_level='0'"; break;
case 1015: return "bands_level='0'"; break;
case 1016: return "podcast_level='0'"; break;
case 1017: return "foto_level='0'"; break;
case 1018: return "bewerbung_level='0'"; break;
case 1019: return "urlaub_level='0'"; break;

default: return false; break;

}



 }





?>