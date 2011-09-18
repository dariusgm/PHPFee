<?php

function show_gbook () 
{
	$color1=' style="background-color:#FF8040;"';
	$color2=' style="background-color:#FEEDAB;"';
	
$sql1="SELECT userid,datum,uhrzeit,itemid,text,visible FROM gb WHERE anid='0' AND visible='1' ORDER BY 'datum' DESC LIMIT 10";
$db = mysql_connect("localhost", "portal", "psacln") or die("Verbindungsfehler");
$result1=mysql_db_query("portal",$sql1);
echo '<table border="0" cellpadding="5" cellspacing="0">';
$i=0;
while($zeile1=mysql_fetch_array($result1))
{
        if ($zeile1["userid"]==0)
        { $von="Anonym"; }
        else
        {
		$sql2="SELECT nick FROM user WHERE id='".$zeile1["userid"]."'";
		$db = mysql_connect("localhost", "portal", "psacln") or die("Verbindungsfehler");
		$result2=mysql_db_query("portal",$sql2);
		$zeile2=mysql_fetch_array($result2);
        $von=$zeile2["nick"];
        }
        
       		if ($zeile1["itemid"]=="0")
		{ $item="-"; }
		else
		{ 
		$sql3="SELECT beschreibung FROM item WHERE id='".$zeile1["itemid"]."'";
		$db = mysql_connect("localhost", "portal", "psacln") or die("Verbindungsfehler");
		$result3=mysql_db_query("portal",$sql3);
		$zeile3=mysql_fetch_array($result3);
		$item=get_utf($zeile3["beschreibung"]); 
		}
		
		
		
		echo '<tr><td width="320" valign="top" ';
		if ($i%2==0)	{$color=$color1;}
		else { $color=$color2;}
		
		echo $color;
		echo '>'.get_smilies($zeile1["text"]).'</td>
		<td '.$color.'>Von: '.$von.'<br />Geschenk: '.$item.'<br />Versendet: '.substr($zeile1["datum"],8,2).'.'.substr($zeile1["datum"],5,2).'.'.substr($zeile1["datum"],0,4).' '.$zeile1["uhrzeit"].'
		</td></tr><tr><td colspan="2"><hr /></td></tr>';
		
        
       $i++; 
        

} 
echo '</table>';

}






function show_added_gbook()
{
	$sql1="SELECT discollis FROM user WHERE id='".$_SESSION["id"]."'";
	$db = mysql_connect("localhost", "portal", "psacln") or die("Verbindungsfehler");
    $result1=mysql_db_query("portal",$sql1);
    $zeile1=mysql_fetch_array($result1);

    $sql2="SELECT id,beschreibung,discollis FROM item WHERE discollis<'".$zeile1["discollis"]."'";
    $db = mysql_connect("localhost", "portal", "psacln") or die("Verbindungsfehler");
    $result2=mysql_db_query("portal",$sql2);
    echo '<form method="post" action="index.php?x=gbook"><table><tr><textarea name="gb_text" rows="5" cols="20">Deine Nachricht</textarea></td></tr><tr><td>Geschenk hinzuf&uuml;gen:<br /></td></tr><tr><td><select name="item"><option value="0">Nichts</option>';
      
    
     if (mysql_num_rows($result2)!=0)
    {
	
 while($zeile2=mysql_fetch_array($result2))
        {
	     echo '<option value="'.$zeile2["id"].'">'.get_utf($zeile2["beschreibung"]).' ('.$zeile2["discollis"].' Discollis)</option>';
	
        }
    }
   echo '</select></td></tr><tr><td><button type="submit">Eintragen</button></td></tr></table></form>';	

	
	
		
}














function do_added_gbook()
{ 
	
if (isset($_POST["gb_text"]))
{	
$itemid=filter($_POST["item"]);   
	   
$sql0="SELECT uhrzeit FROM gb WHERE datum='".date("Y-m-d")."' AND ip='".$_SERVER["REMOTE_ADDR"]."' ORDER BY 'id' DESC LIMIT 1";
$db=mysql_connect("localhost","portal","psacln");
$result0=mysql_db_query("portal",$sql0);	
$zeile0=mysql_fetch_array($result0);
	   if (((date("H:i",mktime((date("H")-1),(date("i")))))>($zeile0["uhrzeit"])) || mysql_num_rows($result0)==0  || isset($_SESSION["id"]) )
	   {	        

  	   	    // Hole Discolls vom Versender
  	   	    $sql2="SELECT discollis FROM user WHERE id='".$_SESSION["id"]."'";
  	   	    $result2=mysql_db_query("portal",$sql2);
   	   	    $zeile2=mysql_fetch_array($result2);
   	   	    $discollis=$zeile2["discollis"];

 
   
  	   	     if ($itemid==0)
  	   	     { $kosten=0;}
  	   	     else 
  	   	     {
  	   	     //Hole Kosten fuer Item
  	   	     $sql3="SELECT discollis FROM item WHERE id='".$itemid."'";
  	   	     $db=mysql_connect("localhost","portal","psacln");
  	   	     $result3=mysql_db_query("portal",$sql3);
  	   	     $zeile3=mysql_fetch_array($result3);
  	   	     $kosten=$zeile3["discollis"];
  	   	     }
   
 	   	      if ($discollis>=$kosten)
  	   	        {
      
		   	      if (isset($_SESSION["id"]))
	 	   	     {    
		   	      //Bezahle fuer Item (Bei Kosten=0 Recht unnoetig, aber naja ...)
    	   	      $sql4="UPDATE user SET discollis=discollis-".$kosten." WHERE id='".$_SESSION["id"]."'";
    	   	      $db=mysql_connect("localhost","portal","psacln");
    	   	      $result4=mysql_db_query("portal",$sql4);
    	   	      $nickid=$_SESSION["id"];
   	   	       $visible=1;
   	   	       }
   	   	       else
    	   	      { $nickid=0; $visible=3;}
      
      
     	   	     $sql5="INSERT INTO gb (userid, anid, datum, uhrzeit, itemid, text, ip, host, proxy, visible) VALUES(
      	   	    '".$nickid."',
     	   	     '0',
    	   	      '".date("Y-m-d")."',     
    	   	       '".date("H:i:s")."',
    	   	      '".$itemid."',
    	   	      '".htmlspecialchars(filter($_POST["gb_text"]))."',
    	   	      '".$_SERVER["REMOTE_ADDR"]."',
    	   	      '".$_SERVER["REMOTE_HOST"]."',
    	   	      '".$_SERVER["HTTP_X_FORWARDED_FOR"]."','".$visible."')";
    	   	     $db=mysql_connect("localhost","portal","psacln");
     	   	     $result5=mysql_db_query("portal",$sql5);
     	   	     if ($result5)
    	   	      { echo '<br /><br /><b><u><span style="color:red;">Dein Eintrag wurde aufgenommen.</span></u></b><br /><br />';}
      
      
         
      
   	   	       }
   	   	    else
	   	          { echo 'Du hast nicht gen&uuml;gent Discollis um diese Geschenk zu w&auml;hlen. Dein Eintrag wurde <b><u>nicht</u></b> aufgenommen.'; }
       
	   	 }
	   	 else
	   	 { echo 'Um uns vor Spam zu sch&uuml;tzen, ist nur ein Eintrag innerhalb von einer Stunde pro IP erlaubt. Ihr Eintrag wurde <u><b>nicht</b></u> aufgenommen.<br />'; }

}
}
	
	

?>