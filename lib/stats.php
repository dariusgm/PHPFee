<?php
function addstats($page,$modus)
{  
	
	$db=mysql_connect("localhost","portal","psacln");
	$mydb=mysql_select_db("portal");
	#Seitenglobale Stats
	$heute=date("Y-m-d");
	$sql1="SELECT views FROM stats_site WHERE datum='".$heute."' AND pageid=".$page." AND modus='".$modus."'";
	$result1 = mysql_query($sql1);
	if (mysql_num_rows($result1)==0)
    {$sql2="INSERT INTO stats_site (datum,pageid,modus) VALUES ('".$heute."',".$page.",'".$modus."')";}
    else
    {$sql2="UPDATE stats_site SET views=views+1 WHERE datum='".$heute."' AND pageid=".$page." AND modus='".$modus."'";} 
    $result2 = mysql_query($sql2);
    
    
    #Userstats / Robots
    if (strpos($_SERVER["HTTP_USER_AGENT"],"bot")==0 || strpos($_SERVER["HTTP_USER_AGENT"],"yacy")==0)
    { 
	  $sql3="SELECT id FROM stats_user WHERE datum='".$heute."' AND ip='".$_SERVER["REMOTE_ADDR"]."'";
      $result3 = mysql_query($sql3);
        if (mysql_num_rows($result3)==0)
          {
	          $sql4="INSERT INTO stats_user (ip,datum,anfang,ende,browser,referer) 
          VALUES ('".$_SERVER["REMOTE_ADDR"]."',
          '".$heute."',
          ".time().",
          ".time().",
          '".$_SERVER["HTTP_USER_AGENT"]."',";
          
          
          # REFERER PRUEFEN ( Ob Partnerlink oder Andere Quelle
             if (!empty($_SERVER["HTTP_REFERER"]))
             {
	             $sql4.="'".$_SERVER["HTTP_REFERER"]."'";
             }
             else
             {
	             if (isset($_GET["partner"]))
                 {
	                 $sql4.="'".filter($_GET["partner"])."'";
                 } 
                 else
                 { $sql4.="'unknow'"; }            
             }
            
             $sql4.=")";
        } 
        else
        {
	        $zeile3=mysql_fetch_array($result3);
	        $sql4="UPDATE stats_user SET ende=".time().",views=views+1 WHERE id='".$zeile3["id"]."'";}
         mysql_query($sql4);
    }
    else
    {
	  $sql3="SELECT id FROM stats_bot WHERE datum='".$heute."' AND ip='".$_SERVER["REMOTE_ADDR"]."'";
      $result3 = mysql_query($sql3);
        if (mysql_num_rows($result3)==0)
          {
	      $sql4="INSERT INTO stats_bot (ip,datum,anfang,ende,referer) 
          VALUES ('".$_SERVER["REMOTE_ADDR"]."',
          '".$heute."',
          ".time().",
          ".time().",
          '".$_SERVER["HTTP_USER_AGENT"]."')";
          
          } 
        else
        {
	        $zeile3=mysql_fetch_array($result3);
	        $sql4="UPDATE stats_bot SET ende=".time().",views=views+1 WHERE id='".$zeile3["id"]."'";}
         mysql_query($sql4);
	    
	}

}
?>