<?php
    #Diese Datei Führt Die Statistiken der Server. Nicht verändern ! by Darius Murawski
    $db=mysql_connect("localhost","portal","psacln");
	$sql="SELECT * FROM relay";
	$result=mysql_db_query("portal",$sql);
	while($zeile=mysql_fetch_array($result))
	{
		$verbindung=fsockopen($zeile[ip],$zeile[port],$errno, $errstr,10);
		if ($verbindung) //Verbindung hergestellt?
		   {
                fputs($verbindung, "GET /7 HTTP/1.1\r\nUser-Agent:Mozilla\r\n\r\n");// Mozilla MUSS gesetzt sein !
				    while(!feof($verbindung)) 
					{ 
                     $data = $data . fgets($verbindung,128); 
                    }
					
					$streamdaten=explode(",",$data);
					if ($streamdaten[6]!="") // Server erreichbar (Titel ungleich leer)
					{
					$sqlstats="INSERT INTO stats_relay (relayid,stempel,uni) 
		                                VALUES (".$zeile[id].",".time().",".$streamdaten[4].")";}
					else {$sqlstats="INSERT INTO stats_relay (relayid,stempel,uni,error) 
		                                VALUES (".$zeile[id].",".time().",0,OFFLINE)";}
		   }
		   else
		   {
		   	$sqlstats="INSERT INTO stats_relay (relayid,stempel,uni,error) 
		                                VALUES (".$zeile[id].",".time().",0,404";
		   }
			$db2=mysql_connect("localhost","portal","psacln");
			$result2=mysql_db_query("portal",$sqlstats,$db2);
			mysql_close($db2);	

									
	}
	mysql_close($db);
	 
?>
