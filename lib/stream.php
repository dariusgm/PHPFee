<?php
function get_clock($time)
{
	/////VON////
  if(strlen($time)==3)
  { // Wenn Stunden Weniger 10, dann f&uuml;hrende 0 Anzeigen
	 echo '0'.(substr($time,0,1)); 
  }
   elseif(strlen($time)=="4")
  {
	 echo (substr($time,0,2)); 
	}
   // 0:00 Uhr = 0 In der Datenbank
   else 
  { 
	 echo "00"; 
	}

  //Ausgabe Minuten
  echo ':';
  
  if ((substr($time,-2,2))=="0")
  {echo "00";}
  else
  { echo (substr($time,-2,2)); }
  /////VON ENDE//////



}


function get_nick_by_id($id)
{
	$db=mysql_connect("localhost","portal","psacln");
    $sql1="SELECT nick FROM user WHERE id='".$id."'";
    $result1=mysql_db_query("portal",$sql1);
    $zeile1=mysql_fetch_array($result1);
    return $zeile1["nick"];	
}

function send_im ($von,$an,$betreff,$text)
{
	
	 
	 $sql2="INSERT INTO im (vonid,anid,datum,uhrzeit,betreff,text) VALUES (
	 '".$von."',
	 '".$an."',
	 '".date("Y-m-d")."',
	 '".date("H:i:s")."',
	 '".$betreff."',
	 '".$text."')";
  	 
	 $result=mysql_db_query("portal",$sql2);

}



function put_gb($stream)
{
	
 $art = filter($_POST["art".$stream]);
 $text = strip_tags(filter($_POST["input".$stream]));
 if ($text!="")
 {
	
	$num_art=0;
	switch ($art) {        
    case "wunsch": $num_art=5; break;
    case "grus": $num_art=10; break;
    case "meinung": $num_art=15; break;
    case "quiz": $num_art=20; break;
    case "feedback": $num_art=25; break;
    }
    
    
   
    // Pr&uuml;fe ob gespammt wird
    $intervall=60; // Sekunden
    $db=mysql_connect("localhost","portal","psacln"); 
    $sql_pre="SELECT in_time FROM grusbox_live WHERE stream=".$stream." AND ip='".$_SERVER["REMOTE_ADDR"]."' ORDER BY 'in_time' DESC LIMIT 1";
    $result_sql_pre=mysql_db_query("portal",$sql_pre);
    $zeile_pre=mysql_fetch_array($result_sql_pre);
   
    if (($zeile_pre["in_time"]>(time()-$intervall)))
    {   include_text("/o/stream/1.htm");
	    echo $intervall; 
	    include_text("/o/stream/2.htm");}
    else
    {
    
     //Pr&uuml;fe ob gebannt wurde
    $sql_ban="SELECT userid FROM grusbox_ban WHERE geblockt_userid='".$_SERVER["REMOTE_ADDR"]."'";
    $result_ban=mysql_db_query("portal",$sql_ban);
    if (mysql_num_rows($result_ban)==1)
    { include_text("/o/stream/3.htm"); }
    else
    {
          
       if (isset($_SESSION["id"])) { $nick=$_SESSION["id"]; } else { $nick=0; }
	    
       //$_SERVER["REMOTE_ADDR"]
        $sql1="SELECT userid,status FROM grusbox_config WHERE stream='".$stream."'";
	    $result1=mysql_db_query("portal",$sql1);
	    $zeile1=mysql_fetch_array($result1);
    
        if ($zeile1["status"]==0 || $num_art==0)
        { include_text("/o/stream/4.htm"); }
    
        if ($zeile1["status"]==5 && $num_art==5)
        { $sql2="INSERT INTO grusbox_live (stream,userid,art,in_time,out_time,in_text,ip)
        VALUES ('".$stream."','".$nick."',5,".time().",NULL,'".$text."','".$_SERVER["REMOTE_ADDR"]."')";
          $result2=mysql_db_query("portal",$sql2);
          include_text("/o/stream/5.htm");
        } 
    
        if ($zeile1["status"]==10 && ($num_art==5 || $num_art==10))
        { $sql2="INSERT INTO grusbox_live (stream,userid,art,in_time,out_time,in_text,ip)
        VALUES ('".$stream."','".$nick."','".$num_art."',".time().",NULL,'".$text."','".$_SERVER["REMOTE_ADDR"]."')";
          $result2=mysql_db_query("portal",$sql2);
          include_text("/o/stream/5.htm");
        }     
    
        if ($zeile1["status"]==15 && ($num_art==5 || $num_art==10 || $num_art==15) )
        { $sql2="INSERT INTO grusbox_live (stream,userid,art,in_time,out_time,in_text,ip)
        VALUES ('".$stream."','".$nick."','".$num_art."',".time().",NULL,'".$text."','".$_SERVER["REMOTE_ADDR"]."')";
          $result2=mysql_db_query("portal",$sql2);
         include_text("/o/stream/5.htm");
        }     

        if ($zeile1["status"]==20 && ($num_art==5 || $num_art==10 || $num_art==15 || $num_art==20) && isset($_SESSION["id"]))
        { $sql2="INSERT INTO grusbox_live (stream,userid,art,in_time,out_time,in_text,ip)
        VALUES ('".$stream."','".$nick."','".$num_art."',".time().",NULL,'".$text."','".$_SERVER["REMOTE_ADDR"]."')";
          $result2=mysql_db_query("portal",$sql2);
         include_text("/o/stream/5.htm");
        }    
    
        if ($zeile1["status"]>=0 && $num_art==25 && isset($_SESSION["id"]))
        { 
           	$sql3="SELECT portal_level FROM user WHERE id='".$_SESSION["id"]."'";
         	$result3=mysql_db_query("portal",$sql3);
	        $zeile3=mysql_fetch_array($result3);
	    
	        if ($zeile1["portal_level"]>10 || ($zeile1["portal_level"]>4 && $zeile1["portal_level"]<10) && isset($_SESSION["id"]))
	        {
		        $im_text=" Ich habe mir deine Sendung am ".date("Y-m-d")." angeh&ouml;rt, und m&ouml;chte dir folgendes Mitteilen: ". $text;
		        send_im($_SESSION["id"],$zeile1["userid"],"Feedback zu deiner Sendung",$im_text);
		        include_text("/o/stream/6.htm");
		    
		    }
	     
	    
	    
	    }          
    
       }
    }
  }
  else
  { include_text("/o/stream/7.htm");  }
  	           
}                   
     
	
	
	
	

function write_gb($stream,$mod)
{
	if (isset($_POST["art".$stream]) && isset($_POST["input".$stream]))
	{
		put_gb($stream);
    }
	else
	{
	echo '<form method="post" action="index.php?x=stream'.$stream.'"><table border="1"><tr><td>Username:</td><td>';
	if (isset($_SESSION["nick"]))
	{ echo $_SESSION["nick"]; }
	else
	{ include_text("/o/stream/8.htm"); }
	
	
	
	echo '</td></tr>
	<tr><td>Wunschart:</td><td><select name="art'.$stream.'">';
	if ($mod==20)
	{ echo '<option value="quiz">Quiz antwort</option>
	<option value="wunsch">Musik-Wunsch</option>
	<option value="grus">Gru&szlig; an jemanden</option>
	<option value="meinung">Meinung dem Moderator sagen.</option>'; }
	if ($mod==15)
	{ echo '<option value="wunsch">Musik-Wunsch</option>
	<option value="grus">Gru&szlig; an jemanden</option>
	<option value="meinung">Meinung dem Moderator sagen.</option>'; }
	if ($mod==10)	
	{ echo '<option value="grus">Gru&szlig; an jemanden</option>'; }	
	
	$db=mysql_connect("localhost","portal","psacln");
	$sql1="SELECT portal_level FROM user WHERE id='".$_SESSION["id"]."'";
	$result1=mysql_db_query("portal",$sql1);
	$zeile1=mysql_fetch_array($result1);
	
	// Feedback einblenden
	if (($zeile1["portal_level"]>10 || ($zeile1["portal_level"]>4 && $zeile1["portal_level"]<10)) && $mod>=14)
	{echo '<option value="feedback">Feedback</option>'; }
	
	echo '</select></td></tr>';
	echo '<tr><td colspan="2">Text:<br /><textarea name="input'.$stream.'" cols="35" rows="5" wrap="physical"></textarea></td></tr>';
	echo '<tr><td><button type="submit">Absenden</button></td><td>www.discollection-radio.de</td></tr></table>';
	
    }
	
	
	
	
}





function get_mod_stats($stream)
{
	$db=mysql_connect("localhost","portal","psacln");
	$sql1="SELECT userid,status FROM grusbox_config WHERE stream='".$stream."'";
	$result1=mysql_db_query("portal",$sql1);
	$zeile1=mysql_fetch_array($result1);
	if ($zeile1["userid"]==0)
	{ include_text("/o/stream/9.htm");
		// L&auml;uft heute noch was ?
		$sql2="SELECT userid,von,bis,titel FROM sendeplan WHERE datum='".date("Y-m-d")."' AND von>='".date("Hi")."' AND stream='".$stream."'";
		$result2=mysql_db_query("portal",$sql2);
   if (mysql_num_rows($result2)>0)
	    {
		    $zeile2=mysql_fetch_array($result2);
		   include_text("/o/stream/10.htm");
		   echo get_clock($zeile2["von"]).' bis '.get_clock($zeile2["bis"]).' Uhr statt.';
		   include_text("/o/stream/11.htm");		    
		   echo get_nick_by_id($zeile2["userid"]);
		    		    
	    }
	    else
	    {
		    // Aber morgen sicherlich ! (86400 sekunden = 1 Tag)
		     $sql3="SELECT userid,von,bis,titel FROM sendeplan WHERE datum='";
			 $sql3.=date(Y-m-d,time()+86400);
			 $sql3.="AND bis>='".date("Hi")."' AND stream='".$stream."' ORDER by von LIMIT 1";
		     echo $sql3;
		     $result3=mysql_db_query("portal",$sql3);
		 		     
		     if (mysql_num_rows($result3)==1)
		     {   $zeile3=mysql_fetch_array($result3);
		         include_text("/o/stream/12.htm");
			     get_clock($zeile2["von"]);
			     echo ' bis ';
			     get_clock($zeile2["bis"]);
			     include_text("/o/stream/13.htm"); 
			     
			     echo get_nick_by_id($zeile2["userid"]).'<br />';
		    
			     }
	         else
	         {
		     include_text("/o/stream/14.htm"); 
            }
		         
		      
		     
		     
		}
	
	 }
	else
	{        // Hole aktuelle Sendung's Infos
	         $sql3="SELECT von,bis,titel FROM sendeplan WHERE datum='".date("Y-m-d")."' AND userid='".$zeile1["userid"]."' ORDER by 'von' LIMIT 1";
		     $result3=mysql_db_query("portal",$sql3);
		     $zeile3=mysql_fetch_array($result3);
		     echo ' Sendung heute: ';
		     get_clock($zeile3["von"]);
		     echo ' bis ';
		     get_clock($zeile3["bis"]);
		     echo ' Uhr. ';

		
		
		
           // Hole die n&auml;chste Sendung ! (86400 sekunden = 1 Tag)
		     $sql4="SELECT datum,von,bis,titel,stream FROM sendeplan WHERE datum>='".date("Y-m-d",(time()+86400))."'  ORDER by 'von' LIMIT 1";
		     $result4=mysql_db_query("portal",$sql4);
		     $zeile4=mysql_fetch_array($result4);
		     if (mysql_num_rows($result4)==1)
		     {
			    echo 'N&auml;chste Sendung von '.get_nick_by_id($zeile1["userid"]).': '.substr($zeile4["datum"],8,2).'.'.substr($zeile4["datum"],5,2).'.'.substr($zeile4["datum"],0,4).', ';
			    get_clock($zeile4["von"]);
			    echo ' bis ';
			    get_clock($zeile4["bis"]);
			    echo  'Uhr <br />Thema dann: '.$zeile4["titel"].'<br />';
			    }
	         else
	         {
		         include_text("/o/stream/15.htm");
            }



                
                if ($zeile1["status"]==20)
               {
	                 if (isset($_SESSION["id"])) {include_text("/o/stream/16.htm"); write_gb($stream,20); }
	                 else {include_text("/o/stream/17.htm");
	                 }
		
                 }
                 if ($zeile1["status"]==15)
                 {
                 	include_text("/o/stream/18.htm"); write_gb($stream,15);
	                 
	
	
                 }
                 if ($zeile1["status"]==10)
                 {
                 	include_text("/o/stream/19.htm");  write_gb($stream,10);
	                
	
                 }

                 if ($zeile1["status"]==5)
                 {
                 	include_text("/o/stream/20.htm");
                 	
	
                 }

     }

}
?>
