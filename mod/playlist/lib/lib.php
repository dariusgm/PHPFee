<?php

#Playlist Skript by Darius Murawski !
define ("quali",128000);#128kb/s Mp3
define ("verzoegerung", 2);#2h


function playlist()
{
    $startzeit=microtime();
	#How IT Works: Idee: Darius Murawski
	#| Selectiere alle Datein aus dem Genre (mysql)
	#|-> Sortiere sie nach zuletzt gespielt, von 0 nach x(mysql)
	#   |-> Nochmal Durchmischen (php)
	
	#| Selectiere alle Jingels (mysql)
	#|-> F&uuml;ge sie so oft ins Array ein, wie sie gespielt werden sollen (ab hier php)
	
	#-> Rechne aus, wie viele Jingels pro 2h gespielt werden m&uuml;ssen
	#-> Rechne das in Kilobyte um
	#-> Erzeuge die eigentliche Playlist 
	#   |-> Fuelle dafuer alle Jingels in einen Temporaeren Block
	#   |-> Packe nun so viele Songs dazu, bis der Block voll ist.  
	 
	
        $playlist_selected=filter($_POST["playlist"]);
        if(!is_numeric($playlist_selected))
        { echo 'Fehler';exit(); }	
	
	
	    $db=mysql_connect("localhost","portal","psacln");
        $connect=mysql_select_db("portal",$db);
      
        
        # MUSIK
        

       
        $sql1_1="SELECT id,pfad FROM playlist_genre WHERE werbung=0";
        $result1_1=mysql_query($sql1_1);
        while($zeile1_1=mysql_fetch_array($result1_1))# Hole Alle Musikordner
        {
	        $sql1_2="SELECT * FROM playlist_file WHERE genre=".$zeile1_1["id"]." ORDER BY 'played_last' ASC";#Sortiert nach AM wenigsten gespielt
	        $result1_2=mysql_query($sql1_2);
	        while($zeile1_2=mysql_fetch_array($result1_2))
	        {
		        $playlist_files[]=array($zeile1_2["genre"],$zeile1_1["pfad"].'/'.$zeile1_2["dateiname"],
		        $zeile1_2["groesse"],$zeile1_2["played"],$zeile1_2["played_last"],$zeile1_2["avg_listeners"]);
		        
		        }
	        
        
        }
        
        
        # Musik nochmal durchmischen
        shuffle($playlist_files);
 
        
       # JINGLES 
        # Wir gehen zu Testzwecken von einem Anzeil der Songs von 2x pro 2h aus. Und das Playlist 1 Selektiert wurde.


        
        
        
       
        $sql2_1="SELECT id,pfad FROM playlist_genre WHERE werbung=1";# Anteil: Anzahl Pro 2h in denen Gespielt werden soll
       # echo $sql2_1;
        $result2_1=mysql_query($sql2_1);
        while($zeile2_1=mysql_fetch_array($result2_1))# Hole Alle Jingleordner
        {
	       
	        
	        $sql2_2="SELECT dateiname FROM playlist_file WHERE genre=".$zeile2_1["id"]."";
	    #    echo $sql2_2;
	        $result2_2=mysql_query($sql2_2);
	        
	        
	        
	        
	        
	        while($zeile2_2=mysql_fetch_array($result2_2))
	        {
		        
		        
		        
		    $sql2_3="SELECT anteil FROM playlist_playlists WHERE playlist=".$playlist_selected." AND genre=".$zeile2_1["id"]."";
	      # echo $sql2_3;
		     $result2_3=mysql_query($sql2_3);
	        $zeile2_3=mysql_fetch_array($result2_3);
		       
		      
		        
		        # Setze Den Jingel so oft rein wie er in 2h gespielt werden soll.
                $i=0;

		           while($i<$zeile2_3["anteil"])
		           {
		           $playlist_jingles[]=array($zeile2_1["pfad"].'/'.$zeile2_2["dateiname"]);
	               $i++;
		           }
	            
		   
		   }

        }
        
        shuffle($playlist_jingles);

   
    # CORE BEGIN
    
    
            
    # 100% Spielzeit = 2h =  Qualitaet [Kilobit pro Sekunde] * 60 [Sekunden] * 60 [Minuten] * 2[h] /8 [Bit] ( Da 8 Bit 1 Byte, die dateigroesse ist in Byte)
    $musik_pro_block=((((quali*1.1)/8)*60*60*verzoegerung));# Byte pro 2h Block

    # Zeiger Der Arrays an den Anfang setzen:
    reset($playlist_jingles);
    reset($playlist_files);
    
    $playlist_fertig=''; #Buffer fuer das schreiben ins Dateisystem
    $playlist_block_kb=0; #Speichert die Aktuelle Groesse des Blockes
    $playlist_block_temp=array(); #Temp. Array fuer einen Block
    $umbruch="\n"; 
    
       echo '<br><br>';
        for($i=0; $i<count($playlist_files); $i++) 
        {
	        
	        
	        if ($playlist_block_kb<$musik_pro_block)
	        {
		        $playlist_block_temp[]=$playlist_files[$i][1];#Song hinzufuegen
		        $playlist_block_kb=$playlist_block_kb+$playlist_files[$i][2];
		        
		        
		        
     	    }
	        else
	        {
	        
			        shuffle($playlist_block_temp);#Block mischen	   
		            
			        #Temoraren Block Wegschreiben
		            for($temp=0; $temp<count($playlist_block_temp); $temp++) 
		            {

			            $playlist_fertig.=$playlist_block_temp[$temp].$umbruch;
			            
			        }
        
    
	                #Neuen Block initalisieren
	                $playlist_block_kb=0;
	                $playlist_block_temp=array();
	        
	                for($j=0;$j<count($playlist_jingles);$j++)
	                {
		                #Alle Jingles einbauen
		                $playlist_block_temp[]=$playlist_jingles[$j][0];
   
	                }
	        
            }
	        
      }

      
#Nun das eigentliche Schreiben der Datein ( ENDLICH !...)
$datenstream = fopen("playlist".filter($_POST["stream"]).".fee", "w");
fwrite($datenstream, $playlist_fertig);
fclose($datenstream);


echo 'Playlist erzeugt.<br />';
echo 'Dauer:' ;
echo (microtime()-$startzeit);
echo ' ms';
       
}


function show_start()
{
	
	if (isset($_POST["playlist"]))
	{
		playlist();
		playlist_linux_start();
    }
    else
    {
	
	
	
		$db=mysql_connect("localhost","portal","psacln");
        $connect=mysql_select_db("portal",$db);
        $sql1="SELECT * FROM playlist_name";
        $result1=mysql_query($sql1);
        echo '<table border="1"><th width="100">NUMMER</th><th width="200">NAME</th></tr>';
        while($zeile1=mysql_fetch_array($result1))
        {
	        $drop.='<option value="'.$zeile1["id"].'">'.$zeile1["name"].'</option>';
	        echo '<tr><td>'.$zeile1["id"].'</td><td>'.$zeile1["name"].'</td></tr>';
        }
        echo '</table>';
        echo '<form method="post" action="index.php?x=start">
        <input type="hidden" name="userinput" value="'.$_POST["userinput"].'" />
        <input type="hidden" name="passinput" value="'.$_POST["passinput"].'" />
	    <select name="playlist">'.$drop.'</select>
	    <select name="stream">
	    <option value="1">Stream 1</option>
	    <option value="2">Stream 2</option>
	    <option value="3">Stream 3</option>
	    </select>
	    <button type="submit">S T A R T E N</button></form>';
	
	
    }
		
	
}




function show_stop()
{
	if ($_POST["do"]=="stop")
	{
		playlist_linux_stop();
	    
    }
    else
    {
	     echo '<form method="post" action="index.php?x=stop">
	     <select name="stream" size="1">
      <option value="1">Stream 1</option>
      <option value="2">Stream 2</option>
      <option value="3">Stream 3</option>

    </select>
        <input type="hidden" name="userinput" value="'.$_POST["userinput"].'" />
        <input type="hidden" name="passinput" value="'.$_POST["passinput"].'" />
        <input type="hidden" name="do" value="stop" />
	    <button type="submit">S T O P P E N</button></form>';
	}
	
}


function playlist_linux_stop()
{
	$db=mysql_connect("localhost","portal","psacln");
    $connect=mysql_select_db("portal",$db);
	$sql1="SELECT playlist_pid FROM grusbox_config WHERE stream=".filter($_POST["stream"]);
	$result1=mysql_query($sql1);
	$zeile1=mysql_fetch_array($result1);
	
	if ($zeile1["playlist_pid"]!=0)
	{
	exec("kill ".$zeile1["playlist_pid"]."");
	$sql2="UPDATE grusbox_config SET playlist_pid=0 WHERE stream=".filter($_POST["stream"]);
	$result2=mysql_query($sql2);
	echo 'Die Playlist von Stream '.filter($_POST["stream"]).' ist nun deaktiviert!';
    }
    else
    { echo 'Auf diesem Stream wurde keine Aktive Playlist gefunden ( ist sie aus ? )';}	
}


function playlist_linux_start()
{
	#Starte eine neue Instanz
	if (!is_numeric($_POST["stream"]))
	{exit();}
	#$cmd="./sc_trans_linux ./sc_trans".$_POST["stream"].".conf > /dev/null > $1 ";
	$cmd="screen -A -m -d -s pl".escapeshellcmd($_POST["stream"])." ./sc_trans_linux sc_trans".escapeshellcmd($_POST["stream"]).".conf";
	exec($cmd);
	//echo $cmd;
    #Warte 5 Sekunden damit das Programm gestartet werden kann
    sleep(5);	
	
    #Hole die Prozess ID
	$prozessliste=shell_exec("ps -C sc_trans_linux");
	#$prozessliste='  PID TTY          TIME CMD
#24325 ?        03:01:29 sc_serv
#24362 ?        00:01:26 sc_serv';
    

   #Suche Nach PID
   preg_match_all("/[0-9]{4,6}/", $prozessliste, $prozessid);
   var_dump($prozessid);
 
   
   $db=mysql_connect("localhost","portal","psacln");
   $connect=mysql_select_db("portal",$db);
   
   $sql1="SELECT playlist_pid FROM grusbox_config";
   $result1=mysql_query($sql1);
   while($zeile1=mysql_fetch_array($result1))
   {
	   
	   for($temp=0; $temp<count($prozessid); $temp++) 
		            {

			            if ($zeile1["playlist_pid"]==$prozessid[0][$temp])
			            {
				            
				         #Falls die PID bereits vorhanden ist, loesche sie aus dem Array 
				         unset($prozessid[0][$temp]);
				         #Schleife beenden
				          break;
				            
				            
				         }
                    }
        
   }
   
   if(count($prozessid)==0)
   { echo 'Fehler. Abbruch.'; exit(); }
   if(count($prozessid)==1)
   { $sql2="UPDATE grusbox_config SET playlist_pid=".$prozessid[0][0]." WHERE stream=".filter($_POST["stream"]);
     $result2=mysql_query($sql2);
     
     echo 'Playlist gestartet. PID: ' .$prozessid[0][0]. ' ';
   
   
   }
	
}

?>