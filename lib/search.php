<?php

function calculate_age($date)
{
   $tag   = substr($date,8,2);
   $monat = substr($date,5,2);
   $jahr  =  substr($date,0,4);

   
   $jetzt = mktime(0,0,0,date("m"),date("d"),date("Y"));
   $geburtstag = mktime(0,0,0,$monat,$tag,$jahr);
   $alter   = intval(($jetzt - $geburtstag) / (3600 * 24 * 365)); 	
   return $alter;
	
}


function search_user () {
   if ($_POST["do"]=="search")
   {
	   
	  if (strlen($_POST["searchuser"])>=3 && strlen($_POST["searchplz"]>2))
	  { $sql1="SELECT nick,sex,gb,plz,seit,discollis,show_gb,show_sex,show_plz,show_seit FROM user WHERE nick LIKE '%". filter($_POST["searchuser"])."%' AND plz LIKE '%".filter($_POST["searchplz"])."%' AND show_nick='1'  "; 
       $db = mysql_connect("localhost", "portal", "psacln") or die("Verbindungsfehler");  
	   $result1=mysql_db_query("portal",$sql1);
      }
      
      
	   
      if (strlen($_POST["searchuser"])<3)
      { echo "Der Nickname, der gesucht wurde, war k&uuml;rzer als 3 Zeichen. Die Eingabe wurde ignoriert.<br />"; } 
      else
      {   $sql2="SELECT nick,sex,gb,plz,seit,discollis,show_gb,show_sex,show_plz,show_seit FROM user WHERE nick LIKE '%". filter($_POST["searchuser"])."%' AND show_nick='1' ";   
      $db = mysql_connect("localhost", "portal", "psacln") or die("Verbindungsfehler");    
      $result2=mysql_db_query("portal",$sql2); 
      }    
      
      if (strlen($_POST["searchplz"])<3)
      { echo "Die Postleitzahl ist k&uuml;rzer als 3 Zeichen. Die Eingabe wurde ignoriert<br />";  }
      else
      {   $sql3="SELECT nick,sex,gb,plz,seit,discollis,show_gb,show_sex,show_plz,show_seit FROM user WHERE plz LIKE '%".filter($_POST["searchplz"])."%' AND show_nick='1'  ";  
      $db = mysql_connect("localhost", "portal", "psacln") or die("Verbindungsfehler");    
      $result3=mysql_db_query("portal",$sql3); 
      } 
      
      if ((@mysql_num_rows($result3)+@mysql_num_rows($result2))==0)
      { echo "Ihre Suchanfrage ergab keine Treffer. Versuchen Sie es mit weniger Zeichen."; }
      else
      {
      
      
      
      echo '<table cellpadding="5" border="1"><tr><td></td><td><a href="index.php?x=faq#Nick"><u>Nick</u></a></td><td><a href="index.php?x=faq#G"><u>G</u></a></td><td><a href="index.php?x=faq#plz"><u>PLZ</u></a></td><td colspan="3">Kontakt</td><td>Alter</td><td>Mitglied Seit</td><td><a href="index.php?x=faq#discollis"><u>Discollis</u></a></td></tr>
';
	    if (@mysql_num_rows($result1)>0)
	    {        
           while ($zeile1=@mysql_fetch_array($result1))
           {
      
           echo '<tr><td><img src="./sample/online.gif" /></td><td><a href="index.php?x=show&nick='.$zeile1["nick"].'"><u>'.$zeile1["nick"].'</u></td><td>';
           
           if ($zeile1["show_sex"]=="1")
           {
              if ($zeile1["sex"]=="m") 
              { echo " &#x2642;"; }
              else {echo " &#x2640;"; }
           }
           else
           { echo '<center><img src="./sample/block.gif" /></center>'; }           
           
              
           echo '</td><td>';
           
           if ($zeile1["show_plz"]=="1")
           {echo $zeile1["plz"]; }
           else { echo '<center><img src="./sample/block.gif" /></center>'; }
           
           echo '</td><td><a href="index.php?x=mitteilungen&nick='.$zeile1["nick"].'"><u>IM</u></a></td>';
           
           echo '<td><a href="index.php?x=email&nick='.$zeile1["nick"].'"><u>E-Mail</u></a></td><td><a href="./homepage/'.$zeile1["nick"].'.htm" target="_blank"><u>HP</u></a></td>';
           if ($zeile1["show_gb"]=="1")
           { echo '<td>'.calculate_age($zeile1["gb"]).'</td>';}
           else { echo '<td><center><img src="./sample/block.gif" /></center></td>'; }
           
           if ($zeile1["show_seit"]=="1")
           { echo '<td>'.substr($zeile1["seit"],8,2).'.'.substr($zeile1["seit"],5,2).'.'.substr($zeile1["seit"],0,4).'</td>'; }
           else { echo '<td><center><img src="./sample/block.gif" /></center></td>'; }           
           
           echo '<td>'.$zeile1["discollis"].'</td></tr>';   
 
           }
       }
       else
       {
       
	    if (@mysql_num_rows($result2)>0)
	    {        
           while ($zeile1=@mysql_fetch_array($result2))
           {
      
           echo '<tr><td><img src="./sample/online.gif" /></td><td><a href="index.php?x=show&nick='.$zeile1["nick"].'"><u>'.$zeile1["nick"].'</u></td><td>';
           
           if ($zeile1["show_sex"]=="1")
           {
              if ($zeile1["sex"]=="m") 
              { echo " &#x2642;"; }
              else {echo " &#x2640;"; }
           }
           else
           { echo '<center><img src="./sample/block.gif" /></center>'; }           
           
              
           echo '</td><td>';
           
           if ($zeile1["show_plz"]=="1")
           {echo $zeile1["plz"]; }
           else { echo '<center><img src="./sample/block.gif" /></center>'; }
           
           echo '</td><td><a href="index.php?x=mitteilungen&nick='.$zeile1["nick"].'"><u>IM</u></a></td>';
           
           echo '<td><a href="index.php?x=email&nick='.$zeile1["nick"].'"><u>E-Mail</u></a></td><td><a href="./homepage/'.$zeile1["nick"].'.htm" target="_blank"><u>HP</u></a></td>';
           if ($zeile1["show_gb"]=="1")
           { echo '<td>'.calculate_age($zeile1["gb"]).'</td>';}
           else { echo '<td><center><img src="./sample/block.gif" /></center></td>'; }
           
           if ($zeile1["show_seit"]=="1")
           { echo '<td>'.substr($zeile1["seit"],8,2).'.'.substr($zeile1["seit"],5,2).'.'.substr($zeile1["seit"],0,4).'</td>'; }
           else { echo '<td><center><img src="./sample/block.gif" /></center></td>'; }           
           
           echo '<td>'.$zeile1["discollis"].'</td></tr>';   
           }
       }       
       
	    if (@mysql_num_rows($result3)!=0)
	    {        
           while ($zeile1=@mysql_fetch_array($result3))
           {
      
           echo '<tr><td><img src="./sample/online.gif" /></td><td><a href="index.php?x=show&nick='.$zeile1["nick"].'"><u>'.$zeile1["nick"].'</u></td><td>';
           
           if ($zeile1["show_sex"]=="1")
           {
              if ($zeile1["sex"]=="m") 
              { echo " &#x2642;"; }
              else {echo " &#x2640;"; }
           }
           else
           { echo '<center><img src="./sample/block.gif" /></center>'; }           
           
              
           echo '</td><td>';
           
           if ($zeile1["show_plz"]=="1")
           {echo $zeile1["plz"]; }
           else { echo '<center><img src="./sample/block.gif" /></center>'; }
           
           echo '</td><td><a href="index.php?x=mitteilungen&nick='.$zeile1["nick"].'"><u>IM</u></a></td>';
           
           echo '<td><a href="index.php?x=email&nick='.$zeile1["nick"].'"><u>E-Mail</u></a></td><td><a href="./homepage/'.$zeile1["nick"].'.htm" target="_blank"><u>HP</u></a></td>';
           if ($zeile1["show_gb"]=="1")
           { echo '<td>'.calculate_age($zeile1["gb"]).'</td>';}
           else { echo '<td><center><img src="./sample/block.gif" /></center></td>'; }
           
           if ($zeile1["show_seit"]=="1")
           { echo '<td>'.substr($zeile1["seit"],8,2).'.'.substr($zeile1["seit"],5,2).'.'.substr($zeile1["seit"],0,4).'</td>'; }
           else { echo '<td><center><img src="./sample/block.gif" /></center></td>'; }           
           
           echo '<td>'.$zeile1["discollis"].'</td></tr>';   
           }
       }
      
     }       
       
     echo "</table>";  
     }
   
   
     
   
   }
else
{
	# Zeige neuste User
	
	echo 'Die neusten Mitglieder bei Discollection Radio:';
	echo '<table cellpadding="5" border="1"><tr><td></td><td><a href="index.php?x=faq#Nick"><u>Nick</u></a></td><td><a href="index.php?x=faq#G"><u>G</u></a></td><td><a href="index.php?x=faq#plz"><u>PLZ</u></a></td><td colspan="3">Kontakt</td><td>Alter</td><td>Mitglied Seit</td><td><a href="index.php?x=faq#discollis"><u></u></a></td></tr>';
	$sql="SELECT nick,sex,gb,plz,seit,discollis,show_gb,show_sex,show_plz,show_seit FROM user ORDER BY id DESC LIMIT 5";
	$db=mysql_connect("localhost","portal","psacln");
	$result=mysql_db_query("portal",$sql);
	while ($zeile1=@mysql_fetch_array($result))
           {
      
           echo '<tr><td><img src="./sample/online.gif" alt="" /></td><td><a href="show.htm?nick='.$zeile1["nick"].'"><u>'.$zeile1["nick"].'</u></td><td>';
           
           if ($zeile1["show_sex"]=="1")
           {
              if ($zeile1["sex"]=="m") 
              { echo " &#x2642;"; }
              else {echo " &#x2640;"; }
           }
           else
           { echo '<center><img src="./sample/block.gif" alt="" /></center>'; }           
           
              
           echo '</td><td>';
           
           if ($zeile1["show_plz"]=="1")
           {echo $zeile1["plz"]; }
           else { echo '<center><img src="./sample/block.gif" alt="" /></center>'; }
           
           echo '</td><td><a href="mitteilungen.htm?nick='.$zeile1["nick"].'"><u>IM</u></a></td>';
           
           echo '<td><a href="email.htm?nick='.$zeile1["nick"].'"><u>E-Mail</u></a></td><td><a href="./homepage/'.$zeile1["nick"].'.htm" target="_blank"><u>HP</u></a></td>';
           if ($zeile1["show_gb"]=="1")
           { echo '<td>'.calculate_age($zeile1["gb"]).'</td>';}
           else { echo '<td><center><img src="./sample/block.gif" alt="" /></center></td>'; }
           
           if ($zeile1["show_seit"]=="1")
           { echo '<td>'.substr($zeile1["seit"],8,2).'.'.substr($zeile1["seit"],5,2).'.'.substr($zeile1["seit"],0,4).'</td>'; }
           else { echo '<td><center><img src="./sample/block.gif" alt="" /></center></td>'; }           
           
           echo '<td>'.$zeile1["discollis"].'</td></tr>';   
           }
           echo "</table>"; 
echo "Bitte geben Sie oben den Suchbegriff ein, um jemanden aus Ihrem Freundeskreis oder aus Ihrer Umgebung zu suchen.<br />
Die Ergebnisse werden dann hier angezeigt.";
}

}

?>