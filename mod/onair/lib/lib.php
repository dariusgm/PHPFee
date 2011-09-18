<?php


function get_my_sessionid()
{
	$sql1="SELECT id FROM user WHERE nick='".filter($_POST["userinput"])."' AND pw='".filter($_POST["passinput"])."'";
    $db=mysql_connect("localhost","portal","psacln");   
	$result1=mysql_db_query("portal",$sql1);	
    $zeile1=mysql_fetch_array($result1);
    $_SESSION["id"]=$zeile1["id"];

}

function get_id_by_nick($nick)
{
	$db=mysql_connect("localhost","portal","psacln");
	$sql1="SELECT id FROM user WHERE nick='".filter($nick)."'";
	$result1=mysql_db_query("portal",$sql1);
	$zeile1=mysql_fetch_array($result1);
	return $zeile1["id"];
}

function get_my_sendetitel()
{
	$sql1="SELECT titel FROM sendeplan WHERE stream='".filter($_SESSION["stream"])."' AND von<='".date("Hi")."-10' AND bis>='".date("Hi")."' AND datum='".date("Y-m-d")."' AND userid='".filter($_SESSION["id"])."'";
	$db=mysql_connect("localhost","portal","psacln"); 
    $result1=mysql_db_query("portal",$sql1);
    $zeile1=mysql_fetch_array($result1);
    return $zeile1["titel"];
    
}


function get_items()
{
	$sql1="SELECT COUNT(*) AS anzahl FROM fundus WHERE status=1 AND userid=".filter($_SESSION["id"])."";
	$db=mysql_connect("localhost","portal","psacln"); 	
	$result1=mysql_db_query("portal",$sql1);
	if (mysql_num_rows($result1)==0)
	{ return false; }
	else
	{ $zeile1=mysql_fetch_array($result1);
	  return $zeile1["anzahl"]; }
}


function get_item_list()
{
	$sql1="SELECT id,itemid,COUNT(itemid) AS menge FROM fundus WHERE status=1 AND userid=".filter($_SESSION["id"])." GROUP BY 'itemid'";
	$db=mysql_connect("localhost","portal","psacln"); 	
	$result1=mysql_db_query("portal",$sql1);
	if (mysql_num_rows($result1)>0)
	{ 
		while ($zeile1=mysql_fetch_array($result1))
		{ 
			$sql2="SELECT name FROM fundus_geschenke WHERE id='".$zeile1["itemid"]."'"; 
			$result2=mysql_db_query("portal",$sql2);
			$zeile2=mysql_fetch_array($result2);
			
			echo '<option value="'.$zeile1["id"].'">(insg.'.$zeile1["menge"].') '.$zeile2["name"].'</option>';
			
		}
    }
	else
	{ 
		return '<option value="opt">Keine Geschenke mehr Verf&uuml;gbar</option>';		
    }
}

    
function check_banner($bannerid)
{  
	$str="";
	if (file_exists("../../onair/".$_SESSION["id"]."_".$bannerid.".jpg"))
	{ $str=''.$_SESSION["id"].'_'.$bannerid.'.jpg'; }
	
	if (file_exists("../../onair/".$_SESSION["id"]."_".$bannerid.".gif"))
	{ $str=''.$_SESSION["id"].'_'.$bannerid.'.gif'; }

	if (file_exists("../../onair/".$_SESSION["id"]."_".$bannerid.".png"))
	{ $str=''.$_SESSION["id"].'_'.$bannerid.'.png'; }	
	
	if ($str=="")
	{ return false; }
	else
	{ return $str; }
}


function check_onair($id)
{  
	$str="";
	if (file_exists("../../onair/onair".$_SESSION["id"]."_".$id.".jpg"))
	{ $str='onair'.$_SESSION["id"].'_'.$id.'.jpg'; }
	
	if (file_exists("../../onair/onair".$_SESSION["id"]."_".$id.".gif"))
	{ $str='onair'.$_SESSION["id"].'_'.$id.'.gif'; }

	if (file_exists("../../onair/onair".$_SESSION["id"]."_".$id.".png"))
	{ $str='onair'.$_SESSION["id"].'_'.$id.'.png'; }	
	
	if ($str=="")
	{ return false; }
	else
	{ return $str; }
}


function get_mod()
{
	// Generiere Mod Drop-Down
    $sql1="SELECT nick FROM user WHERE (portal_level<10 AND portal_level>4) OR portal_level>10 ORDER BY 'nick'";
    $db = mysql_connect("localhost", "portal", "psacln") or die("Verbindungsfehler");
    $result1=mysql_db_query("portal",$sql1);
        
   $drop="";
    while($zeile1=mysql_fetch_array($result1))
    {
	    $drop.='<option value="'.$zeile1["nick"].'">'.$zeile1["nick"].'</option>';
    } 
   

return $drop;	
	
	
	
}


function is_mod($mod)
{

	$sql1="SELECT id,portal_level FROM user WHERE nick='".$mod."'";
	$db=mysql_connect("localhost","portal","psacln"); 
	$result1=mysql_db_query("portal",$sql1);
	$zeile1=mysql_fetch_array($result1);
	if (($zeile1["portal_level"]<9 && $zeile1["portal_level"]>=5) || $zeile1["portal_level"]>10)
	{ return $zeile1["id"]; }
	else
	{ return false; }
  
}


function get_config()
{    
	$_SESSION["stream"]=filter($_GET["id"]);
	$sql1="SELECT * FROM grusbox_user_config WHERE userid='".filter($_SESSION["id"])."'";
	$db=mysql_connect("localhost","portal","psacln"); 
	$result1=mysql_db_query("portal",$sql1);	
	// Wenn keine Konfiguration vorhanden ist, erstelle eine mit Standarteinstellungen
	if (mysql_num_rows($result1)==0)
	{
	 $sql2="INSERT INTO grusbox_user_config (userid) VALUES ('".filter($_SESSION["id"])."')";
	 $result2=mysql_db_query("portal",$sql2);
	 $zeile1["banner"]=1;
	 $zeile1["onair"]=1;
	 $zeile1["refresh"]=2;
	 $zeile1["sort"]=1;
			
    }
    else {$zeile1=mysql_fetch_array($result1);}
    
	
	$banner1=check_banner(1);
	$banner2=check_banner(2);
	$banner3=check_banner(3);
	$banner4=check_banner(4);		
	$banner5=check_banner(5);
	$banner6=check_banner(6);
	$banner7=check_banner(7);
	$banner8=check_banner(8);		
	$banner9=check_banner(9);
	$onair1=check_onair(1);			
	$onair2=check_onair(2);
	$geschenke=get_items();
	$modlist=get_mod();
	
	echo '<form method="post" action="check.php"><table><tr><td width="600">Option</td><td>W&auml;hlen</td></tr>';
		
	if ($banner1)
	{echo '<tr><td valign="top"><span style="font-size:35px;color:red;">1</span><img src="../../onair/'.$banner1.'" /></td><td><input type="Radio" name="usebanner" value="1"';
	 if ($zeile1["banner"]==1) { echo ' checked="checked"';}
    echo '></td></tr>';
	 }

	if ($banner2)
	{echo '<tr><td valign="top"><span style="font-size:35px;color:red;">2</span><img src="../../onair/'.$banner2.'" /></td><td><input type="Radio" name="usebanner" value="2"';
	 if ($zeile1["banner"]==2) { echo ' checked="checked"';}
    echo '></td></tr>';
	 }	 
	 	 
	if ($banner3)
	{echo '<tr><td valign="top"><span style="font-size:35px;color:red;">3</span><img src="../../onair/'.$banner3.'" /></td><td><input type="Radio" name="usebanner" value="3"';
	 if ($zeile1["banner"]==3) { echo ' checked="checked"';}
    echo '></td></tr>';
	 }

	if ($banner4)
	{echo '<tr><td valign="top"><span style="font-size:35px;color:red;">4</span><img src="../../onair/'.$banner4.'" /></td><td><input type="Radio" name="usebanner" value="4"';
	 if ($zeile1["banner"]==4) { echo ' checked="checked"';}
    echo '></td></tr>';
	 }	 	 
	 
	if ($banner5)
	{echo '<tr><td valign="top"><span style="font-size:35px;color:red;">5</span><img src="../../onair/'.$banner5.'" /></td><td><input type="Radio" name="usebanner" value="5"';
	 if ($zeile1["banner"]==5) { echo ' checked="checked"';}
    echo '></td></tr>';
	 }

	if ($banner6)
	{echo '<tr><td valign="top"><span style="font-size:35px;color:red;">6</span><img src="../../onair/'.$banner6.'" /></td><td><input type="Radio" name="usebanner" value="6"';
	 if ($zeile1["banner"]==6) { echo ' checked="checked"';}
    echo '></td></tr>';
	 }	 	 
	 
	if ($banner7)
	{echo '<tr><td valign="top"><span style="font-size:35px;color:red;">7</span><img src="../../onair/'.$banner7.'" /></td><td><input type="Radio" name="usebanner" value="7"';
	 if ($zeile1["banner"]==7) { echo ' checked="checked"';}
    echo '></td></tr>';
	 }

	if ($banner8)
	{echo '<tr><td valign="top"><span style="font-size:35px;color:red;">8</span><img src="../../onair/'.$banner8.'" /></td><td><input type="Radio" name="usebanner" value="8"';
	 if ($zeile1["banner"]==8) { echo ' checked="checked"';}
    echo '></td></tr>';
	 }	 	 
	 
	if ($banner9)
	{echo '<tr><td valign="top"><span style="font-size:35px;color:red;">9</span><img src="../../onair/'.$banner9.'" /></td><td><input type="Radio" name="usebanner" value="9"';
	 if ($zeile1["banner"]==9) { echo ' checked="checked"';}
    echo '></td></tr>';
	 }

	if ($onair1)
	{echo '<tr><td valign="top"><span style="font-size:35px;color:blue;">1</span><img src="../../onair/'.$onair1.'" /></td><td><input type="Radio" name="useonair" value="1"';
	 if ($zeile1["onair"]==1) { echo ' checked="checked"';}
    echo '></td></tr>';
	 } 	
	if ($onair2)
	{echo '<tr><td valign="top"><span style="font-size:35px;color:blue;">2</span><img src="../../onair/'.$onair2.'" /></td><td><input type="Radio" name="useonair" value="2"';
	 if ($zeile1["onair"]==2) { echo ' checked="checked"';}
    echo '></td></tr>';
	 } 	
	 
	echo '<tr><td><span style="font-size:18px;color:black;"><br />Refreshrate:</span></td><td><input type="text" name="refresh" value="'.$zeile1["refresh"].'" maxsize="2" size="2" />Minuten</td></tr>'; 	 
    echo '<tr><td><span style="font-size:18px;color:black;"><br />Sortierreinfolge:</span></td><td><select name="sort">';
   
     if ($zeile1["sort"]==1)
    { echo '<option value="1">Oben <b>NEUE</b> Eintr&auml;ge</option><option value="0">Oben <b>ALTE</b> Eintr&auml;ge</option>';}
    else
     { echo '<option value="0">Oben <b>ALTE</b> Eintr&auml;ge</option><option value="1">Oben <b>NEUE</b> Eintr&auml;ge</option>';}
   
     	echo '</select></td></tr><tr><td><span style="font-size:18px;color:black;"><br />Modname:</span></td><td><input type="text" name="usemod" value="'.$_POST["userinput"].'" maxsize="15" size="15" /></td></tr>'; 	 
	echo '<tr><td><span style="font-size:18px;color:black;"><br />Multiuser:</span></td><td><select name="usemultiuser"><option value="nein">--- NEIN ---</option><option value="ja">--- JA ---</option></td></tr>'; 	
	echo '<tr><td><span style="font-size:18px;color:black;"><br />Multiuser 1..5:</span></td><td>
	<select name="multi1"><option value="0">---Bitte wählen</option>'.$modlist.'</select>	
    <select name="multi2"><option value="0">---Bitte wählen</option>'.$modlist.'</select>
    <select name="multi3"><option value="0">---Bitte wählen</option>'.$modlist.'</select>
    <select name="multi4"><option value="0">---Bitte wählen</option>'.$modlist.'</select>
    <select name="multi5"><option value="0">---Bitte wählen</option>'.$modlist.'</select></td></tr>'; 
    
	echo '<tr><td><span style="font-size:18px;color:black;"><br />Sendethema (Titel):</span></td><td><input type="text" name="sendetitel" value="'.get_my_sendetitel().'" maxsize="50" size="50" /></td></tr>'; 	 
    echo '<tr><td><span style="font-size:18px;color:black;"><br />GB Modus:</span></td><td><select name="usemode"><option value="15">--- NORMALER STREAM ---</option>';
    if ($geschenke)
    { echo '<option value="20">--- QUIZMODUS ('.$geschenke.') Geschenke</option>'; }

        
    echo '<option value="10">--- NUR GR&Uuml;&szlig;E ---</option><option value="5">--- GB DEAKTIVIEREN ---</option></td></tr>'; 	 
    echo '<tr><td></td><td><button type="submit">betreten</td></tr>'; 	 
 	echo '</form>';
	
	
	
}


function check_input()
{
	$pretag_error='<span style="font-size:28px;color:red;">';
	$pretag_ok='<span style="font-size:18px;color:green;">';
	$pretag_warning='<span style="font-size:18px;color:#584BFC;">';	
	$aftertag='</span><br />';
	$error="";
	
	// Pr&uuml;fe Banner
	$status_banner=check_banner(filter($_POST["usebanner"]));
	if (!$status_banner)
	{ $error.=$pretag_error." Sie haben einen nicht verf&uuml;gbaren Banner ausgew&auml;hlt!  ".$aftertag; }
	else
	{ echo $pretag_ok." Banner verf&uuml;gbar ".$aftertag; 
	$_SESSION["banner"]==filter($_POST["usebanner"]);}
	
	// Pr&uuml;fe On Air
	$status_onair=check_onair(filter($_POST["useonair"]));	
	if (!$status_onair)
	{ $error.=$pretag_error." Sie haben einen nicht verf&uuml;gbares Live On Air Bild ausgew&auml;hlt! ".$aftertag; }
	else
	{ echo $pretag_ok." Live On Air verf&uuml;gbar ".$aftertag; 
	$_SESSION["onair"]==filter($_POST["useonair"]);}	
	
	//Pr&uuml;fe Refresh
	$refresh=strip_tags(filter($_POST["refresh"]));

	if ($refresh>=1 && $refresh<=9)
	{ echo $pretag_ok." Refresh OK ".$aftertag; 	
	$_SESSION["refresh"]=$refresh;
    }
	else
	{ $error.=$pretag_error." Der Refreshbereich ist au&szlig;erhalb des Vorgesehenen Bereiches! ".$aftertag; }
	
	//Pr&uuml;fe Modname
	    // Entferne Alle html Tags
	$modname=strip_tags(filter($_POST["usemod"]));
	
	if (strlen($modname)<24)
	{

	$sql1="SELECT COUNT(*) AS anzahl FROM user WHERE nick='".$modname."' AND id!='".filter($_SESSION["id"])."'";
	$result1=mysql_db_query("portal",$sql1);
	$zeile1=mysql_fetch_array($result1);
	if ($zeile1["anzahl"]!=0)
	{ $error.=$pretag_error." Der Nickname wird bereits von einer anderen Person benutzt! ".$aftertag; }
	else
	{ echo $pretag_ok." Modname OK ".$aftertag; 
	$_SESSION["modname"]==filter($_POST["usemod"]);}	
	
    }
    else
    { $error.=$pretag_error." Der Modname ist l&auml;nger als 25 Zeichen! ".$aftertag; }
	
	//Pr&uuml;fe Multiuser
	

	
	
	if ($_POST["usemultiuser"]=="ja")
	{ 
		
		$multi1=strip_tags(filter($_POST["multi1"]));
		$multi2=strip_tags(filter($_POST["multi2"]));	
		$multi3=strip_tags(filter($_POST["multi3"]));
		$multi4=strip_tags(filter($_POST["multi4"]));		
		$multi5=strip_tags(filter($_POST["multi5"]));
		
				
     	$_SESSION["multiuser"]=1;		
     	
     	
 		
		if(is_mod($multi1)!=false)
		{ echo $pretag_ok." Multiuser1 OK ".$aftertag; 
		     	$_SESSION["multi1"]=is_mod($multi1);	}
     	else
		{ $error.=$pretag_error." Der Gew&auml;hlte Multiuser hat nicht gen&uuml;gent Rechte um ausgew&auml;hlt zu werden! ".$aftertag; }
		
		if ($multi2!=0)
		{
		   if(is_mod($multi2)!=false)
	    	{ echo $pretag_ok." Multiuser2 OK ".$aftertag; 
		     	$_SESSION["multi2"]=is_mod($multi2)	;}
	    	else
		    { $error.=$pretag_error." Der Gew&auml;hlte Multiuser hat nicht gen&uuml;gent Rechte um ausgew&auml;hlt zu werden! ".$aftertag; }		
        }
		if ($multi3!=0)
		{		
		   if(is_mod($multi3)!=false)
		   { echo $pretag_ok." Multiuser3 OK ".$aftertag; 
		        	$_SESSION["multi3"]=is_mod($multi3)	;}
		   else
		   { $error.=$pretag_error." Der Gew&auml;hlte Multiuser hat nicht gen&uuml;gent Rechte um ausgew&auml;hlt zu werden! ".$aftertag; }		
         }
		if ($multi4!=0)
		{			
	      	if(is_mod($multi4)!=false)
	      	{ echo $pretag_ok." Multiuser4 OK ".$aftertag; 
		     	$_SESSION["multi4"]=is_mod($multi4)	;}
		   else
		   { $error.=$pretag_error." Der Gew&auml;hlte Multiuser hat nicht gen&uuml;gent Rechte um ausgew&auml;hlt zu werden! ".$aftertag; }		
        
		   }
		if ($multi5!=0)
		{		
		   if(is_mod($multi5)!=false)
		   { echo $pretag_ok." Multiuser5 OK ".$aftertag; 
		   $_SESSION["multi5"]=is_mod($multi5);}
		   else
		   { $error.=$pretag_error." Der Gew&auml;hlte Multiuser hat nicht gen&uuml;gent Rechte um ausgew&auml;hlt zu werden! ".$aftertag; }		
        }
   }
      
    // Sendetitel Filtern
	$sendetitel=strip_tags(filter($_POST["sendetitel"]));  
	
	// Sortierreinfolge pr&uuml;fen
	$sort=strip_tags(filter($_POST["sort"]));
	if ($sort==1 || $sort==0)
	{
		echo $pretag_ok." Sortierreinfolge OK ".$aftertag; 
		$_SESSION["sort"]=$sort;
	}
	else
	{ $error.=$pretag_error." Sortierreinfolge hat den falschen Wert! ".$aftertag; }		
     
		
	 
	
	// GB Modus Pr&uuml;fen    
   if(filter($_POST["usemode"])==20)
   { 
	   if (get_items()==true)
	   { $_SESSION["modus"]=20; 
	   echo $pretag_ok." Quizmodus OK ".$aftertag; 
	   }
	   else
	   { $error.=$pretag_error." Der Quizmodus kann nicht ausgew&auml;hlt werden! ".$aftertag; }
   }
   else
   { $modus=strip_tags(filter($_POST["usemode"]));
     if ($modus==5)	   
     { $_SESSION["modus"]=5;  
      echo $pretag_ok." Gru&szlig;box deaktiviert ".$aftertag; 
     }
     elseif ($modus==10)	   
     { $_SESSION["modus"]=10;  
      echo $pretag_ok." \"Nur Gr&uuml;&szlig;e\" Modus aktiviert ".$aftertag; 
     }
     elseif ($modus==15)	   
     { $_SESSION["modus"]=15;  
      echo $pretag_ok." Normaler Modus aktiviert ".$aftertag; 
     }    
    else
    { $error.=$pretag_error." Unbekannter Modus wurde ausgew&auml;hlt! ".$aftertag; }

   }
   
   // Pr&uuml;fe Sendeplan
   $sendeplan=get_my_sendetitel();
   if (empty($sendeplan))
   { // Nicht im Sendeplan, Eintragen bitte :-) und falls Platz belegt, weg damit!
   
      $sql_sendeplan="INSERT INTO sendeplan (datum,von,bis,titel,userid,stream) VALUES ('".date("Y-m-d")."',";
      $uhrzeit=date("Hi");
       


      echo $pretag_warning." Sendeplan erweitert ".$aftertag; 
      
      if ($uhrzeit>0 && $uhrzeit<200){$sql_sendeplan.="'0','200',";               $sql2="DELETE FROM sendeplan WHERE datum='".date("Y-m-d")."' AND von='0' AND bis='200' AND stream='".$_SESSION["stream"]."'"; }
      if ($uhrzeit>200 && $uhrzeit<400){$sql_sendeplan.="'200','400',";           $sql2="DELETE FROM sendeplan WHERE datum='".date("Y-m-d")."' AND von='200' AND bis='400' AND stream='".$_SESSION["stream"]."'"; }
      if ($uhrzeit>400 && $uhrzeit<600){$sql_sendeplan.="'400','600',";           $sql2="DELETE FROM sendeplan WHERE datum='".date("Y-m-d")."' AND von='400' AND bis='600' AND stream='".$_SESSION["stream"]."'"; }
      if ($uhrzeit>600 && $uhrzeit<800){$sql_sendeplan.="'600','800',";           $sql2="DELETE FROM sendeplan WHERE datum='".date("Y-m-d")."' AND von='600' AND bis='800' AND stream='".$_SESSION["stream"]."'"; }
      if ($uhrzeit>800 && $uhrzeit<1000){$sql_sendeplan.="'800','1000',";         $sql2="DELETE FROM sendeplan WHERE datum='".date("Y-m-d")."' AND von='800' AND bis='1000' AND stream='".$_SESSION["stream"]."'"; }
      if ($uhrzeit>1000 && $uhrzeit<1200){$sql_sendeplan.="'1000','1200',";       $sql2="DELETE FROM sendeplan WHERE datum='".date("Y-m-d")."' AND von='1000' AND bis='1200' AND stream='".$_SESSION["stream"]."'"; }
      if ($uhrzeit>1200 && $uhrzeit<1400){$sql_sendeplan.="'1200','1400',";       $sql2="DELETE FROM sendeplan WHERE datum='".date("Y-m-d")."' AND von='1200' AND bis='1400' AND stream='".$_SESSION["stream"]."'"; }
      if ($uhrzeit>1400 && $uhrzeit<1600){$sql_sendeplan.="'1400','1600',";       $sql2="DELETE FROM sendeplan WHERE datum='".date("Y-m-d")."' AND von='1400' AND bis='1600' AND stream='".$_SESSION["stream"]."'"; }
      if ($uhrzeit>1600 && $uhrzeit<1800){$sql_sendeplan.="'1600','1800',";       $sql2="DELETE FROM sendeplan WHERE datum='".date("Y-m-d")."' AND von='1600' AND bis='1800' AND stream='".$_SESSION["stream"]."'"; }
      if ($uhrzeit>1800 && $uhrzeit<2000){$sql_sendeplan.="'1800','2000',";       $sql2="DELETE FROM sendeplan WHERE datum='".date("Y-m-d")."' AND von='1800' AND bis='2000' AND stream='".$_SESSION["stream"]."'"; }
      if ($uhrzeit>2000 && $uhrzeit<2200){$sql_sendeplan.="'2000','2200',";       $sql2="DELETE FROM sendeplan WHERE datum='".date("Y-m-d")."' AND von='2000' AND bis='2200' AND stream='".$_SESSION["stream"]."'"; }
      if ($uhrzeit>2200 && $uhrzeit<2400){$sql_sendeplan.="'2200','2400',";       $sql2="DELETE FROM sendeplan WHERE datum='".date("Y-m-d")."' AND von='2200' AND bis='2400' AND stream='".$_SESSION["stream"]."'"; }

      
      $sql_sendeplan.="'".filter($_POST["sendeplantitel"])."','".filter($_SESSION["id"])."','".filter($_SESSION["stream"])."')";
      $result2=mysql_db_query("portal",$sql2);      
      $result1=mysql_db_query("portal",$sql_sendeplan);
      if (mysql_affected_rows()>0)
      {
	    echo $pretag_warning." User ersetzt ".$aftertag; 
      }
      
      

         
    }
   
   
   if ($error!="")
   { echo $error;
     echo $pretag_error." Der Einlog-Vorgang wurde abgebrochen! ".$aftertag; }
   else
   {   
	   // Alles OK, einstellungen speichern
	   $sql4="UPDATE grusbox_user_config SET banner='".filter($_POST["usebanner"])."',onair='".filter($_POST["useonair"])."',refresh='".filter($_POST["refresh"])."',sort='".filter($_POST["sort"])."' WHERE userid='".filter($_SESSION["id"])."'";
      $result4=mysql_db_query("portal",$sql4);
   
      

	    
	     //Sperre GB (Query anfang !)
	    $sql5="UPDATE grusbox_config SET status='".filter($_SESSION["modus"])."',userid='".filter($_SESSION["id"])."',session='".session_id()."'";
	   
	     // Pr&uuml;fe ob gesperrt
	    $sql6="SELECT userid,session FROM grusbox_config WHERE stream='".$_SESSION["stream"]."'";
        $result6=mysql_db_query("portal",$sql6);
	    $zeile6=mysql_fetch_array($result6);
	    
	    
	    
	    
	    if ($zeile6["userid"]==$_SESSION["id"])
	    { $ok=true; 
	    }
	    
	    elseif ($zeile6["session"]=="")
	    { $ok=true; 
		  $sql5.=",in_time='".time()."'"; 	
		}    
	    else
	    {echo $pretag_error." Die Gru&szlig;box ist noch in Benutzung von ".get_nick_by_id($zeile6["userid"])." sollte der User von Stream geflogen sein, bitte ihn bitte die GB Freizuschalten. ".$aftertag; 
	    $ok=false; }   
	    
	    
	    $sql5.=",multi1='".get_id_by_nick($multi1)."',multi2='".get_id_by_nick($multi2)."',multi3='".get_id_by_nick($multi3)."',multi4='".get_id_by_nick($multi4)."',multi5='".get_id_by_nick($multi5)."' WHERE stream='".filter($_SESSION["stream"])."'";
	   

	    



       if ($ok==true)
	   {
		  	   //  Exportieren
      	 $pfad_link="http://www.discollection-radio.eu/stream";
      	 $pfad_bilder="http://www.discollection-radio.eu/onair/"; 
      	 $pfad_lokal="../../onair/";
      	 	   
	       // HTML Export (Baukasten)
	       $banner_html="<a href=\"".$pfad_link.filter($_SESSION["stream"]).".htm\" target=\"_self\" class=\"stream".$_SESSION["stream"]."\"><img src=\"" . $pfad_bilder . $status_banner. "\" border=\"0\" alt=\"".$modname."\"  /></a>";
	       $bannertext_html="<a href=\"".$pfad_link.filter($_SESSION["stream"]).".htm\" target=\"_self\" class=\"stream".$_SESSION["stream"]."\">".$sendetitel."</a>";
	       $onair_html="<a href=\"".$pfad_link.filter($_SESSION["stream"]).".htm\" target=\"_self\" class=\"stream".$_SESSION["stream"]."\"><img src=\"" . $pfad_bilder . $status_onair. "\" border=\"0\" alt=\"".$modname."\"  /></a>";
	       $onairtext_html ="<a href=\"".$pfad_link.filter($_SESSION["stream"]).".htm\" target=\"_self\" class=\"stream".$_SESSION["stream"]."\">".$modname."</a>";
	      
	       
	        // JavaScript Export (Baukasten)
	       $banner_js = "document.write('<a href=\"".$pfad_link.filter($_SESSION["stream"]).".htm\" target=\"_self\"><img src=\"" . $pfad_bilder . $status_banner. "\" border=\"0\" alt=\"".$modname."\" /></a>');";
	       $bannertext_js = "document.write('<a href=\"".$pfad_link.filter($_SESSION["stream"]).".htm\" target=\"_self\">".$sendetitel."</a>');";
	       $onair_js = "document.write('<a href=\"".$pfad_link.filter($_SESSION["stream"]).".htm\" target=\"_self\"><img src=\"" . $pfad_bilder . $status_onair. "\" border=\"0\" alt=\"".$modname."\" /></a>');";
	       $onairtext_js = "document.write('<a href=\"".$pfad_link.filter($_SESSION["stream"]).".htm\" target=\"_self\">".$modname."</a>');";
	       
	    
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
		   
		    
	   $result5=mysql_db_query("portal",$sql5);   
	    echo $pretag_ok." Eingaben OK, GB gesperrt ".$aftertag; 
	   echo '<form method="post" action="grusbox.php"><button type="submit">GB betreten</button></form>';}
   }
      
}

function get_nick_and_sex_by_id($id)
{
	if ($id!=0)
	{
	$db=mysql_connect("localhost","portal","psacln");
    $sql1="SELECT nick,sex FROM user WHERE id='".$id."'";
    $result1=mysql_db_query("portal",$sql1);
    $zeile1=mysql_fetch_array($result1);
    return $zeile1["nick"]."(".$zeile1["sex"].")";	
    }
    else
    { return "Gast (?)"; }
    
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

function send_email($an,$betreff,$text)
{
              
        
  @mail($an, $betreff, $text,"From: SYSTEM <system@discollection-radio.eu>");

}   




function do_grusbox()
{
	
	$db=mysql_connect("localhost","portal","psacln");	
	$id=strip_tags(filter($_POST["id"]));
	$do=strip_tags(filter($_POST["do"]));
	
	
	if ($id!=0)
	{
	
		if (is_numeric($do))
		{ 
				// Hole User id der beschenkt wird 
	 		   $sql1="SELECT userid FROM grusbox_live WHERE stream=".$_SESSION["stream"]." AND id=".$id."";  
	 		   $result1=mysql_db_query("portal",$sql1);
	 		   $zeile1=mysql_fetch_array($result1);
	  		  echo $sql1;
	    
	  		  // Hole Itemid des Gewinners
	  		  $sql2="SELECT itemid FROM fundus WHERE id='".$do."'";
	  		  $result2=mysql_db_query("portal",$sql2);
	  		  $zeile2=mysql_fetch_array($result2);
	    
	  		  // Hole Geschenkname aus der Itemid
	  		  $sql3="SELECT name FROM fundus_geschenke WHERE id='".$zeile2["itemid"]."'";
	  		  $result3=mysql_db_query("portal",$sql3);
	  		  $zeile3=mysql_fetch_array($result3);
	    
	 		   // Setze Status auf "bearbeitet"
				$sql4="UPDATE fundus SET status=2,verlosung_userid=".$zeile1["userid"].",verlosung_am='".date("Y-m-d")."',verlosung_um='".date("H:i:s")."' WHERE id='".$do."'";
				$result4=mysql_db_query("portal",$sql2);
		
				// Hole nick,email adresse vom gewinner
				$sql5="SELECT nick,email FROM user WHERE id='".$zeile1["userid"]."'";
				$result5=mysql_db_query("portal",$sql5);
				$zeile5=mysql_fetch_array($result5);
		
				// Pr&uuml;fe ob Adresse schon eingetragen
				$sql6="SELECT COUNT(*) AS result FROM fundus_adressen WHERE userid='".$zeile1["userid"]."'";
				$result6=mysql_db_query("portal",$sql6);
				$zeile6=mysql_fetch_array($result6);
		
				// generiere Info Mail an den User
				$text="Hallo ".$zeile5["nick"]." du hast bei Discollection Radio am Quiz Teilgenommen und gewonnen.
				Dein Gewinn ist: ".$zeile3["name"]."";
		
						if ($zeile6["result"]==1)
						{ $text.=" Deine Adresse ist bereits bei uns hinterlegt. Sollte sich an ihr was ge&auml;ndert haben, &uuml;bermittle bitte die Korrekten Daten an geschenke@discollection-radio.eu. "; }
						else
						{ $text.=" Deine Adresse ist noch nicht bei uns hinterlegt. Bitte schreibe eine Kurze E-Mail mit folgenden Angaben: Vorname, Nachname, Wohnort, Postleitzahl, Land und Sonstigen relevanten Informationen an geschenke@discollection-radio.eu. Unser Team ist zum Datenschutz verpflichtet. N&auml;here Informationen kannst du im \"Impressum\" Entnehmen, Links auf der Seite.";
	   				    }
	    
				send_email($zeile5["email"],"Dein Gewinn bei DCR",$text);
	    
				$sql7="UPDATE grusbox_live SET art=0,out_time=".time()." WHERE stream=".$_SESSION["stream"]." AND id=".$id."";
    			$result7=mysql_db_query("portal",$sql7);
		
		
		}
		
  	 	if ($do=="del")
  	 	 {  // 1x L&ouml;schen Bitte 
	  	$sql1="UPDATE grusbox_live SET art=0,out_time=".time()." WHERE stream=".$_SESSION["stream"]." AND id=".$id."";
    	$result1=mysql_db_query("portal",$sql1);
   		}
   		
   		 if ($do=="delolderthan")
  	 	 {  // 1x Altes l&ouml;schen
  	 	 //".time()-filter($_POST["id"])."
  	 	$time=time()-filter($_POST["id"]);
	  	$sql1="UPDATE grusbox_live SET art=0,out_time=".time()." WHERE stream=".$_SESSION["stream"]." AND in_time<".$time."";
	  	$result1=mysql_db_query("portal",$sql1);
   		}
    
        if ($do=="ban")
        {
	    // Hole User id der geblockt werden soll   
	    $sql1="SELECT userid FROM grusbox_live WHERE stream=".$_SESSION["stream"]." AND id=".$id."";  
	    $result1=mysql_db_query("portal",$sql1);
	    $zeile1=mysql_fetch_array($result1);
	    
	    // pakce in die "gebannt" Liste ( F&uuml;r Hauptseite)
	    $sql2="INSERT INTO grusbox_ban (geblockt_userid,userid,stream) VALUES('".$zeile1["userid"]."','".filter($_SESSION["id"])."','".filter($_SESSION["stream"])."')";
	    $result2=mysql_db_query("portal",$sql2);
	    
	    // L&ouml;sche alle eintr&auml;ge des St&ouml;rers
	    $sql4="UPDATE grusbox_live SET art=0,out_time=".time()." WHERE stream=".$_SESSION["stream"]." AND userid=".$zeile1["userid"]."";
    	$result4=mysql_db_query("portal",$sql4);
        }
        
        if ($do=="notiz")
        {  
	        //Hole den Text mit Datum und User
	        $sql1="SELECT userid,in_time,in_text FROM grusbox_live WHERE stream=".$_SESSION["stream"]." AND id=".$id."";
            $result1=mysql_db_query("portal",$sql1);
            $zeile1=mysql_fetch_array($result1);
	        
            //Hole den Notizblock
	        $sql1_1="SELECT notizblock FROM user WHERE id=".$_SESSION["id"]."";
            $result1_1=mysql_db_query("portal",$sql1_1);
            $zeile1_1=mysql_fetch_array($result1_1);            
            
            if($zeile1_1["notizblock"]==NULL)
            {
	            $sql2="UPDATE user SET notizblock='
            
            - Der User 
            ".get_nick_by_id($zeile1["userid"])." hat dir am
            ".date("d.m.Y",$zeile1["in_time"])." 
             folgenden Text in die Gru&szlig;box geschrieben:
            ".$zeile1["in_text"]."' WHERE id='".filter($_SESSION["id"])."'";
            }
            else
            {
	            $sql2="UPDATE user SET notizblock=CONCAT(notizblock,\"
            
            - Der User 
            ".get_nick_by_id($zeile1["userid"])." hat dir am
            ".date("d.m.Y",$zeile1["in_time"])." 
             folgenden Text in die Gru&szlig;box geschrieben:
            ".$zeile1["in_text"]."\") WHERE id='".filter($_SESSION["id"])."'";
            
            }
            
          $result2=mysql_db_query("portal",$sql2);
	            
          $sql3="UPDATE grusbox_live SET art=0,out_time=".time()." WHERE stream=".$_SESSION["stream"]." AND id=".$id."";
    	    $result3=mysql_db_query("portal",$sql3); 
    	    }
        
   }

}

function show_grusbox()
{
	$db=mysql_connect("localhost","portal","psacln");
	$sql0="SELECT `session` FROM grusbox_config WHERE stream='".$_SESSION["stream"]."'";
	$result0=mysql_db_query("portal",$sql0);
	$zeile0=mysql_fetch_array($result0);
	if ($zeile0["session"]!=session_id())
	{ echo '...und tsch&uuml;&szlig; !'; exit();}

	
	
	
	$sql1="SELECT * FROM grusbox_live WHERE stream='".$_SESSION["stream"]."' AND art!=0 ORDER BY 'id'";
	   if ($_SESSION["sort"]==1)
	   { $sql1.=" DESC"; }
	$result1=mysql_db_query("portal",$sql1);
	
    if(mysql_num_rows($result1)>0)
    {	   
	echo '<head><meta http-equiv="refresh" content="';
    echo $_SESSION["refresh"]*60;
    echo '"; url="grusbox.php"; /> <meta http-equiv="content-type" content="text/html; charset=UTF-8"><title>'.mysql_num_rows($result1).' Eintr&auml;ge Gru&szlig;box 4.0</title></head>
	
	
	<table border="0" cellspacing="0" cellpadding="0" style="background-color:#808080;"><tr><td width="50">ID</td><td width="100">User</td><td width="250">Text</td><td width="250">Eingangszeit</td><td width="75">IP</td><td></td></tr>';
    
	$color=0;
	$color1="#4169E1;";
	$color2="#6B8E23;";
	while($zeile1=mysql_fetch_array($result1))
    {
	    echo '<tr style="background-color:';
	    
	    if ($color==0) {echo $color1; $color=1;}
	    else {echo $color2; $color=0;}
	    
	    echo '"><td><span style="font-family:\'Arial Black\';font-size:12px;">'.$zeile1["id"].'</span></td><td><span style="font-family:\'Arial\';font-size:18px;">'.get_nick_by_id($zeile1["userid"]).'</span></td><td><span style="font-family:\'Arial Black\';font-size:14px;">'.get_utf(unfilter($zeile1["in_text"])).'</span></td><td><span style="font-family:\'Arial\';font-size:13px;">'.date("H:i:s d.m.Y",$zeile1["in_time"]).'</span></td><td><span style="font-family:\'Arial\';font-size:13px;">'.$zeile1["ip"].'</span></td><td><form method="post" action="grusbox.php"><input type="hidden" name="id" value="'.$zeile1["id"].'" /><select name="do"><option value="opt">---Option ausw&auml;hlen</option><option value="del">L&ouml;schen</option><option value="notiz">+ Notizblock verschieben</option><option value="ban"> + Bannen</option>';
	    if ($_SESSION["modus"]==20)
	    { echo '<option value="opt">---Geschenk zuweisen</option>';
		    get_utf(get_item_list());
	    }
	    
	    echo '</select></td><td><button type="submit">Ausf&uuml;hren</button></td></form></tr>';	
	
    }
    
    echo '</table>';
	}
    else
    {   
	    echo '
	<html><head> 
    <meta http-equiv="refresh" content="';
   echo 60*$_SESSION["refresh"];
   echo '"; url="grusbox.php"; /> <meta http-equiv="content-type" content="text/html; charset=UTF-8"><title>0 Eintr&auml;ge - Gru&szlig;box 4.0</title></head><body>Es sind keine Eintr&auml;ge in der Gru&szlig;box vorhanden</body></html>'; 
   }

   echo '<form method="post" action="grusbox.php"><table><tr><td>Refreshrate(1...9):</td><td><input type="text" name="new_refresh" size="2" maxsize="2" value="'.$_SESSION["refresh"].'" /></td></tr>
   <tr><td>Sortieren:</td><td><select name="new_sort">';
   
     if ($_SESSION["sort"]==1)
    { echo '<option value="1">Oben NEUE Eintr&auml;ge</option><option value="0">Oben <b>ALTE</b> Eintr&auml;ge</option>';}
    else
     { echo '<option value="0">Oben ALTE Eintr&auml;ge</option><option value="1">Oben <b>NEUE</b> Eintr&auml;ge</option>';}
   
     	echo '</select></td></tr>
   <tr><td colspan="2"><button type="submit">&Auml;ndern</button></td></tr></table></form><br /><hr /><br />
   
   <table><tr><td><form method="post" action="grusbox.php"><input type="hidden" name="do" value="delolderthan" /><select name="id"><option value="60">1 Minute</option><option value="120">2 Minuten</option></select><br /><button type="submit" style="font-family:\'Arial Black\';font-size:12px;color:blue;">Gru&szlig;box leeren</button></form></td></tr></table><br /><br /><br />
   <table><tr><td><form method="post" action="quit.php"><select name="logoutmode"><option value="mod">Mod als Nachfolger</option><option value="nonstop">Nonstop als Nachfolger</option></select><br /><button type="submit" style="font-family:\'Arial Black\';font-size:10px;color:red;">Gru&szlig;box verlassen (ausloggen)</button></form></td></tr></table>';
   
   
}

function change_settings()
{   
	 $new_refresh=strip_tags(filter($_POST["new_refresh"]));
	 $new_sort=strip_tags(filter($_POST["new_sort"]));
	  
	if (!empty($new_refresh))
	{ if ($new_refresh>=1 && $new_refresh<9)
	  { $_SESSION["refresh"] = $new_refresh;
	  	  if ($new_sort==1 || $new_sort==0)
	      { $_SESSION["sort"] = $new_sort;

	       echo '<meta http-equiv="refresh" content="1"; url="grusbox.php"; />';
	      }
	  }	  
    }
	
}


?>

