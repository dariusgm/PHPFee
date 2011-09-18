<?php
function added_vb_user($nick,$pw,$email,$sex)
{

	
$pool = "qwertzupasdfghkyxcvbnm";
    $pool .= "23456789";
    $pool .= "WERTZUPLKJHGFDSAYXCVBNM";
    srand ((double)microtime()*1000000);
    for($index = 0; $index < 3; $index++)
    {
    $salt .= substr($pool,(rand()%(strlen ($pool))), 1);
    }
	
	
$sql1="INSERT INTO forum_user (";
$sql2="VALUES (";

$sql1.="usergroupid,";
$sql2.="3,";

$sql1.="membergroupids,displaygroupid,";
$sql2.="'',0,";

$sql1.="username,password,";
$sql2.="'".$nick."','".md5($pw.$salt)."',";

$sql1.="passworddate,email,";
$sql2.="'".date("Y-m-d")."','".$email."',";

$sql1.="styleid,parentemail,";
$sql2.="0,'',";

$sql1.="homepage,icq,";
$sql2.="'','',";

$sql1.="aim,yahoo,";
$sql2.="'','',";

$sql1.="msn,skype,";
$sql2.="'','',";

$sql1.="showvbcode,showbirthday,";
$sql2.="2,0,";

$sql1.="usertitle,customtitle,";
$sql2.="'Neuer Benutzer',0,";

$sql1.="joindate,daysprune,";
$sql2.="'".time()."',0,";

$sql1.="lastvisit,lastactivity,";
$sql2.="0,0,";

$sql1.="lastpost,lastpostid,";
$sql2.="0,0,";

$sql1.="posts,reputation,";
$sql2.="0,10,";

$sql1.="reputationlevelid,timezoneoffset,";
$sql2.="5,1,";

$sql1.="pmpopup,avatarid,";
$sql2.="1,0,";

$sql1.="avatarrevision,profilepicrevision,";
$sql2.="0,0,";

$sql1.="sigpicrevision,options,";
$sql2.="0,7383,";

$sql1.="birthday,birthday_search,";
$sql2.="'','0000-00-00',";

$sql1.="maxposts,startofweek,";
$sql2.="-1,2,";

$sql1.="ipaddress,referrerid,";
$sql2.="'".$_SERVER["REMOTE_ADDR"]."',0,";

$sql1.="languageid,emailstamp,";
$sql2.="1,0,";

$sql1.="threadedmode,autosubscribe,";
$sql2.="0,1,";

$sql1.="pmtotal,pmunread,";
$sql2.="0,0,";

$sql1.="salt,ipoints,";
$sql2.="'".$salt."',0,";

$sql1.="infractions,warnings,";
$sql2.="0,0,";

$sql1.="infractiongroupids,infractiongroupid,";
$sql2.="'',0,";

$sql1.="adminoptions) ";
$sql2.="0)";

	$db = mysql_connect("localhost", "portal", "psacln") or die("Verbindungsfehler");
	$result1=mysql_db_query("portal",$sql1.$sql2);
	$last=mysql_insert_id();
	
	$sql3="INSERT INTO forum_userfield (userid,temp,field1,field2,field3,field4) 
	VALUES ('".$last."','','','','')";
	$result2=mysql_db_query("portal",$sql3);
	
	$sql4="INSERT INTO forum_usertextfield (userid) 
	VALUES ('".$last."')";
	$result3=mysql_db_query("portal",$sql4);	
	
}?>