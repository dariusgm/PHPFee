<?php
#Diese Modul Prüft ob die Playlist läuft. 
#Ist dies der Fall, wird der Zeitstempel des Aktuellen Songs erneuert.
#Eine Refreshzeit von 3 Minuten wird empfohlen ( Cronjob von 3 Minuten )

# Prüfe ob Playlist läuft
$db=mysql_connect("localhost","portal","psacln");
$connect=mysql_select_db("portal",$db);
$sql1="SELECT userid,status,port FROM grusbox_config"; # Alle Streams Abklappern
$result1=mysql_query($sql1);
while($zeile1=mysql_fetch_array($result1))
{
	if(($zeile1["userid"]==0) && ($zeile1["status"]==0))
	{
		# AB HIER SHOUTCAST ABFRAGE
		
		
    $fp = @fsockopen("localhost", $zeile1["port"], $errno, $errstr, 30);
    
    if ($fp) {
        fputs($fp, "GET /7.html HTTP/1.0\r\nUser-Agent: PHP FEE; Geistiges Eigentum von Darius Murawski (Mozilla Compatible)\r\n\r\n");
        while(!feof($fp))
            $page .= fgets($fp, 1000);
        fclose($fp);
        $page = ereg_replace(".*<body>", "", $page);
        $page = ereg_replace("</body>.*", ",", $page);
        $numbers = explode(",", $page);
        
             }
             $sql2="SELECT played_last FROM playlist_file WHERE dateiname='".$numbers[6].".mp3'";
             $result2=mysql_query($sql2);
             if (mysql_num_rows($result2))
             {
	             $zeile2=mysql_fetch_array($result2);
	             if ($zeile2["played_last"]<(time()-180))
	             { $sql3="UPDATE playlist_file SET played_last=".time().",played=played+1 WHERE dateiname='".$numbers[6].".mp3'";
	               $result3=mysql_query($sql3);
		             }
              }
    
    


	
	
	
     }	

}
	
	
	




?>