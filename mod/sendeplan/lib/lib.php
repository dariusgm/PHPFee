<?php



function send_sendeplan()
{
	if (isset($_POST["datum1"]) && isset($_POST["von1"]) && isset($_POST["bis1"]))
	{
	
		   if (isset($_SESSION["nick"]))
       { $nickname = $_SESSION["nick"]; }
  
     elseif (isset($_POST["userinput"]))
    { $nickname = $_POST["userinput"]; }
  
    //Setzte Text zusammen
    if (isset($_SESSION["nick"]))
    { $nickname = $_SESSION["nick"]; }
  
    elseif (isset($_POST["userinput"]))
    { $nickname = $_POST["userinput"]; }
	
	
	 $text="Du hast soeben Sendezeiten von ".$nickname." erhalten.
	 Sendezeit1: Stream: ".filter($_POST["datum1"])." von ".filter($_POST["von1"])." bis ".filter($_POST["bis1"]).",
	 Sendezeit2: ".filter($_POST["datum2"])." von ".filter($_POST["von2"])." bis ".filter($_POST["bis2"])." ,
	 Sendezeit3: ".filter($_POST["datum3"])." von ".filter($_POST["von3"])." bis ".filter($_POST["bis3"])." ,	 
	 Sendezeit4: ".filter($_POST["datum4"])." von ".filter($_POST["von4"])." bis ".filter($_POST["bis4"]).",
	 Sendezeit5: ".filter($_POST["datum4"])." von ".filter($_POST["von5"])." bis ".filter($_POST["bis5"]).",
	 Dies ist eine Automatisch generierte E-Mail.";	    
  
  
    // Sende IM an alle Sendeplan Leute die IM's erhalten sollen
	$sql1="SELECT email FROM user WHERE sendeplan_level=10";
	$db=mysql_connect("localhost","portal","psacln");
	$result1=mysql_db_query("portal",$sql1);
	while($zeile1=mysql_fetch_array($result1))
	{
		send_email($zeile1["email"],"Sendezeiten",$text);
		
    }
  }     
}



function send_email($an,$betreff,$text)
{
              
        
  @mail($an, $betreff, $text,"From: SYSTEM <system@discollection-radio.eu>");

}


function datumsql($datum)
{
return date("Y-m-d",mktime(1,1,1,date(m),(date(d)+$datum),date(Y)));	
}



function wochentag($datum)
{
$tag = date("w",mktime(1,1,1,date(m),(date(d)+$datum),date(Y)));
switch($tag)
 {
	 case 0:
	 echo "Sonntag";
	 break;
	 case 1:
	 echo "Montag";
	 break;	 
	 case 2:
	 echo "Dienstag";
	 break;
	 case 3:
	 echo "Mittwoch";
	 break;	 
	 case 4:
	 echo "Donnerstag";
	 break;
	 case 5:
	 echo "Freitag";
	 break;	 
	 case 6:
	 echo "Samstag";
	 break;
}
}



function show_mod($datum,$von,$bis,$stream)

{
	
$db=mysql_connect("localhost","portal","psacln");
$sql1="SELECT userid FROM sendeplan WHERE datum='".$datum."' AND von<='".$von."' AND bis>='".$bis."' AND stream='".$stream."' ORDER BY 'von'";
$result1=mysql_db_query("portal",$sql1);
if (mysql_num_rows($result1))
{   $zeile1=mysql_fetch_array($result1);
	$sql2="SELECT nick FROM user WHERE id='".$zeile1["userid"]."'";
	$result2=mysql_db_query("portal",$sql2);
	$zeile2=mysql_fetch_array($result2);
	return "<font color=\"green\">".$zeile2["nick"]."</font>";
}
else
{ return "<font color=\"red\">FREI</font>"; }

	
}
	   
?>
	
	

