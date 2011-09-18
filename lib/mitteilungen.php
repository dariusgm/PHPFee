<?php
// 0 = ungelesen, 5 = Benachrichtigen beim Empfang, 10 = gelesen, 13 = Archiviert vom Versender, 15 = Archiviert vom Empfaenger



function show_re ()
 {
 if ($_GET["y"]=="show")
 {  $db=mysql_connect("localhost","portal","psacln");
	//hole Sender_id und Empfaenger_id und die nachricht
	$sql1="SELECT * FROM im WHERE id='".filter(htmlspecialchars(nl2br($_GET["id"])))."'";
	$result1=mysql_db_query("portal",$sql1);
	$zeile1=mysql_fetch_array($result1);
	

	
	
	
	// Verifiziere das nur IM's angezeigt werden die einem auch gehoeren !	
	if (($_SESSION["id"]==$zeile1["anid"]) || ($_SESSION["id"]==$zeile1["vonid"] && $zeile1["status"]=="13"))
    { 
	    
	    
	// Markiere als gelesen    
	if ($zeile1["status"]=="0")
	{   $sql0="UPDATE im SET status='10' WHERE id='".$zeile1["id"]."'"; 
	$db = mysql_connect("localhost", "portal", "psacln") or die("Verbindungsfehler");
		$result0=mysql_db_query("portal",$sql0); 
	}
	
	
	// Markiere als gelesen und schicke Verify IM   
	if ($zeile1["status"]=="5")
	{   $sql0="UPDATE im SET status='10' WHERE id='".$zeile1["id"]."'"; 
	$db = mysql_connect("localhost", "portal", "psacln") or die("Verbindungsfehler");
		$result0=mysql_db_query("portal",$sql0); 
    
		
	//Hole Nickname
	$sql8="SELECT nick FROM user WHERE id='".$zeile1["anid"]."'";
	$db = mysql_connect("localhost", "portal", "psacln") or die("Verbindungsfehler");
	$result8=mysql_db_query("portal",$sql8);
	$zeile8=mysql_fetch_array($result8);
				
		
	 $sql9="INSERT INTO im (vonid,anid,datum,uhrzeit,betreff,text,status) VALUES (
	 '".$_SESSION["id"]."',
	 '".$zeile1["vonid"]."',
	 '".date("Y-m-d")."',
	 '".date("H:i")."',
	 'Nachricht wurde gelesen.',
	 '".$zeile8["nick"]. " hat deine Nachricht gelesen.',
	 '0')";
	 $result9=mysql_db_query("portal",$sql9);		
		

	}	
	
		

	
    //hole Sende_nick
	$sql2="SELECT nick FROM user WHERE id='".$zeile1["vonid"]."'";
	$db = mysql_connect("localhost", "portal", "psacln") or die("Verbindungsfehler");
	$result2=mysql_db_query("portal",$sql2);
	$zeile2=mysql_fetch_array($result2);

	
	
 
 

echo '<b>Antworten:</b><br />
<form method="post" action="index.php?x=mitteilungen&id='.$zeile1["id"].' accept-charset="utf-8">
<table border="1">
<tr><td>An:</td><td><input type="text" name="username" value="'.$zeile2["nick"].'" /></td><td><a href="index.php?x=search">User Suchen</a></td></tr>
<tr><td>Betreff:</td><td colspan="2"><input type="text" name="betreff" value="RE: '.get_utf($zeile1["betreff"]).'" /></td></tr>
<tr><td colspan="3"><textarea name="text" cols="30" rows="10">


------------
-'.substr($zeile1["datum"],8,2).'.'.substr($zeile1["datum"],5,2).'.'.substr($zeile1["datum"],0,4).' - '.$zeile1["uhrzeit"].'
'.str_replace("&lt;br /&gt;","",$zeile1["text"]).'</textarea></td></tr>
</table>

<button type="submit" />Ausf&uuml;hren</button><select name="do">
 <option value="send">Antworten</option>
 <option value="archiv">Speichern</option>
 <option value="del">L&ouml;schen</option> 
</select>
</form>'; 

}	
	
}
	
}



function show_get () { 


$db = mysql_connect("localhost", "portal", "psacln") or die("Verbindungsfehler");		
$sql1="SELECT id,vonid,datum,uhrzeit,betreff FROM im WHERE anid='".filter($_SESSION["id"])."' AND status<'15' ORDER BY 'datum' DESC";
$result1=mysql_db_query("portal",$sql1);


   if (mysql_num_rows($result1)>0)
   {
   echo '<table border="1"><tr><td>Von</td><td>Betreff</td><td>Vom</td><td></td></tr>';
   
      while($zeile1=mysql_fetch_array($result1))
      {

      $sql2="SELECT nick FROM user WHERE id='".$zeile1["vonid"]."'";
      $db = mysql_connect("localhost", "portal", "psacln") or die("Verbindungsfehler");
      $result2=mysql_db_query("portal",$sql2);
      $zeile2=mysql_fetch_array($result2);
	      
     echo '<tr><td><a href="index.php?x=show&nick='.$zeile2["nick"].'"><u>'.$zeile2["nick"].'</u></a></td>
     <td>'.get_utf($zeile1["betreff"]).'</td>
     <td>'.substr($zeile1["datum"],8,2).'.'.substr($zeile1["datum"],5,2).'.'.substr($zeile1["datum"],0,4).' '.$zeile1["uhrzeit"].'</td>
     <td><a href="index.php?x=mitteilungen&id='.$zeile1["id"].'&y=show"><u>Anzeigen</u></a> | <a href="index.php?x=mitteilungen&id='.$zeile1["id"].'&y=del"><u>L&ouml;schen</u></a></td></tr>'; 
     }
   
  echo '</table>';
  }
  else
  { echo "Sie haben keine neuen Nachrichten."; }

}

function show_archiv () { 
$db=mysql_connect("localhost","portal","psacln");	
$sql1="SELECT id,vonid,anid,betreff FROM im WHERE (anid='".filter($_SESSION["id"])."' AND status='15' ) OR (vonid='".filter($_SESSION["id"])."' AND status='13') ORDER BY 'datum' DESC";
$result1=mysql_db_query("portal",$sql1);


   if (mysql_num_rows($result1)>0)
   {
   echo '<table border="1"><tr><td>Von</td><td>An</td><td>Betreff</td><td></td></tr>';
   
      while($zeile1=mysql_fetch_array($result1))
      {

      $sql2="SELECT nick FROM user WHERE id='".$zeile1["vonid"]."'";
      $db = mysql_connect("localhost", "portal", "psacln") or die("Verbindungsfehler");
      $result2=mysql_db_query("portal",$sql2);
      $zeile2=mysql_fetch_array($result2);
      
      $sql3="SELECT nick FROM user WHERE id='".$zeile1["anid"]."'";
      $db = mysql_connect("localhost", "portal", "psacln") or die("Verbindungsfehler");
      $result3=mysql_db_query("portal",$sql3);
      $zeile3=mysql_fetch_array($result3);      
      
	      
     echo '<tr><td><a href="index.php?x=show&nick='.$zeile2["nick"].'"><u>'.$zeile2["nick"].'</u></a></td>
     <td><a href="index.php?x=show&nick='.$zeile3["nick"].'"><u>'.$zeile3["nick"].'</u></a></td>
     <td>'.get_utf($zeile1["betreff"]).'</td>
     <td><a href="index.php?x=mitteilungen&id='.$zeile1["id"].'&y=show"><u>Anzeigen</u></a> | <a href="index.php?x=mitteilungen&id='.$zeile1["id"].'&y=del"><u>L&ouml;schen</u></a></td></tr>'; 
     }
   
  echo '</table>';
  }
  else
  { echo "Sie haben keine Nachrichten im Archiv."; }

}


function do_send () 
{ 

 if ($_POST["do"]=="send" || $_POST["do"]=="archiv" || $_POST["do"]=="verify")
 
 {   $db=mysql_connect("localhost","portal","psacln");
	 // Hole User ID
	 $sql1="SELECT id FROM user WHERE nick='".filter($_POST["username"])."' ; ";
	 $result=mysql_db_query("portal",$sql1);
     $zeile=mysql_fetch_array($result);
     
     //Pruefe ob geblockt
	 $sql0="SELECT grund FROM blocklist WHERE userid='".$zeile["id"]."' AND geblockt='".filter($_SESSION["id"])."'";
	 $db = mysql_connect("localhost", "portal", "psacln") or die("Verbindungsfehler");
	 $result0=mysql_db_query("portal",$sql0);
	 $zeile0=mysql_fetch_array($result0);
	 if (mysql_num_rows($result0)==1)
	 { echo 'Du wurdest von diesem User blockiert.<br />';
	     if (empty($zeile0["grund"]))
	     { echo 'Der User hat allerdings keine Begr&uuml;ndung angegeben<br />';}
	     else
	     { echo 'Dir wurde folgende Begr&uuml;ndung hinterlassen: '.htmlspecialchars($zeile0["grund"]).'<br />'; }
     
     }
     else
     {
	     $db=mysql_connect("localhost","portal","psacln");
	     // Pruefe ob eine IM in der letzten Zeit versendet wurde
	     $sql3="SELECT uhrzeit FROM im WHERE vonid='".filter($_SESSION["id"])."' AND anid='".$zeile["id"]."' AND datum='".date("Y-m-d")."' ORDER BY 'id' DESC LIMIT 1";
	     $result3=mysql_db_query("portal",$sql3);
	         $zeile3=@mysql_fetch_array($result3);
	         // Aktuelle Uhrzeit - 5 > Sendezeit ODER noch keine IM versendet -> Dann senden
	         
	         if (((date("H:i",mktime(date("H"),(date("i")-5))))>($zeile3["uhrzeit"])) || (mysql_num_rows($result3)==0)  )
	         {
	 	     addstats(40,"send");
		      $sql2="INSERT INTO im (vonid,anid,datum,uhrzeit,betreff,text,status) VALUES (
	 	     '".filter($_SESSION["id"])."',
		      '".$zeile["id"]."',
		      '".date("Y-m-d")."',
		      '".date("H:i:s")."',
		      '".htmlspecialchars(nl2br(filter($_POST["betreff"])))."',
		      '".htmlspecialchars(nl2br(filter($_POST["text"])))."',";
   	                 if ($_POST["do"]=="verity")	 
	 	     	       {
		     	      $sql2.="'5')"; }
	  	     	      else
	  	     	      {	 $sql2.="'0')"; }
	           $db = mysql_connect("localhost", "portal", "psacln") or die("Verbindungsfehler");
	 	       $result=mysql_db_query("portal",$sql2);
		                if ($result==true)
		     	        { echo "Die Nachricht wurde verschickt.<br />"; }
		     	 
               }
        
      	 else
       { echo 'Bitte beachten Sie, dass zwischen zwei Sendevorg&auml;ngen an den gleichen User 5 Minuten vergehen m&uuml;ssen. Ihre Nachricht wurde <b><u>nicht</u></b> versendet.<br /><br />'; }
       
     }
	
	
 }
}


function do_del()
{

	if ($_GET["y"]=="del" || $_POST["do"]=="del")
	{
	$db=mysql_connect("localhost","portal","psacln");
	//Pruefe ob die IM auch an den user ueberhaupt ging
	$sql1="SELECT vonid,anid,status FROM im WHERE id='".filter(htmlspecialchars(nl2br($_GET["id"])))."'";
	$result1=mysql_db_query("portal",$sql1);
	$zeile1=mysql_fetch_array($result1);
	if ($_SESSION["id"]==$zeile1["anid"] || ($_SESSION["id"]==$zeile1["vonid"] && $zeile1["status"]=="13"))
	{
	$sql2="DELETE FROM im WHERE id='".filter(htmlspecialchars(nl2br($_GET["id"])))."'";
		write_user_log($sql2,"mitteilungen","del");
	$result2=mysql_db_query("portal",$sql2);	
       if ($result2==true)
       { echo "Die Nachricht wurde gel&ouml;scht.<br />"; 
       addstats(40,"del");}
    }
    else
    {
	   echo "Sie sind nicht berechtigt diese IM zu l&ouml;schen.<br />"; 
    }

}
}

function do_archiv()


{

	if ($_POST["do"]=="archiv" && isset($_GET["id"]))
	{
	// Wenn ID nicht gesetzt, wird die nachricht grade geschrieben und nicht verschoben

        $db=mysql_connect("localhost","portal","psacln");
		$sql1="SELECT id,anid,status FROM im WHERE id='".filter(htmlspecialchars(nl2br($_GET["id"])))."'";
		$result1=mysql_db_query("portal",$sql1);
		$zeile1=mysql_fetch_array($result1);
	
	
		if ($zeile1["status"]=="15")
		{ echo "Die Nachricht wurde bereits gespeichert.<br />"; }
		  else
		  {
	
	 	    //Pruefe ob die IM auch an den user ueberhaupt ging	
	 	   if ($_SESSION["id"]==$zeile1["anid"])
	 	   {   //Setzte Archivierungstag
      	  $sql2="UPDATE im SET status='15' WHERE id='".$zeile1["id"]."'";

		
			$result2=mysql_db_query("portal",$sql2);
			if ($result2==true)
			  { echo "Die Nachricht wurde gespeichert."; }
		
		
	
	      }
	
	
     }
		
   } 
   elseif ($_POST["do"]=="archiv" && empty($_GET["id"]))
   {
	do_send();
	    $db=mysql_connect("localhost","portal","psacln");
		$sql1="SELECT id FROM user WHERE nick='".filter(htmlspecialchars(nl2br($_POST["username"])))."'";
		$result1=mysql_db_query("portal",$sql1);
		$zeile1=mysql_fetch_array($result1);
	
	$sql2="INSERT INTO im (vonid,anid,datum,uhrzeit,betreff,text,status) VALUES (
	 '".$_SESSION["id"]."',
	 '".$zeile1["id"]."',
	 '".date("Y-m-d")."',
	 '".date("H:i")."',
	 '".htmlspecialchars(nl2br(filter($_POST["betreff"])))."',
	 '".htmlspecialchars(nl2br(filter($_POST["text"])))."',
	 '13')";
	 $result=mysql_db_query("portal",$sql2);
	 if ($result2==true)
	 { echo "Die Nachricht wurde gespeichert."; }   
   
   
   
   } 
 }



?>