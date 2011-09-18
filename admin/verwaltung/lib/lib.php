<?php
$db=mysql_connect("localhost","portal","psacln");

function userandpass()
{
echo '<input type="hidden" name="userinput" value="'.$_POST["userinput"].'" />
<input type="hidden" name="passinput" value="'.$_POST["passinput"].'" />';
}

function doswitch($a)
{
switch ($a)
{
case user:
return 0;
break;

case mod:
return 5;
break;

case admin:
return 10;
break;

case adminundmod:
return 12;
break;


}

}	


// F&uuml;r Admins. Zeige alle Moderatoren und admins in allen Bereichen. 
// Als Parameter wird &uuml;bergeben welche Tabelle angezeigt werden soll
function show_user_admin($a)
{
  $sql = "SELECT id, nick, $a FROM user WHERE $a>=5 ORDER BY 'nick' ASC";
  $result=mysql_db_query("portal",$sql);
	echo '<table border="1"><tr><td width="75">Nickname</td><td width="100">Level</td><td></td></tr>';
	while($zeile=mysql_fetch_array($result))
	{
		echo '<tr><td>'.$zeile["nick"].'</td><td>';
		//User ist ein Mod ?
		    if (($zeile[$a] >= 5) && ($zeile[$a] < 10))
	      { 
		      echo "Moderator";
        }
   // Sonst wohl Admin
   else 
   { echo "Admin"; }
   echo '</td><td><form method="post" action="index.php?nickid='.$zeile["id"].'"><button type="submit">Infos</button>
   <input type="hidden" name="userinput" value="'.$_POST["userinput"].'" />
   <input type="hidden" name="passinput" value="'.$_POST["passinput"].'" />
   </form></td></tr>';
   
 }
	
 echo '</table>';
 	
}








function search_user_admin()
{
	
 if ($_POST["do"]=="search")
 { 
	if (empty($_POST["searchuser"]))
	{
	$sql1= "SELECT * FROM user WHERE id='".filter($_POST["searchid"])."'";
  $result=mysql_db_query("portal",$sql1);
  }
  else
  {
	$sql2= "SELECT * FROM user WHERE nick LIKE '%".filter($_POST["searchuser"])."%'";
  $result=mysql_db_query("portal",$sql2);	
  }
  
  if (mysql_num_rows($result)>20)
  { echo "Ihre Suchanfrage gab zu viele Treffer. Bitte benutzen Sie die Direkte ID";
  exit ();}
  
  if (mysql_num_rows($result)=="0")
  { echo "Ihre Suche ergab keine Treffer. Versuchen Sie es &uuml;ber die Listen"; }
  else
  {
	 while ($zeile=mysql_fetch_array($result))
	 {
		 extract($zeile);
		 echo '<form method="post" action="index.php">';
		 userandpass();
		 echo '<input type="hidden" name="do" value="edit" />
		 <input type="hidden" name="userid" value="'.$id.'" />
		 <table border="1"><tr><td>ID: '.$id.'</td><td>'.$nick.' ('.$sex.')</td></tr>
		 <tr><td>GB: '.$gb.'</td><td>GB-ORT: '.$gb_ort.'</td></tr>
		 <tr><td>PLZ: '.$plz.'</td><td>ORT: '.$ort.'</td></tr>
		 <tr><td>Land: '.$land.'</td><td>SEIT: '.$seit.'</td></tr>
		 <tr><td>PLZ: '.$discollis.'</td><td>ORT: '.$buhmann.'</td></tr>		 
		 <tr><td>Logins: '.$logins.'</td><td>leer</td></tr>
		 <tr><td colspan="2" >SIG: '.nl2br($sig).'</td></tr>
		 
	<tr><td width="150">Portal :<br />'; 
		       
		 // PORTAL
           $checklevel=$portal_level;		
            
           if ($checklevel >= 10)
           {echo 'Admin'; }
           if ($checklevel >= 5 && $checklevel <= 9)
            {echo '<select name="portal_level"><option value="mod">Moderator</option>
           <option value="user">User</option></select>'; }
           if ($checklevel < 5)
	         { echo '<select name="portal_level"><option value="user">User</option>
	         <option value="mod">Moderator</option></select>'; }
          
    //NEWS 
           echo '</td><td width="150">News Level :';    
	         $checklevel=$news_level;		 
           if ($checklevel>=10)
           {echo 'Admin'; }
           if ($checklevel >= 5 && $checklevel <= 9)
           { echo '<select name="news_level"><option value="mod">Moderator</option><option value="user">User</option></select>	'; }
           if ($checklevel <= 4)
	         { echo '<select name="news_level"><option value="user">User</option><option value="mod">Moderator</option></select>	'; }
           echo '</td></tr>';
           
    //Sendeplan
           echo '<tr><td>Sendeplan Level :'  ;    
	         $checklevel=$sendeplan_level;		 
           if ($checklevel>=10)
           { echo 'Admin'; }
           if ($checklevel >= 5 && $checklevel <= 9)
           { echo '<select name="sendeplan_level"><option value="mod">Moderator</option><option value="user">User</option></select>	'; }
           if ($checklevel <= 4)
	         { echo '<select name="sendeplan_level"><option value="user">User</option><option value="mod">Moderator</option></select>	'; }
           echo '</td>';                      
    //Chat
           echo '<td>Chat Level :';      
	         $checklevel=$chat_level;		 
           if ($checklevel>=10)
           { echo 'Admin'; }
           if ($checklevel >= 5 && $checklevel <= 9)
           { echo '<select name="chat_level"><option value="mod">Moderator</option><option value="user">User</option></select>	'; }
           if ($checklevel <= 4)
	         { echo '<select name="chat_level"><option value="user">User</option><option value="mod">Moderator</option></select>	'; }
           echo '</td></tr>';               
           

    //Userverwaltugn
           echo '<tr><td>Verwaltung Level :';      
	         $checklevel=$user_level;		 
           if ($checklevel>=10)
           {echo 'Admin'; }
           if ($checklevel >= 5 && $checklevel <= 9)
           { echo '<select name="user_level"><option value="mod">Moderator</option><option value="user">User</option></select>	'; }
           if ($checklevel <= 4)
	         { echo '<select name="user_level"><option value="user">User</option><option value="mod">Moderator</option></select>	'; }
           echo '</td>';                      
    //Download
           echo '<td>Download Level :';      
	         $checklevel=$download_level;		 
           if ($checklevel>=10)
           {echo 'Admin'; }
           if ($checklevel >= 5 && $checklevel <= 9)
           { echo '<select name="download_level"><option value="mod">Moderator</option><option value="user">User</option></select>	'; }
           if ($checklevel <= 4)
	         { echo '<select name="download_level"><option value="user">User</option><option value="mod">Moderator</option></select>	'; }
           echo '</td></tr>';             

    //Charts
           echo '<tr><td>Charts Level :';      
	         $checklevel=$charts_level;		 
           if ($checklevel>=10)
           {echo 'Admin'; }
           if ($checklevel >= 5 && $checklevel <= 9)
           { echo '<select name="charts_level"><option value="mod">Moderator</option><option value="user">User</option></select>	'; }
           if ($checklevel <= 4)
	         { echo '<select name="charts_level"><option value="user">User</option><option value="mod">Moderator</option></select>	'; }
           echo '</td>';                      
    //G&auml;stebuch
           echo '<td>G&auml;stebuch Level :';      
	         $checklevel=$gastebuch_level;		 
           if ($checklevel>=10)
           {echo 'Admin'; }
           if ($checklevel >= 5 && $checklevel <= 9)
           { echo '<select name="gastebuch_level"><option value="mod">Moderator</option><option value="user">User</option></select>	'; }
           if ($checklevel <= 4)
	         { echo '<select name="gastebuch_level"><option value="user">User</option><option value="mod">Moderator</option></select>	'; }
           echo '</td></tr>';            

    //Info
           echo '<tr><td>Infomailer Level :';      
	         $checklevel=$info_level;		 
           if ($checklevel>=10)
           {echo 'Admin'; }
           if ($checklevel >= 5 && $checklevel <= 9)
           { echo '<select name="info_level"><option value="mod">Moderator</option><option value="user">User</option></select>	'; }
           if ($checklevel <= 4)
	         { echo '<select name="info_level"><option value="user">User</option><option value="mod">Moderator</option></select>	'; }
           echo '</td>';  
                               
    //Playlist
           echo '<td>Playlist Level :';      
	         $checklevel=$playlist_level;		 
           if ($checklevel>=10)
           {echo 'Admin'; }
           if ($checklevel >= 5 && $checklevel <= 9)
           { echo '<select name="playlist_level"><option value="mod">Moderator</option><option value="user">User</option></select>	'; }
           if ($checklevel <= 4)
	         { echo '<select name="playlist_level"><option value="user">User</option><option value="mod">Moderator</option></select>	'; }
           echo '</td></tr>';            

     //Grusbox
           echo '<tr><td>Grussbox Level :';      
	         $checklevel=$grusbox_level;		 
           if ($checklevel>=10)
           {echo 'Admin'; }
           if ($checklevel >= 5 && $checklevel <= 9)
           { echo '<select name="grusbox_level"><option value="mod">Moderator</option><option value="user">User</option></select>	'; }
           if ($checklevel <= 4)
	         { echo '<select name="grusbox_level"><option value="user">User</option><option value="mod">Moderator</option></select>	'; }
           echo '</td>';  
                               
    //Statistiken
           echo '<td>Stats Level :';      
	         $checklevel=$stats_level;		 
           if ($checklevel>=10)
           {echo 'Admin'; }
           if ($checklevel >= 5 && $checklevel <= 9)
           { echo '<select name="stats_level"><option value="mod">Moderator</option><option value="user">User</option></select>	'; }
           if ($checklevel <= 4)
	         { echo '<select name="stats_level"><option value="user">User</option><option value="mod">Moderator</option></select>	'; }
           echo '</td></tr>';           

     //Forum
           echo '<tr><td>Forum Level: L&auml;uft Extern *g*</td>';  
                               
    //Homepage
           echo '<td>Homepage Level :';      
	         $checklevel=$homepage_level;	
	         if ($checklevel>=10)
           {echo '<select name="homepage_level"><option value="admin">Admin</option><option value="mod">Moderator</option><option value="user">User</option><option value="homepage1">Homepage aktiv</option><option value="homepage0">Homepage deaktiviert</option></select>	'; }
            if ($checklevel >= 5 && $checklevel <= 9)
           { echo '<select name="homepage_level"><option value="mod">Moderator</option><option value="user">User</option><option value="homepage1">Homepage aktiv</option><option value="homepage0">Homepage deaktiviert</option><option value="admin">Admin</option></select>	'; }
           if ($checklevel == 1 )
           {echo '<select name="homepage_level"><option value="homepage1">Homepage aktiv</option><option value="homepage0">Homepage deaktiviert</option><option value="mod">Moderator</option><option value="user">User</option><option value="admin">Admin</option></select>	'; }
             if ($checklevel == 0 )
           {echo '<select name="homepage_level"><option value="homepage0">Homepage deaktiviert</option><option value="homepage1">Homepage aktiv</option><option value="mod">Moderator</option><option value="user">User</option><option value="admin">Admin</option></select>	'; }
                     
           
      //Bands
           echo '<tr><td>Bands Level :';      
	         $checklevel=$bands_level;		 
           if ($checklevel>=10)
           {echo '<select name="bands_level"><option value="admin">Admin</option><option value="mod">Moderator</option><option value="user">User</option></select>'; }
           if ($checklevel >= 5 && $checklevel <= 9)
           { echo '<select name="bands_level"><option value="mod">Moderator</option><option value="user">User</option><option value="admin">Admin</option></select>	'; }
           if ($checklevel <= 4)
	         { echo '<select name="bands_level"><option value="user">User</option><option value="mod">Moderator</option><option value="admin">Admin</option></select>	'; }
           echo '</td>';  
                               
    //Podcast
           echo '<td>Podcast Level :';      
	         $checklevel=$podcast_level;		 
           if ($checklevel>=10)
           {echo '<select name="podcast_level"><option value="admin">Admin</option><option value="mod">Moderator</option><option value="user">User</option></select>'; }
           if ($checklevel >= 5 && $checklevel <= 9)
           { echo '<select name="podcast_level"><option value="mod">Moderator</option><option value="user">User</option><option value="admin">Admin</option></select>	'; }
           if ($checklevel <= 4)
	         { echo '<select name="podcast_level"><option value="user">User</option><option value="mod">Moderator</option><option value="admin">Admin</option></select>	'; }
           echo '</td></tr>';      
           
           
    //Foto
           echo '<tr><td>Foto Level :';      
	         $checklevel=$foto_level;		 
           if ($checklevel>=10)
           {echo '<select name="foto_level"><option value="admin">Admin</option><option value="mod">Moderator</option><option value="user">User</option></select>'; }
           if ($checklevel >= 5 && $checklevel <= 9)
           { echo '<select name="foto_level"><option value="mod">Moderator</option><option value="user">User</option><option value="admin">Admin</option></select>	'; }
           if ($checklevel <= 4)
	         { echo '<select name="foto_level"><option value="user">User</option><option value="mod">Moderator</option><option value="admin">Admin</option></select>	'; }
           echo '</td>';  
                               
      //Bewerbung
           echo '<td>Bewerbung Level :';      
	         $checklevel=$bewerbung_level;		 
           if ($checklevel>=10)
           {echo '<select name="bewerbung_level"><option value="admin">Admin</option><option value="mod">Moderator</option><option value="user">User</option></select>'; }
           if ($checklevel >= 5 && $checklevel <= 9)
           { echo '<select name="bewerbung_level"><option value="mod">Moderator</option><option value="user">User</option><option value="admin">Admin</option></select>	'; }
           if ($checklevel <= 4)
	         { echo '<select name="bewerbung_level"><option value="user">User</option><option value="mod">Moderator</option><option value="admin">Admin</option></select>	'; }
           echo '</td></tr>';    
           
      //Urlaub
           echo '<tr><td>Urlaub Level :';      
	         $checklevel=$urlaub_level;		 
           if ($checklevel>=10)
           {echo '<select name="urlaub_level"><option value="admin">Admin</option><option value="mod">Moderator</option><option value="user">User</option></select>'; }
           if ($checklevel >= 5 && $checklevel <= 9)
           { echo '<select name="urlaub_level"><option value="mod">Moderator</option><option value="user">User</option><option value="admin">Admin</option></select>	'; }
           if ($checklevel <= 4)
	         { echo '<select name="urlaub_level"><option value="user">User</option><option value="mod">Moderator</option><option value="admin">Admin</option></select>	'; }
           echo '</td>';  
                               
    //Events
           echo '<td>Events Level :';      
	         $checklevel=$events_level;		 
           if ($checklevel>=10)
           {echo '<select name="events_level"><option value="admin">Admin</option><option value="mod">Moderator</option><option value="user">User</option></select>'; }
           if ($checklevel >= 5 && $checklevel <= 9)
           { echo '<select name="events_level"><option value="mod">Moderator</option><option value="user">User</option><option value="admin">Admin</option></select>	'; }
           if ($checklevel <= 4)
	         { echo '<select name="events_level"><option value="user">User</option><option value="mod">Moderator</option><option value="admin">Admin</option></select>	'; }
           echo '</td></tr>';             
           
           echo '</td></tr></table>';
           echo '<table><tr><td>';
           if ($portal_level>=10)
           { echo 'Speichern gesperrt. Admin Accounts k&ouml;nnen nur von S-Admins ge&auml;ndert werden.'; }
           else
           {echo '<button type="submit">Speichern</button></td><tr></table></form><hr />';    }  
           
         }
           
           
           
           
           
           
           
    }     
           
	
}	
}



//S-ADMIN k&ouml;nnen Admin Accounts erstellen, normale admins nicht

function search_user_sadmin()
{
	
 if ($_POST["do"]=="search")
 { 
	 
	if (empty($_POST["searchuser"]))
	{
	$sql1= "SELECT * FROM user WHERE id='".$_POST["searchid"]."'";
  $result=mysql_db_query("portal",$sql1);
  }
  else
  {
	$sql2= "SELECT * FROM user WHERE nick LIKE '%".$_POST["searchuser"]."%'";
  $result=mysql_db_query("portal",$sql2);	
  }
  
  if (mysql_num_rows($result)>20)
  { echo "Ihre Suchanfrage gab zu viele Treffer. Bitte benutzen Sie die Direkte ID";
  exit ();}
  
  if (mysql_num_rows($result)=="0")
  { echo "Ihre Suche ergab keine Treffer. Versuchen Sie es &uuml;ber die Listen"; }
  else
  {
	 while ($zeile=mysql_fetch_array($result))
	 {
		 
		 extract($zeile); 
		 
   if ($portal_level<15)
   {
		
		 echo '<form method="post" action="index.php">';
		 userandpass();
		 echo '<input type="hidden" name="do" value="edit" />
		 <input type="hidden" name="userid" value="'.$id.'" />
		 <table border="1"><tr><td>ID: '.$id.'</td><td>'.$nick.' ('.$sex.')</td></tr>
		 <tr><td>GB: <input type="text" name="gb" value="'.$gb.'" /></td><td>GB-ORT: <input type="text" name="gb_ort" value="'.$gb_ort.'" /></td></tr>
		 <tr><td>PLZ: <input type="text" name="plz" value="'.$plz.'" /></td><td>ORT: <input type="text" name="ort" value="'.$ort.'" /></td></tr>
		 <tr><td>Land: <input type="text" name="land" value="'.$land.'" /></td><td>SEIT: <input type="text" name="seit" value="'.$seit.'" /></td></tr>
		 <tr><td>Discollis: <input type="text" name="discollis" value="'.$discollis.'" /></td><td>Buhmann: <input type="text" name="buhmann" value="'.$buhmann.'" /></td></tr>		 
		 <tr><td>Logins: <input type="text" name="logins" value="'.$logins.'" /></td><td>E-MAIL: <input type="text" name="email" value="'.$email.'" /></td></tr>
		 
		 <tr><td>MSN: <input type="text" name="msn" value="'.$msn.'" /></td><td>ICQ: <input type="text" name="icq" value="'.$icq.'" /></td></tr>
		 <tr><td>AiM: <input type="text" name="aim" value="'.$aim.'" /></td><td>Yahoo: <input type="text" name="yahoo" value="'.$yahoo.'" /></td></tr>
		 <tr><td>Skype: <input type="text" name="skype" value="'.$skype.'" /></td><td>LEER <input type="text" name="_" value="" /></td></tr>
		 <tr><td>Letzer Log-in am: <input type="text" name="last_login_date" value="'.$last_login_date.'" /></td><td>um: <input type="text" name="last_login_time" value="'.$last_login_time.'" /></td></tr>
		
		 
		 
		  <tr><td colspan="2" >SIG:<textarea cols="30" rows="3" name="sig">'.$sig.'</textarea></td></tr>
		 
	<tr><td width="150">Portal :<br />'; 
		       
		 // PORTAL
           $checklevel=$portal_level;		
           if ($checklevel == 12)
           {echo '<select name="portal_level"><option value="adminundmod">Admin und Mod</option><option value="admin">Admin</option><option value="mod">Moderator</option><option value="user">User</option></select>'; }
           if ($checklevel == 10)
           {echo '<select name="portal_level"><option value="admin">Admin</option><option value="adminundmod">Admin und Mod</option><option value="mod">Moderator</option><option value="user">User</option></select>'; }
           if ($checklevel >= 5 && $checklevel <= 9)
            { echo '<select name="portal_level"><option value="mod">Moderator</option><option value="user">User</option><option value="admin">Admin</option><option value="adminundmod">Admin und Mod</option></select>'; }
           if ($checklevel < 5)
	         { echo '<select name="portal_level"><option value="user">User</option><option value="mod">Moderator</option><option value="admin">Admin</option><option value="adminundmod">Admin und Mod</option></select>'; }
          
    //NEWS 
           echo '</td><td width="150">News Level :';    
	         $checklevel=$news_level;		 
           if ($checklevel>=10)
           {echo '<select name="news_level"><option value="admin">Admin</option><option value="mod">Moderator</option><option value="user">User</option></select>'; }
           if ($checklevel >= 5 && $checklevel <= 9)
           { echo '<select name="news_level"><option value="mod">Moderator</option><option value="user">User</option><option value="admin">Admin</option></select>	'; }
           if ($checklevel <= 4)
	         { echo '<select name="news_level"><option value="user">User</option><option value="mod">Moderator</option><option value="admin">Admin</option></select>	'; }
           echo '</td></tr>';
    //Sendeplan
           echo '<tr><td>Sendeplan Level :';      
	         $checklevel=$sendeplan_level;	
	       if ($checklevel>=12)  
	       {echo '<select name="sendeplan_level"><option value="adminundmod">Admin - IM</option><option value="admin">Admin + IM</option><option value="mod">Moderator</option><option value="user">User</option></select>'; }
            if ($checklevel==10)
           {echo '<select name="sendeplan_level"><option value="admin">Admin + IM</option><option value="adminundmod">Admin - IM</option><option value="mod">Moderator</option><option value="user">User</option></select>'; }
           if ($checklevel >= 5 && $checklevel <= 9)
           { echo '<select name="sendeplan_level"><option value="mod">Moderator</option><option value="user">User</option><option value="adminundmod">Admin - IM</option><option value="admin">Admin + IM</option></select>	'; }
           if ($checklevel <= 4)
	         { echo '<select name="sendeplan_level"><option value="user">User</option><option value="mod">Moderator</option><option value="adminundmod">Admin - IM</option><option value="admin">Admin + IM</option></select>	'; }
           echo '</td>';                       
    //Chat
           echo '<td>Chat Level :';      
	         $checklevel=$chat_level;		 
           if ($checklevel>=10)
           { echo '<select name="chat_level"><option value="admin">Admin</option><option value="mod">Moderator</option><option value="user">User</option></select>'; }
           if ($checklevel >= 5 && $checklevel <= 9)
           { echo '<select name="chat_level"><option value="mod">Moderator</option><option value="user">User</option><option value="admin">Admin</option></select>	'; }
           if ($checklevel <= 4)
	         { echo '<select name="chat_level"><option value="user">User</option><option value="mod">Moderator</option><option value="admin">Admin</option></select>	'; }
           echo '</td></tr>';               
           

    //Userverwaltugn
           echo '<tr><td>Verwaltung Level :';      
	         $checklevel=$user_level;		 
           if ($checklevel>=10)
           {echo '<select name="user_level"><option value="admin">Admin</option><option value="mod">Moderator</option><option value="user">User</option></select>'; }
           if ($checklevel >= 5 && $checklevel <= 9)
           { echo '<select name="user_level"><option value="mod">Moderator</option><option value="user">User</option><option value="admin">Admin</option></select>	'; }
           if ($checklevel <= 4)
	         { echo '<select name="user_level"><option value="user">User</option><option value="mod">Moderator</option><option value="admin">Admin</option></select>	'; }
           echo '</td>';                      
    //Download
           echo '<td>Download Level :';      
	         $checklevel=$download_level;		 
           if ($checklevel>=10)
           {echo '<select name="download_level"><option value="admin">Admin</option><option value="mod">Moderator</option><option value="user">User</option></select>'; }
           if ($checklevel >= 5 && $checklevel <= 9)
           { echo '<select name="download_level"><option value="mod">Moderator</option><option value="user">User</option><option value="admin">Admin</option></select>	'; }
           if ($checklevel <= 4)
	         { echo '<select name="download_level"><option value="user">User</option><option value="mod">Moderator</option><option value="admin">Admin</option></select>	'; }
           echo '</td></tr>';             

    //Charts
           echo '<tr><td>Charts Level :';      
	         $checklevel=$charts_level;		 
           if ($checklevel>=10)
           {echo '<select name="charts_level"><option value="admin">Admin</option><option value="mod">Moderator</option><option value="user">User</option></select>'; }
           if ($checklevel >= 5 && $checklevel <= 9)
           { echo '<select name="charts_level"><option value="mod">Moderator</option><option value="user">User</option><option value="admin">Admin</option></select>	'; }
           if ($checklevel <= 4)
	         { echo '<select name="charts_level"><option value="user">User</option><option value="mod">Moderator</option><option value="admin">Admin</option></select>	'; }
           echo '</td>';                      
    //G&auml;stebuch
           echo '<td>G&auml;stebuch Level :';      
	         $checklevel=$gastebuch_level;		 
           if ($checklevel>=10)
           {echo '<select name="gastebuch_level"><option value="admin">Admin</option><option value="mod">Moderator</option><option value="user">User</option></select>'; }
           if ($checklevel >= 5 && $checklevel <= 9)
           { echo '<select name="gastebuch_level"><option value="mod">Moderator</option><option value="user">User</option><option value="admin">Admin</option></select>	'; }
           if ($checklevel <= 4)
	         { echo '<select name="gastebuch_level"><option value="user">User</option><option value="mod">Moderator</option><option value="admin">Admin</option></select>	'; }
           echo '</td></tr>';            

    //Info
           echo '<tr><td>Infomailer Level :';      
	         $checklevel=$info_level;		 
           if ($checklevel>=10)
           {echo '<select name="info_level"><option value="admin">Admin</option><option value="mod">Moderator</option><option value="user">User</option></select>'; }
           if ($checklevel >= 5 && $checklevel <= 9)
           { echo '<select name="info_level"><option value="mod">Moderator</option><option value="user">User</option><option value="admin">Admin</option></select>	'; }
           if ($checklevel <= 4)
	         { echo '<select name="info_level"><option value="user">User</option><option value="mod">Moderator</option><option value="admin">Admin</option></select>	'; }
           echo '</td>';  
                               
    //Playlist
           echo '<td>Playlist Level :';      
	         $checklevel=$playlist_level;		 
           if ($checklevel>=10)
           {echo '<select name="playlist_level"><option value="admin">Admin</option><option value="mod">Moderator</option><option value="user">User</option></select>'; }
           if ($checklevel >= 5 && $checklevel <= 9)
           { echo '<select name="playlist_level"><option value="mod">Moderator</option><option value="user">User</option><option value="admin">Admin</option></select>	'; }
           if ($checklevel <= 4)
	         { echo '<select name="playlist_level"><option value="user">User</option><option value="mod">Moderator</option><option value="admin">Admin</option></select>	'; }
           echo '</td></tr>';            

     //Grusbox
           echo '<tr><td>Grussbox Level :';      
	         $checklevel=$grusbox_level;		 
           if ($checklevel>=10)
           {echo '<select name="grusbox_level"><option value="admin">Admin</option><option value="mod">Moderator</option><option value="user">User</option></select>'; }
           if ($checklevel >= 5 && $checklevel <= 9)
           { echo '<select name="grusbox_level"><option value="mod">Moderator</option><option value="user">User</option><option value="admin">Admin</option></select>	'; }
           if ($checklevel <= 4)
	         { echo '<select name="grusbox_level"><option value="user">User</option><option value="mod">Moderator</option><option value="admin">Admin</option></select>	'; }
           echo '</td>';  
                               
    //Statistiken
           echo '<td>Stats Level :';      
	         $checklevel=$stats_level;		 
           if ($checklevel>=10)
           {echo '<select name="stats_level"><option value="admin">Admin</option><option value="mod">Moderator</option><option value="user">User</option></select>'; }
           if ($checklevel >= 5 && $checklevel <= 9)
           { echo '<select name="stats_level"><option value="mod">Moderator</option><option value="user">User</option><option value="admin">Admin</option></select>	'; }
           if ($checklevel <= 4)
	         { echo '<select name="stats_level"><option value="user">User</option><option value="mod">Moderator</option><option value="admin">Admin</option></select>	'; }
           echo '</td></tr>';           

     //Forum
           echo '<tr><td>Forum Level :';      
	         $checklevel=$forum_level;		 
           if ($checklevel>=10)
           {echo '<select name="forum_level"><option value="admin">Admin</option><option value="mod">Moderator</option><option value="user">User</option></select>'; }
           if ($checklevel >= 5 && $checklevel <= 9)
           { echo '<select name="forum_level"><option value="mod">Moderator</option><option value="user">User</option><option value="admin">Admin</option></select>	'; }
           if ($checklevel <= 4)
	         { echo '<select name="forum_level"><option value="user">User</option><option value="mod">Moderator</option><option value="admin">Admin</option></select>	'; }
           echo '</td>';   
                               
    //Homepage
           echo '<td>Homepage Level :';      
	         $checklevel=$homepage_level;	
	         if ($checklevel>=10)
           {echo '<select name="homepage_level"><option value="admin">Admin</option><option value="mod">Moderator</option><option value="user">User</option><option value="homepage1">Homepage aktiv</option><option value="homepage0">Homepage deaktiviert</option></select>	'; }
            if ($checklevel >= 5 && $checklevel <= 9)
           { echo '<select name="homepage_level"><option value="mod">Moderator</option><option value="user">User</option><option value="homepage1">Homepage aktiv</option><option value="homepage0">Homepage deaktiviert</option><option value="admin">Admin</option></select>	'; }
           if ($checklevel == 1 )
           {echo '<select name="homepage_level"><option value="homepage1">Homepage aktiv</option><option value="homepage0">Homepage deaktiviert</option><option value="mod">Moderator</option><option value="user">User</option><option value="admin">Admin</option></select>	'; }
             if ($checklevel == 0 )
           {echo '<select name="homepage_level"><option value="homepage0">Homepage deaktiviert</option><option value="homepage1">Homepage aktiv</option><option value="mod">Moderator</option><option value="user">User</option><option value="admin">Admin</option></select>	'; }
                     
           
     //Bands
           echo '<tr><td>Bands Level :';      
	         $checklevel=$bands_level;		 
           if ($checklevel>=10)
           {echo '<select name="bands_level"><option value="admin">Admin</option><option value="mod">Moderator</option><option value="user">User</option></select>'; }
           if ($checklevel >= 5 && $checklevel <= 9)
           { echo '<select name="bands_level"><option value="mod">Moderator</option><option value="user">User</option><option value="admin">Admin</option></select>	'; }
           if ($checklevel <= 4)
	         { echo '<select name="bands_level"><option value="user">User</option><option value="mod">Moderator</option><option value="admin">Admin</option></select>	'; }
           echo '</td>';  
                               
    //Podcast
           echo '<td>Podcast Level :';      
	         $checklevel=$podcast_level;		 
           if ($checklevel>=10)
           {echo '<select name="podcast_level"><option value="admin">Admin</option><option value="mod">Moderator</option><option value="user">User</option></select>'; }
           if ($checklevel >= 5 && $checklevel <= 9)
           { echo '<select name="podcast_level"><option value="mod">Moderator</option><option value="user">User</option><option value="admin">Admin</option></select>	'; }
           if ($checklevel <= 4)
	         { echo '<select name="podcast_level"><option value="user">User</option><option value="mod">Moderator</option><option value="admin">Admin</option></select>	'; }
           echo '</td></tr>';      
           
           
    //Foto
           echo '<tr><td>Foto Level :';      
	         $checklevel=$foto_level;	
	       if ($checklevel>=12)  
	       {echo '<select name="foto_level"><option value="adminundmod">Admin - IM</option><option value="admin">Admin + IM</option><option value="mod">Moderator</option><option value="user">User</option></select>'; }
            if ($checklevel==10)
           {echo '<select name="foto_level"><option value="admin">Admin + IM</option><option value="adminundmod">Admin - IM</option><option value="mod">Moderator</option><option value="user">User</option></select>'; }
           if ($checklevel >= 5 && $checklevel <= 9)
           { echo '<select name="foto_level"><option value="mod">Moderator</option><option value="user">User</option><option value="adminundmod">Admin - IM</option><option value="admin">Admin + IM</option></select>	'; }
           if ($checklevel <= 4)
	         { echo '<select name="foto_level"><option value="user">User</option><option value="mod">Moderator</option><option value="adminundmod">Admin - IM</option><option value="admin">Admin + IM</option></select>	'; }
           echo '</td>';  
                               
     //Bewerbung
           echo '<td>Bewerbung Level :';      
	         $checklevel=$bewerbung_level;		 
           if ($checklevel>=10)
           {echo '<select name="bewerbung_level"><option value="admin">Admin</option><option value="mod">Moderator</option><option value="user">User</option></select>'; }
           if ($checklevel >= 5 && $checklevel <= 9)
           { echo '<select name="bewerbung_level"><option value="mod">Moderator</option><option value="user">User</option><option value="admin">Admin</option></select>	'; }
           if ($checklevel <= 4)
	         { echo '<select name="bewerbung_level"><option value="user">User</option><option value="mod">Moderator</option><option value="admin">Admin</option></select>	'; }
           echo '</td></tr>';    
           
      //Urlaub
           echo '<tr><td>Urlaub Level :';      
	         $checklevel=$urlaub_level;		 
           if ($checklevel>=10)
           {echo '<select name="urlaub_level"><option value="admin">Admin</option><option value="mod">Moderator</option><option value="user">User</option></select>'; }
           if ($checklevel >= 5 && $checklevel <= 9)
           { echo '<select name="urlaub_level"><option value="mod">Moderator</option><option value="user">User</option><option value="admin">Admin</option></select>	'; }
           if ($checklevel <= 4)
	         { echo '<select name="urlaub_level"><option value="user">User</option><option value="mod">Moderator</option><option value="admin">Admin</option></select>	'; }
           echo '</td>';  
                               
    //Events
           echo '<td>Events Level :';      
	         $checklevel=$events_level;		 
           if ($checklevel>=10)
           {echo '<select name="events_level"><option value="admin">Admin</option><option value="mod">Moderator</option><option value="user">User</option></select>'; }
           if ($checklevel >= 5 && $checklevel <= 9)
           { echo '<select name="events_level"><option value="mod">Moderator</option><option value="user">User</option><option value="admin">Admin</option></select>	'; }
           if ($checklevel <= 4)
	         { echo '<select name="events_level"><option value="user">User</option><option value="mod">Moderator</option><option value="admin">Admin</option></select>	'; }
           echo '</td></tr>';    
           
           
           
                //Leer
           echo '<tr><td>leer :';      
	       echo '</td>';  
                               
    //Fundus
           echo '<td>Fundus Level :';      
	         $checklevel=$fundus_level;		 
           if ($checklevel>=10)
           {echo '<select name="fundus_level"><option value="admin">Admin</option><option value="mod">Moderator</option><option value="user">User</option></select>'; }
           if ($checklevel >= 5 && $checklevel <= 9)
           { echo '<select name="fundus_level"><option value="mod">Moderator</option><option value="user">User</option><option value="admin">Admin</option></select>	'; }
           if ($checklevel <= 4)
	         { echo '<select name="fundus_level"><option value="user">User</option><option value="mod">Moderator</option><option value="admin">Admin</option></select>	'; }
           echo '</td></tr>';  

      
      
           echo '</td></tr></table>';
           echo '<table><tr><td><button type="submit">Speichern</button></td><tr></table></form>
           <form method="post" action="index.php"><table><tr><td><button type="submit">Löschen</button>';
           userandpass();
           echo '<input type="hidden" name="del" value="'.$id.'" /></td><tr></table></form><hr />';    
      
           
      }
      else
      { echo 'S-Admin Accounts können nur direkt über die Datenbank editiert werden'; }    
           
         }
           
           
           
           
           
           
           
    }     
           
           
           
}         
  
	
		
	
}





function del_user_sadmin()
{   // Verifiziere Berechtigung
   if (isset($_POST["del"]))
   {
    $delid=filter($_POST["del"]);
	$sql1="SELECT portal_level FROM user WHERE nick='".filter($_POST["userinput"])."' AND pw='".filter($_POST["passinput"])."'";
	$result1=mysql_db_query("portal",$sql1);
	$zeile1=mysql_fetch_array($result1);
	if ($zeile1["portal_level"]<15)
	{ echo '<h1>Zugriff verweigert! Dieser Zugriff wurde Protokoliert!'; exit(); }
	else
	{   // Blockliste
		$$sql2="DELETE FROM blocklist WHERE userid='".$delid."' OR geblockt='".$delid."'";
		$result2=mysql_db_query("portal",$sql2);
		
		// Karriere
		$sql3="DELETE FROM carrer WHERE userid='".$delid."'";
		$result3=mysql_db_query("portal",$sql3);
		
		// Foto
		$sql4="DELETE FROM foto WHERE userid='".$delid."'";
		$result4=mysql_db_query("portal",$sql4);
		
		// GBOOK
		$sql5="DELETE FROM gb WHERE userid='".$delid."'";
		$result5=mysql_db_query("portal",$sql5);
		
		// IM
		$sql6="DELETE FROM im WHERE vonid='".$delid."' OR anid='".$delid."'";
		$result6=mysql_db_query("portal",$sql6);
		
		// User
		$sql7="DELETE FROM user WHERE id='".$delid."' LIMIT 1";
		$result7=mysql_db_query("portal",$sql7);
		
		echo 'User gelöscht !';
		
	}
	
	
	
	
   }		
}
	
function edit_user_admin()
{
	
  if ($_POST["do"]=="edit")
  {		

  $sql="UPDATE user SET 
portal_level='".doswitch(filter($_POST["portal_level"]))."',
news_level='".doswitch(filter($_POST["news_level"]))."',
sendeplan_level='".doswitch(filter($_POST["sendeplan_level"]))."',
chat_level='".doswitch(filter($_POST["chat_level"]))."',
user_level='".doswitch(filter($_POST["user_level"]))."',
download_level='".doswitch(filter($_POST["download_level"]))."',
charts_level='".doswitch(filter($_POST["charts_level"]))."',
gastebuch_level='".doswitch(filter($_POST["gastebuch_level"]))."',
info_level='".doswitch(filter($_POST["user_level"]))."',
playlist_level='".doswitch(filter($_POST["playlist_level"]))."',
grusbox_level='".doswitch(filter($_POST["grusbox_level"]))."',
stats_level='".doswitch(filter($_POST["stats_level"]))."',
forum_level='".doswitch(filter($_POST["forum_level"]))."',
homepage_level='".doswitch(filter($_POST["homepage_level"]))."',
bands_level='".doswitch(filter($_POST["bands_level"]))."',
podcast_level='".doswitch(filter($_POST["podcast_level"]))."',
foto_level='".doswitch(filter($_POST["foto_level"]))."',
bewerbung_level='".doswitch(filter($_POST["bewerbung_level"]))."',
urlaub_level='".doswitch(filter($_POST["urlaub_level"]))."',
events_level='".doswitch(filter($_POST["events_level"]))."' 
WHERE id='".filter($_POST["userid"])."'";

  if ($result=mysql_db_query("portal",$sql)=="1")
  	
  { write_admin_log($sql,"verwaltung","admin_edit");
  echo 'Daten Aktualisiert'; }
  else
  { echo 'sql Fehler';
  echo $sql;}

 }
		
}	

/////////////////////////////////////
//Nick Editieren (SQL), Super Admin//
/////////////////////////////////////
function edit_user_sadmin()
{
	
  if ($_POST["do"]=="edit")
  {		

  $sql="UPDATE user SET 
gb='".filter($_POST["gb"])."',
gb_ort='".filter($_POST["gb_ort"])."',
plz='".filter($_POST["plz"])."',
seit='".filter($_POST["seit"])."',
email='".filter($_POST["email"])."',
discollis='".filter($_POST["discollis"])."',  
buhmann='".filter($_POST["buhmann"])."',
logins='".filter($_POST["logins"])."',
sig='".filter($_POST["sig"])."',
portal_level='".doswitch(filter($_POST["portal_level"]))."',
news_level='".doswitch(filter($_POST["news_level"]))."',
sendeplan_level='".doswitch(filter($_POST["sendeplan_level"]))."',
chat_level='".doswitch(filter($_POST["chat_level"]))."',
user_level='".doswitch(filter($_POST["user_level"]))."',
download_level='".doswitch(filter($_POST["download_level"]))."',
charts_level='".doswitch(filter($_POST["charts_level"]))."',
gastebuch_level='".doswitch(filter($_POST["gastebuch_level"]))."',
info_level='".doswitch(filter($_POST["user_level"]))."',
playlist_level='".doswitch(filter($_POST["playlist_level"]))."',
grusbox_level='".doswitch(filter($_POST["grusbox_level"]))."',
stats_level='".doswitch(filter($_POST["stats_level"]))."',
forum_level='".doswitch(filter($_POST["forum_level"]))."',
homepage_level='".doswitch(filter($_POST["homepage_level"]))."',
bands_level='".doswitch(filter($_POST["bands_level"]))."',
podcast_level='".doswitch(filter($_POST["podcast_level"]))."',
foto_level='".doswitch(filter($_POST["foto_level"]))."',
bewerbung_level='".doswitch(filter($_POST["bewerbung_level"]))."',
urlaub_level='".doswitch(filter($_POST["urlaub_level"]))."',
events_level='".doswitch(filter($_POST["events_level"]))."' ,
fundus_level='".doswitch(filter($_POST["fundus_level"]))."' ,
msn='".filter($_POST["msn"])."',
icq='".filter($_POST["icq"])."',
aim='".filter($_POST["aim"])."',
yahoo='".filter($_POST["yahoo"])."',
skype='".filter($_POST["skype"])."'
WHERE id='".filter($_POST["userid"])."'";
write_admin_log($sql,"verwaltung","sadmin_edit");
  if ($result=mysql_db_query("portal",$sql)=="1")
  { echo 'Daten Aktualisiert'; }
  

 }
		
}
	
?>