<?php
function write_slideshow()
{
	$nick=get_nick();
	
	$db=mysql_connect("localhost","portal","psacln");
	$sql1="SELECT foto1,foto2,foto3,foto4,foto5 FROM user WHERE nick='".$nick."'";
	$result1=mysql_db_query("portal",$sql1);
	$zeile1=mysql_fetch_array($result1);
	
	
		//FOTO 1
	
	if ($zeile1["foto1"]=="-1")
    { $file1='./sample/nopic.gif'; }
    elseif ($zeile1["foto1"]=="-2")
    { $file1='./sample/edit.gif';  }
	else
    { 
    
    
	  if(file_exists("./foto/".$zeile1["foto1"].".jpg"))
    	 { $file1= './foto/'.$zeile1["foto1"].'.jpg';
    	  }
    	 elseif(file_exists("./foto/".$zeile1["foto1"].".gif"))
   	 	 { $file1='./foto/'.$zeile1["foto1"].'.gif'; 
   	 	 }
   	 	 else
   	 	 { $file1='./foto/'.$zeile1["foto1"].'.png'; 
   	 	 }
	 }
	 
	 
	// Foto 1 Ende
	echo '<img src="'.$file1.'" alt="" border="0" />';
	
}
	

function show_gbook_added()
{
$db=mysql_connect("localhost","portal","psacln");	
$sql1="SELECT discollis FROM user WHERE id='".$_SESSION["id"]."'";
$result1=mysql_db_query("portal",$sql1);
$zeile1=mysql_fetch_array($result1);

$sql2="SELECT id,beschreibung,discollis FROM item WHERE discollis<'".$zeile1["discollis"]."'";
$result2=mysql_db_query("portal",$sql2);
    echo '<form method="post" action="index.php?x=show&nick='.filter($_GET["nick"]).'"><table><tr><td><textarea name="gb_text" rows="5" cols="20">Deine Nachricht</textarea></td></tr><tr><td>Geschenk hinzuf&uuml;gen:<br /></td></tr><tr><td><select name="item"><option value="0">Nichts</option>';
      
    
     if (mysql_num_rows($result2)!=0)
    {
	
 while($zeile2=mysql_fetch_array($result2))
        {
	     echo '<option value="'.$zeile2["id"].'">'.get_utf($zeile2["beschreibung"]).' ('.$zeile2["discollis"].' Discollis)</option>';
	
        }
    }
   echo '</select></td></tr><tr><td><button type="submit">Eintragen</button></td></tr></table></form>';	
	
	

}
////////////////////////////////////// 
//////////////////////////////////////
//////////////////////////////////////
//////////////////////////////////////

function added_gbook() {
if (isset($_GET["nick"]) && $_POST["gb_text"]!="" && isset($_POST["item"]) && isset($_SESSION["id"]))		
   {
   
	$itemid=filter($_POST["item"]);   
	   
   $db=mysql_connect("localhost","portal","psacln");	
   // Hole Discolls vom Versender
   $sql2="SELECT discollis FROM user WHERE id='".filter($_SESSION["id"])."'";
   $result2=mysql_db_query("portal",$sql2);
   $zeile2=mysql_fetch_array($result2);
   $discollis=$zeile2["discollis"];

 
   
   if ($itemid==0)
   { $kosten=0;}
   else 
   {
   //Hole Kosten fuer Item
   $sql3="SELECT discollis FROM item WHERE id='".$itemid."'";
   $result3=mysql_db_query("portal",$sql3);
   $zeile3=mysql_fetch_array($result3);
   $kosten=$zeile3["discollis"];
   }
   
   if ($discollis>=$kosten)
      {
       //Hole empfauenger id
      $sql1="SELECT id FROM user WHERE nick='".filter($_GET["nick"])."'";
      $result1=mysql_db_query("portal",$sql1);
      $zeile1=mysql_fetch_array($result1);
      
      
           //Pruefe ob geblockt
	 $sql0="SELECT grund FROM blocklist WHERE userid='".$zeile1["id"]."' AND geblockt='".filter($_SESSION["id"])."'";
	 $db=mysql_connect("localhost","portal","psacln");
	 $result0=mysql_db_query("portal",$sql0);
	 $zeile0=mysql_fetch_array($result0);
	 if (mysql_num_rows($result0)==1)
	 { echo 'Du wurdest von diesem User blockiert.<br />';
	     if (empty($zeile0["grund"]))
	     { echo 'Der Benutzer hat allerdings keine Begr&uuml;ndung angegeben<br />';}
	     else
	     { echo 'Dir wurde folgende Begr&uuml;ndung hinterlassen: '.htmlspecialchars($zeile0["grund"]).'<br />'; }
     
     }
     else
     {
      //Bezahle fuer Item (Bei Kosten=0 Recht unnoetig, aber naja ...)
      $sql4="UPDATE user SET discollis=discollis-".$kosten." WHERE id='".filter($_SESSION["id"])."'";
      write_user_log($sql4,"show","added_gbook");
      $db=mysql_connect("localhost","portal","psacln");
      $result4=mysql_db_query("portal",$sql4);
      

  
      
      $sql5="INSERT INTO gb (userid, anid, datum, uhrzeit, itemid, text, ip, host, proxy, visible) VALUES(
      '".$_SESSION["id"]."',
      '".$zeile1["id"]."',
      '".date("Y-m-d")."',     
       '".date("H:i:s")."',
      '".$itemid."',
      '".htmlspecialchars(filter($_POST["gb_text"]))."',
      '".$_SERVER["REMOTE_ADDR"]."',
      '".gethostbyaddr($_SERVER["REMOTE_ADDR"])."',
      '".$_SERVER["HTTP_X_FORWARDED_FOR"]."','1')";
      $db=mysql_connect("localhost","portal","psacln");
      $result5=mysql_db_query("portal",$sql5);
      if ($result5)
      { echo '<b><u>Dein Eintrag wurde aufgenommen</u></b>';
       do_send_verify($_SESSION["id"],$zeile1["id"]);}
      
      
    }   
      
      }
   else
      { echo 'Du hast nicht gen&uuml;gent Discollis um diese Geschenk zu w&auml;hlen. Dein Eintrag wurde <b><u>nicht</u></b> aufgenommen.'; }



   }
  
 

}

////////////////////////////////////// 
//////////////////////////////////////
//////////////////////////////////////
//////////////////////////////////////

function calculate_age($date)
{
   $tag   = substr($date,8,2);
   $monat = substr($date,5,2);
   $jahr  =  substr($date,0,4);

   
   $jetztjahre = date("Y")-$jahr;
   $jetztdatum = date("m") . date("d");
   if ($jetztdatum >= $monat.$tag)   
   { return $jetztjahre; }
   else
   { return $jetztjahre-1; }
	
}

//////////////////////////////////////
//////////////////////////////////////
//////////////////////////////////////
//////////////////////////////////////

function get_nick()
{
if (isset($_GET["nick"]))
{ $nick = $_GET["nick"];}


 else
{ $nick = $_SESSION["nick"]; }	

return $nick;
	
}
//////////////////////////////////////
//////////////////////////////////////
//////////////////////////////////////
//////////////////////////////////////

function show_carrer()
{
	
$nick = get_nick();

	
$db=mysql_connect("localhost","portal","psacln");	
$sql="SELECT id FROM user WHERE nick='".filter($nick)."'";

$result=mysql_db_query("portal",$sql);

 $zeile=mysql_fetch_array($result);
 $sql2="SELECT * FROM carrer WHERE userid='".$zeile["id"]."' ORDER BY 'datum' AND 'uhrzeit'  DESC LIMIT 0,10";

 $result2=mysql_db_query("portal",$sql2);

 while($zeile2=mysql_fetch_array($result2))
 {
	 echo '<tr><td width="80">'.substr($zeile2["datum"],8,2).'.'.substr($zeile2["datum"],5,2).'.'.substr($zeile2["datum"],0,4).'</td><td>'.get_utf(nl2br($zeile["text"])).'</td></tr>';
 }




 
}

//////////////////////////////////////
//////////////////////////////////////
//////////////////////////////////////
//////////////////////////////////////

function show_gbook()
{
	$color1=' style="background-color:#FF8040;"';
	$color2=' style="background-color:#FEEDAB;"';

	// Hole Nickname aus GET, Session oder nehme default -> pr&uuml;fe ob er eintr&auml;ge hat, hole id der eintr&auml;ge, hole nickname, zeige alles an
	
$nick = get_nick();

	
$db=mysql_connect("localhost","portal","psacln");	
$sql="SELECT id FROM user WHERE nick='".filter($nick)."' AND show_gbook=1";

$result=mysql_db_query("portal",$sql);
//Gaestebuch Funktion deaktiviert ?
 if (mysql_num_rows($result)=="0")
 {	echo 'Das G&auml;stebuch ist nicht &ouml;ffentlich.'; }		
 else
 {
 $zeile=mysql_fetch_array($result);
 $sql2="SELECT * FROM gb WHERE anid='".$zeile["id"]."'AND visible=1 ORDER BY 'datum' DESC LIMIT 0,10";

 $result2=mysql_db_query("portal",$sql2);
 echo '<table border="0" cellspacing="0" cellpadding="5">';
 while($zeile2=mysql_fetch_array($result2))
 {
	 
	 	if ($i%2==0)	{$color=$color1;}
		else { $color=$color2;}
		
	 
	 $sql3="SELECT nick FROM user WHERE id='".$zeile2["userid"]."'";
	 $result3=mysql_db_query("portal",$sql3);
	 $zeile3=mysql_fetch_array($result3);
	 
	 
	 
	 
	 echo '<tr><td '.$color.'>'.$zeile3["nick"].'</td><td '.$color.'>';
	 if ($zeile2["itemid"]!="0")
	 {
	 $sql4="SELECT pretext,src,aftertext FROM item WHERE id='".$zeile2["itemid"]."'";
	 $result4=mysql_db_query("portal",$sql4);
	 $zeile4=mysql_fetch_array($result4);
	 echo '<i>' . get_utf($zeile4["pretext"]) . '</i><br /><img src="'.$zeile4["src"].'" /><br /><i>' . get_utf($zeile4["aftertext"]).'</i>';
     }
	 
	 echo ''.nl2br(get_smilies($zeile2["text"])).'&nbsp;&nbsp;('.substr($zeile2["datum"],8,2).'.'.substr($zeile2["datum"],5,2).'.'.substr($zeile2["datum"],0,4).')</td></tr>';
	 
	 
 }

   echo '</table>';

  }
 }


//////////////////////////////////////
//////////////////////////////////////
//////////////////////////////////////
//////////////////////////////////////

function show_nick()
{

$nick=get_nick();


$db=mysql_connect("localhost","portal","psacln");	
$sql="SELECT sex,gb,gb_ort,plz,land,seit,email,discollis,sig,foto1,foto2,foto3,foto4,foto5,foto6,show_nick,show_gb,show_gb_ort,show_ort,show_sex,show_plz,show_seit,show_email,show_foto,show_msn,show_icq,show_aim,show_yahoo,show_skype,homepage_level,msn,icq,yahoo,aim FROM user WHERE nick='".filter($nick)."'";
$result=mysql_db_query("portal",$sql);
if (mysql_num_rows($result)=="0")
{ echo "Fehler"; }
$zeile=mysql_fetch_array($result);

echo '<h3>Profil von '.$nick.', ';
if ($zeile["show_gb"]=="1")
{
echo calculate_age($zeile["gb"]);}

if ($zeile["sex"]=="m") 
{ echo " &#x2642;"; }
else {echo " &#x2640;"; }

echo '</h3>
<table border="0"><tr><td width="200" valign="top"> 
<table>';
if ($zeile["show_gb"]=="1")
{
echo '<tr><td><b>Geburtsdatum:<b></td><td>'.substr($zeile["gb"],8,2).'.'.substr($zeile["gb"],5,2).'.'.substr($zeile["gb"],0,4).'</td></tr>'; }

if ($zeile["show_gb_ort"]=="1")
{ echo '<tr><td><b>Geburtsort:<b></td><td>'.$zeile["gb_ort"].'</td></tr>'; }

if ($zeile["show_ort"]>0)
{
	
$get_bundesland=get_bundesland($zeile["plz"]);
$get_bezirk=get_bezirk($zeile["plz"]);
$get_kreis=get_kreis($zeile["plz"]);
$get_ort=get_ort($zeile["plz"]);

    echo '<tr><td><b>wohnt in...<b></td><td></td></tr>
    <tr><td><b>Land:<b></td><td>';
    
    
 switch ($zeile["land"])
{
case "DE": echo "Deutschland"; break;
case "CH": echo "Schweiz"; break;
case "A": echo "&Ouml;sterreich"; break;
case "EU": echo "Eurpoa"; break;
default: echo "Rest der Welt"; break;
}
    echo '</td></tr>';
    

    if ($zeile["show_ort"]>"1" && $get_bundesland!="-")
    { echo '<tr><td><b>Bundesland:<b></td><td>'.$get_bundesland.'</td></tr>'; }

    if ($zeile["show_ort"]>"2" && $get_bezirk!="-")
    { echo '<tr><td><b>Bezirk:<b></td><td>'.$get_bezirk.'</td></tr>'; }

    if ($zeile["show_ort"]>"3" && $get_kreis!="-")
    { echo '<tr><td><b>Kreis:<b></td><td>'.$get_kreis.'</td></tr>'; }

    if ($zeile["show_ort"]>"4" && $get_ort!="-")
    { echo '<tr><td><b>Ort:<b></td><td>'.$get_ort.'</td></tr>'; } 
}


echo '<tr><td><b>Discollis<b></td><td>'.$zeile["discollis"].'</td></tr>
<tr><td><b>E-Mail:<b></td><td><a href="index.php?x=we&nick='.$nick.'">';
if ($zeile["show_email"]==1)
 { echo $zeile["email"]; }
 else
 { echo 'verfassen'; }
 echo '</a></td></tr>
<tr><td><b>IM:<b></td><td><a href="=mitteilungen.php?nick='.$nick.'">verfassen</a></td></tr>';
if ($zeile["show_msn"]==1)
 { echo '<tr><td><b>MSN:<b></td><td>'.$zeile["msn"].'</td></tr>'; }
if ($zeile["show_icq"]==1)
 { echo '<tr><td><b>ICQ:<b></td><td>'.$zeile["icq"].'</td></tr>'; }
if ($zeile["show_aim"]==1)
 { echo '<tr><td><b>AIM:<b></td><td>'.$zeile["aim"].'</td></tr>'; }
if ($zeile["show_yahoo"]==1)
 { echo '<tr><td><b>YAHOO:<b></td><td>'.$zeile["yahoo"].'</td></tr>'; }
if ($zeile["show_skype"]==1)
 { echo '<tr><td><b>Skype:<b></td><td>'.$zeile["skype"].'</td></tr>'; }
  
if ($zeile["kommunikation"]==0)
{ echo '<tr><td><b>Bevorzugt:<b></td><td>Mitteilungen</td></tr>';}

if ($zeile["kommunikation"]==5)
{ echo '<tr><td><b>Bevorzugt:<b></td><td>E-Mail</td></tr>'; }



#if ($zeile["homepage_level"]>0)
#{echo '<tr><td><b>Homepage:<b></td><td><a href="homepage.php?nick=NICK" target="_blank">betreten</a></td></tr>'; }
echo '
<tr><td><b>&Uuml;ber mich:<b></td><td></td></tr>
<tr><td colspan="2">'.get_utf(nl2br($zeile["sig"])).'</td></tr>
</table>
<br />';

if ($zeile["show_seit"]=="1")
{
echo '<table>

<tr><td colspan="2"><b>Karriere bei DCR:<b></td><td></td></tr>
<tr><td width="80">'.substr($zeile["seit"],8,2).'.'.substr($zeile["seit"],5,2).'.'.substr($zeile["seit"],0,4).'</td><td>registrierung</td></tr>';
show_carrer();
echo '</table>
<br />';
}




echo '

</td><td width="20">&nbsp;</td><td valign="top">
<center>
<br />';

write_slideshow();



echo '<h3>G&auml;stebuch</h3></center>';

show_gbook();


echo '


</td></tr></table>'; }




function do_send_verify ($von,$an) 
{ 
    
	 addstats(40,"send");
	 $sql2="INSERT INTO im (vonid,anid,datum,uhrzeit,betreff,text,status) VALUES (
	 '".$von."',
	 '".$an."',
	 '".date("Y-m-d")."',
	 '".date("H:i")."',
	 'Neuer G&auml;stebuch Eintrag',
	 'In deinem G&auml;stebuch hat sich soeben jemand verewigt','0')";
	 $db=mysql_connect("localhost","portal","psacln");
	 	   $result=mysql_db_query("portal",$sql2);
 
	
}
	
	
 




?>

