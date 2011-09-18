<?php
#define ("meinpfad", "/srv/www/vhosts/discollection-radio.eu/httpdocs/admin/playlist/data/");
#
define ("meinpfad", "/opt/lampp/htdocs/admin/playlist/data/");
define ("quali",128000);#128kb/s Mp3
define ("verzoegerung", 2);#2h


function show_create_genre() {
if (isset($_POST["genre_name"]) && isset($_POST["werbung"]) && isset($_POST["pfad"]))
{
$db=mysql_connect("localhost","portal","psacln");
$connect=mysql_select_db("portal",$db);
$sql="INSERT INTO playlist_genre (werbung,pfad,genre_name) VALUES (";

if ($_POST["werbung"]=="ja")
{$sql.="'1',";}
else
{$sql.="'0',";}

$pfad=str_replace("%genre_name%",$_POST["genre_name"],$_POST["pfad"]);

$sql.="'".$pfad."',";
$sql.="'".$_POST["genre_name"]."')";


 if (file_exists($pfad))
 {echo 'Genre bereits angelegt... Zum l&ouml;schen w&auml;hle bitte den "Genre bearbeiten" Punkt.';}
 else
 {

   if ( mkdir ( $pfad, 0777 ) )#Erstelle Verzeichnis
   {
   echo 'Verzeichnis erstellt!<br /> Genre hinzugef&uuml;gt. Mp3\'s k&ouml;nnen nun hochgeladen werden.';
   $result=mysql_query($sql);# F&uuml;ge in Datenbank ein
   $htaccess="AllowOverride All
Order Deny, Allow
Deny from all";#.htaccess

    #schreibe Schutzdatei ins neue Verzeichnis
    $datei=fopen($pfad."/.htaccess",w);
    fwrite($datei,$htaccess); 
    fclose($datei);


   }
 }


}
else
{
echo '<form method="post"><table>
  <tr>
    <td>
       Genre Name:
    </td>
    <TD><input name="genre_name" type="text" maxlength="100" size="75" />
    </TD>
  </tr>

<TR><TD>Werbung</TD><TD><select name="werbung"><OPTION value="nein">NEIN</OPTION><OPTION value="ja">JA</OPTION></select></TD></TR>

<tr><td>Pfad:</td><td><input name="pfad" value="'.meinpfad.'%genre_name%" type="text" size="75" /></td></tr>
<tr><TD colspan="2"><button type="SUBMIT">Erstellen</button></TD></tr>
<tr><td><input type="hidden" name="userinput" value="'.$_POST["userinput"].'" />
<input type="hidden" name="passinput" value="'.$_POST["passinput"].'" /></td></tr>
</table></form>';

}

}


function show_edit_genre()
{ if (isset($_GET["d"]) || isset($_GET["e"]))
    {
	    if(isset($_GET["e"]))
	    {$db=mysql_connect("localhost","portal","psacln");
         $connect=mysql_select_db("portal",$db); 
         $sql1="UPDATE playlist_genre SET pfad='".$_POST["pfad"]."',genre_name='".$_POST["genre_name"]."' WHERE id='".$_GET["e"]."'";
         $result1=mysql_query($sql1);
         echo 'Datensatz aktualisiert';
         
         }
	    if(isset($_GET["d"]))
	    {$db=mysql_connect("localhost","portal","psacln");
         $connect=mysql_select_db("portal",$db); 
         $sql1="SELECT pfad FROM playlist_genre WHERE id='".$_GET["d"]."'";
         $result1=mysql_query($sql1);
         $zeile1=mysql_fetch_array($result1);
         $dh  = @opendir($zeile1["pfad"]);# Pr&uuml;fe ob das Verzeichnis leer ist
         while (false !== ($filename = @readdir($dh))) 
           { if (($filename!=".") && ($filename!="..") && ($filename!=".htaccess"))
		{$count++;}
           }
           
           if ($count==0 && is_dir($zeile1["pfad"]))
           { echo 'Order ist leer. Er wurde gel&ouml;scht.';
            unlink($zeile1["pfad"].".htaccess");
            rmdir($zeile1["pfad"]);
           }
           else
           {echo 'In dem von dir ausgew&auml;hlten Verzeichnis befinden sich noch <b>'.$count.'</b> Datein die erst manuell gel&ouml;scht werden m&uuml;ssen!';}
           
         
         
         }         
         
	
	
	
	}


	        $db=mysql_connect("localhost","portal","psacln");
            $connect=mysql_select_db("portal",$db);
            $sql1="SELECT * FROM playlist_genre WHERE werbung=0";
            $result1=mysql_query($sql1);
            echo '<table border="1"><tr><th>ID</th><th>Name</th><th>Pfad</th></tr>';
            while($zeile1=mysql_fetch_array($result1))
            { echo '<tr><form method="post" action="index.php?x=edit_genre&e='.$zeile1["id"].'"><td>'.$zeile1["id"].'</td><td><input type="text" name="genre_name" value="'.$zeile1["genre_name"].'" /></td><td><input type="text" name="pfad" value="'.$zeile1["pfad"].'" size="75" maxlenght="100" /></td><td><button type="submit">Speichern</button><input type="hidden" name="userinput" value="'.$_POST["userinput"].'" /><input type="hidden" name="passinput" value="'.$_POST["passinput"].'" /></form><form method="post" action="index.php?x=edit_genre&d='.$zeile1["id"].'"><button type="submit">L&ouml;schen</button><input type="hidden" name="userinput" value="'.$_POST["userinput"].'" /><input type="hidden" name="passinput" value="'.$_POST["passinput"].'" /></form></td></tr>';
            }
	            

	
	
}

function reload_musik()
{
if (isset($_POST["modus"]))
{

#Pruefe ob Playlist aktiviert ist	
	
if ($_POST["modus"]=="alles")
	{
		# Alles neu Importieren
        $db=mysql_connect("localhost","portal","psacln");
        $connect=mysql_select_db("portal",$db);
        $sql="SELECT id,pfad FROM playlist_genre";
        $sql1="TRUNCATE TABLE playlist_file";
        $result1=mysql_query($sql1,$db);
        $result=mysql_query($sql);
        
        while($zeile=mysql_fetch_array($result))
	{

		if(is_dir($zeile["pfad"]))
		{
	      $dh  = @opendir($zeile["pfad"]);
	    
          while (false !== ($filename = @readdir($dh))) 
             { 
	             if (($filename!=".") && ($filename!="..") && ($filename!=".htaccess"))
		         {
           
 
                 $sql2="INSERT INTO playlist_file (genre,dateiname,groesse) VALUES (".$zeile["id"].",'".$filename."',".filesize($zeile["pfad"]."/".$filename).")";
                 $result2=mysql_query($sql2,$db);
		         }
             }
        
       }
       else
       {echo 'Auf das Verzeichnis: <b>'.$zeile["pfad"].'</b> kann nicht zugegriffen werden. Stellen sie sicher das es noch vorhanden ist und das der Webserver lesenden Zugriff hat auf das Verzeichnis hat!<br /><br />';}
	} echo 'Musik wurde neu geladen.';







	}
	else
	{ # Fuege neue Songs in die Datenbank
	
	    $sql="SELECT id,pfad FROM playlist_genre";
        $result1=mysql_query($sql,$db);
    
	
       	    while($zeile=mysql_fetch_array($result))
		    {

	   	     $dh  = opendir($zeile["pfad"]);
       	     while (false !== ($filename = readdir($dh))) 
        	       { 
	        	       if (($filename!=".") && ($filename!="..") && ($filename!=".htaccess"))
		    	       {
           

         	          $sql2="SELECT id FROM playlist_files WHERE dateiname='".$filename."'";
          	          $result2=mysql_query($sql2,$db);
          	          $zeile2=mysql_fetch_array($result2);
          	              if ($zeile2["id"]!=NULL)
          	              {
	          	             $sql3="INSERT INTO playlist_file (genre,dateiname,groesse) VALUES (".$zeile["id"].",'".$filename."',".filesize($zeile["pfad"]."/".$filename).")";
	          	             $result3=mysql_query($sql3);
	          	             $count++;
	          	          }
          	          
		  	         }
          	     }
        
	
		    }
	
    echo $count;
    echo ' Neue Songs wurden in die Datenbank aufgenommen.<br />';
	
    }
    
    
    
    
    $sql_sum="SELECT id FROM playlist_file ORDER BY id DESC LIMIT 1";
    $result_sum=mysql_query($sql_sum);
    $zeile_sum=mysql_fetch_array($result_sum);
    echo 'Es befinden sich: <b> '.$zeile_sum["id"].' </b> Songs in der Datenbank.';
	
	
	
	





}
else
  {
echo '<table><TR><TD>
Sie sind dabei die Musiklisten zu aktualisieren. Bitte beachten sie das dieser Vorgang sehr Rechenaufwendig Ich bitte Sie darum m&ouml;glichst nur ein "UPDATE" auszuf&uuml;hren. Es f&uuml;gt neue Titel hinzu. M&ouml;chten Sie dagegen die Liste auch von nun nicht mehr vorhandenen Musikdatein befreien, benutzen sie bitte die Option "ALLES".
W&auml;hrend dieser Operatrionen muss die Playlist deaktiviert sein auf allen Streams. Dies wird bei beginn gepr&uuml;ft.
</TD></TR>

<form method="POST"><tr><TD>Modus:</TD></tr>
<tr><TD><SELECT name="modus"><option value="update">UPDATE</option><OPTION value="alles">ALLES</OPTION></SELECT></TD></tr>
<tr><TD><input type="hidden" name="userinput" value="'.$_POST["userinput"].'" />
<input type="hidden" name="passinput" value="'.$_POST["passinput"].'" /><button type="SUBMIT">Ausf&uuml;hren</button></TD></tr>

 </form>
 </table>';

  }
}





function  show_create_playlist()
{ if (isset($_POST["playlist_name"]))
{
$db=mysql_connect("localhost","portal","psacln");
$connect=mysql_select_db("portal",$db);
$sql3="INSERT INTO `playlist_name` (`name`) VALUES ('".filter($_POST["playlist_name"])."')";
$result3=mysql_query($sql3);
$playlist_id=mysql_insert_id();

while (list ($key, $value) = each ($_POST)) 
{
   if (($key!="playlist_name") && ($key!="userinput") && ($key!="passinput") && ($value!=0))
   {
   $sql2="INSERT INTO playlist_playlists (playlist,genre,anteil) VALUES (".$playlist_id.",".$key.",".$value.")";
   $result2=mysql_query($sql2);
   
   }
  

}

echo 'Playlist: '.$_POST["playlist_name"].' [ID: '.$playlist_id.'] angelegt.';  

}
else
{
#Musik
echo '<h3>W&auml;hle deine Musikrichtung(en)</h3>';
        $db=mysql_connect("localhost","portal","psacln");
        $connect=mysql_select_db("portal",$db);
        $sql1="SELECT id,pfad,genre_name FROM playlist_genre WHERE werbung=0 ORDER BY 'genre_name'";
        $result1=mysql_query($sql1);
        echo '<form method="post"><table><tr><th>Genre</th><td>Pfad</td><th>Prozentsatz</th></tr>';
        while($zeile=mysql_fetch_array($result1))
        {
        echo '<tr><td>'.$zeile["genre_name"].'</td><td>'.$zeile["pfad"].'</td><td><select name="'.$zeile["id"].'">'.show_create_playlist_dropdown($zeile["id"]).'</select></td></tr>';

        }
        echo '</table>';






echo '<h3>W&auml;hle die Zus&auml;tze</h3>';
#Werbung
        $sql1="SELECT id,pfad,genre_name FROM playlist_genre WHERE werbung=1 ORDER BY 'genre_name'";
        $result1=mysql_query($sql1);
        echo '<table><tr><th>Art</th><td>Pfad</td><th>Absolute Anzahl</th></tr>';
        while($zeile=mysql_fetch_array($result1))
        {
        echo '<tr><td>'.$zeile["genre_name"].'</td><td>'.$zeile["pfad"].'</td><td><select name="'.$zeile["id"].'">';
$i=0;
while($i<11)
{echo '<option value="'.$i.'">'.$i.'</option>';$i++;}

echo '</select></td></tr>';

        }
        echo '<tr><td>Playlistname:</td><td><input type="text" name="playlist_name" /></td></tr><tr><td><button type="submit">Speichern</td></tr><tr><TD><input type="hidden" name="userinput" value="'.$_POST["userinput"].'" />
<input type="hidden" name="passinput" value="'.$_POST["passinput"].'" /></table>';
}




}

function show_create_playlist_dropdown($genre)
{
$i=0;
while($i<11)
{$drop.='<option value="'.$i.'0">'.$i.'0 %</option>';$i++;}
return $drop;
}



function show_edit_playlist()

{  
   $db=mysql_connect("localhost","portal","psacln");
   $connect=mysql_select_db("portal",$db);
   
   if (isset($_POST["del"]))
   {
   	   $del_id=filter($_POST["del"]);
	   #Loesche Aus Playlist_name
	   $sql1="DELETE FROM playlist_name WHERE id=".$del_id."";
	   #Loesche aus Playlist_Playlists
	   $sql2="DELETE FROM playlist_playlists WHERE playlist=".$del_id."";
       $result1=mysql_query($sql1);
       $result2=mysql_query($sql2);
       echo 'Playliste gel&ouml;scht';
    }
    
    
     $sql1="SELECT id,name FROM playlist_name ORDER BY name";
      $result1=mysql_query($sql1);
      echo '<table><tr><th>ID</th><th width="200">Playliste</th></tr>';
      while($zeile1=mysql_fetch_array($result1))
      {

	   
	     echo '<tr><td><form method="post" action="index.php?x=edit_playlist">'.$zeile1["id"].'</td><td width="200">'.$zeile1["name"].'</td>
	   
	   
	      <td>
	      <input type="hidden" name="userinput" value="'.$_POST["userinput"].'" />
	      <input type="hidden" name="passinput" value="'.$_POST["passinput"].'" />
	      <input type="hidden" name="del" value="'.$zeile1["id"].'" />
	      <button type="submit">L&ouml;schen</button></form></td></tr>';
	   
      }
        echo '</table>';   
	
     
   

	
	
}





?>